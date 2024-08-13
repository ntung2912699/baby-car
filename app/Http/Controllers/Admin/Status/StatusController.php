<?php

namespace App\Http\Controllers\Admin\Status;

use App\Http\Controllers\Controller;
use App\Repositories\Attribute\AttributeRepository;
use App\Repositories\Status\StatusRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class StatusController extends Controller
{
    const MSG_ERROR_EXCEPTION = 'Đã xảy ra lỗi hệ thống! Vui lòng thử lại sau';
    const SUCCESS_STATUS = 'SUCCESS';
    const ERROR_STATUS = 'ERROR';

    /**
     * @var StatusRepository
     */
    protected $statusRepository;

    /**
     * StatusController constructor.
     * @param StatusRepository $statusRepository
     */
    public function __construct(
        StatusRepository $statusRepository
    )
    {
        $this->statusRepository = $statusRepository;
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
                $status_data = $this->statusRepository->searchMultipleColumn($searchKey, $perPage, $sortField, $sortOrder);
            } else {
                $status_data = $this->statusRepository->orderBy($sortField, $sortOrder)->paginate($perPage);
            }
            $countTotal = $this->statusRepository->countTotal();
            $currentTotal = $status_data->count();

            return view('admin.page.status_product.index', compact(
                'status_data',
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
            $this->statusRepository->create($data);
            $status = $this->statusRepository->getAll();
            return response()->json([
                'status' => self::SUCCESS_STATUS,
                'data' => $status
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
    public function AjaxEditStatus(Request $request)
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
            $DataNew = $this->statusRepository->update(
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
    public function AjaxDeleteStatus(Request $request)
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
            $this->statusRepository->delete($id);
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
