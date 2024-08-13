<?php

namespace App\Http\Controllers\Admin\AttributeSpec;

use App\Http\Controllers\Controller;
use App\Repositories\Attribute\AttributeRepository;
use App\Repositories\AttributeSpec\AttributeSpecRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class AttributeSpecController extends Controller
{
    const MSG_ERROR_EXCEPTION = 'Đã xảy ra lỗi hệ thống! Vui lòng thử lại sau';
    const SUCCESS_STATUS = 'SUCCESS';
    const ERROR_STATUS = 'ERROR';

    /**
     * @var AttributeSpecRepository
     */
    protected $attributeSpecRepository;

    /**
     * @var AttributeRepository
     */
    protected $attributeRepository;

    /**
     * AttributeSpecController constructor.
     * @param AttributeSpecRepository $attributeSpecRepository
     * @param AttributeRepository $attributeRepository
     */
    public function __construct(
        AttributeSpecRepository $attributeSpecRepository,
        AttributeRepository $attributeRepository
    )
    {
        $this->attributeSpecRepository = $attributeSpecRepository;
        $this->attributeRepository = $attributeRepository;
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index(Request $request, $id)
    {
        try {
            $sortField = $request->get('sort', 'id');
            $sortOrder = $request->get('order', 'asc');
            $perPage = $request->get('perPage', 10);
            $searchKey = $request->get('searchKey');
            if ($searchKey) {
                $attribute_spec_data = $this->attributeSpecRepository->searchMultipleByAttributeID($id, $searchKey, $perPage, $sortField, $sortOrder);
            } else {
                $attribute_spec_data = $this->attributeSpecRepository->orderByAttributeID($id, $sortField, $sortOrder)->paginate($perPage);
            }
            $countTotal = $this->attributeSpecRepository->countTotal();
            $currentTotal = $attribute_spec_data->count();
            $attributes = $this->attributeRepository->getAll();
            $attributeTarget = $this->attributeRepository->find($id);

            return view('admin.page.attribute_spec.index', compact(
                'attribute_spec_data',
                'sortField',
                'sortOrder',
                'perPage',
                'countTotal',
                'currentTotal',
                'searchKey',
                'attributes',
                'attributeTarget'
            ));
        } catch (\Exception $e) {
            return view('admin.page.common.error_page');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'attribute_id' => 'required',
            'value' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => self::ERROR_STATUS,
                'message' => $validator->errors()
            ], 400);
        }
        try {
            $data = $request->all();
            $this->attributeSpecRepository->create($data);
            $id = $request->get('attribute_id');
            $specs = $this->attributeSpecRepository->getByAttributeID($id);
            return response()->json([
                'status' => self::SUCCESS_STATUS,
                'data' => $specs
            ], Response::HTTP_OK);

        } catch (\Exception $exception) {
            return response()->json([
                'status' => self::ERROR_STATUS,
                'message' => self::MSG_ERROR_EXCEPTION
            ], 500);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function AjaxEditAttributeSpec(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'attribute_id' => 'required',
            'value' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => self::ERROR_STATUS,
                'message' => $validator->errors()
            ], 400);
        }
        try {
            $id = $request->get('id');
            $attrIdChange = $request->get('attribute_id');
            $valueChange = $request->get('value');
            $DataNew = $this->attributeSpecRepository->update(
                $id,
                [
                    "attribute_id" => $attrIdChange,
                    "value" => $valueChange
                ]
            );
            return response()->json([
                'status' => self::SUCCESS_STATUS,
                'data' => $DataNew
            ], Response::HTTP_OK);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => self::ERROR_STATUS,
                'message' => self::MSG_ERROR_EXCEPTION
            ], 500);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function AjaxDeleteAttributeSpec(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => self::ERROR_STATUS,
                'message' => $validator->errors()
            ], 400);
        }

        try {
            $id = $request->get('id');
            $this->attributeSpecRepository->delete($id);
            return response()->json([
                'status' => self::SUCCESS_STATUS
            ], Response::HTTP_OK);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => self::ERROR_STATUS,
                'message' => self::MSG_ERROR_EXCEPTION
            ], 500);
        }
    }
}
