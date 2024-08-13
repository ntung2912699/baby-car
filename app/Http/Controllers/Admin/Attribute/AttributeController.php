<?php

namespace App\Http\Controllers\Admin\Attribute;

use App\Http\Controllers\Controller;
use App\Repositories\Attribute\AttributeRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class AttributeController extends Controller
{
    const MSG_ERROR_EXCEPTION = 'Đã xảy ra lỗi hệ thống! Vui lòng thử lại sau';
    const SUCCESS_STATUS = 'SUCCESS';
    const ERROR_STATUS = 'ERROR';

    /**
     * @var AttributeRepository
     */
    protected $attributeRepository;

    /**
     * AttributeController constructor.
     * @param AttributeRepository $attributeRepository
     */
    public function __construct(
        AttributeRepository $attributeRepository
    )
    {
        $this->attributeRepository = $attributeRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index(Request $request)
    {
        try {
            $sortField = $request->get('sort', 'id');
            $sortOrder = $request->get('order', 'asc');
            $perPage = $request->get('perPage', 10);
            $searchKey = $request->get('searchKey');
            if ($searchKey) {
                $attribute_data = $this->attributeRepository->searchMultipleColumn($searchKey, $perPage, $sortField, $sortOrder);
            } else {
                $attribute_data = $this->attributeRepository->orderBy($sortField, $sortOrder)->paginate($perPage);
            }
            $countTotal = $this->attributeRepository->countTotal();
            $currentTotal = $attribute_data->count();

            return view('admin.page.attributes.index', compact(
                'attribute_data',
                'sortField',
                'sortOrder',
                'perPage',
                'countTotal',
                'currentTotal',
                'searchKey'
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
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => self::ERROR_STATUS,
                'message' => $validator->errors()
            ], 400);
        }
        try {
            $data = $request->all();
            $this->attributeRepository->create($data);
            $attributes = $this->attributeRepository->getAll();
            foreach ($attributes as $attribute) {
                $spec = $attribute->spec;
                $attribute['spec'] = $spec;
            }
            return response()->json([
                'status' => self::SUCCESS_STATUS,
                'data' => $attributes
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
    public function AjaxEditAttribute(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => self::ERROR_STATUS,
                'message' => $validator->errors()
            ], 400);
        }
        try {
            $id = $request->get('id');
            $nameChange = $request->get('name');
            $DataNew = $this->attributeRepository->update(
                $id,
                ["name" => $nameChange]
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
    public function AjaxDeleteAttribute(Request $request)
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
            $this->attributeRepository->delete($id);
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
