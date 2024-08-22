<?php

namespace App\Http\Controllers\Admin\Producer;

use App\Http\Controllers\Controller;
use App\Repositories\Producer\ProducerRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ProducerController extends Controller
{
    const MSG_ERROR_EXCEPTION = 'Đã xảy ra lỗi hệ thống! Vui lòng thử lại sau';
    const SUCCESS_STATUS = 'SUCCESS';
    const ERROR_STATUS = 'ERROR';

    /**
     * @var ProducerRepository
     */
    protected $producerRepository;

    /**
     * ProducerController constructor.
     * @param ProducerRepository $producerRepository
     */
    public function __construct(
        ProducerRepository $producerRepository
    )
    {
        $this->producerRepository = $producerRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index(Request $request) {
        try {
            $sortField = $request->get('sort', 'id');
            $sortOrder = $request->get('order', 'asc');
            $perPage = $request->get('perPage', 10);
            $searchKey = $request->get('searchKey');
            if ($searchKey) {
                $producer_data = $this->producerRepository->searchMultipleColumn($searchKey, $perPage, $sortField, $sortOrder);
            } else {
                $producer_data = $this->producerRepository->orderBy($sortField, $sortOrder)->paginate($perPage);
            }
            $countTotal = $this->producerRepository->countTotal();
            $currentTotal = $producer_data->count();

            return view('admin.page.producer.index', compact(
                'producer_data',
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
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'logo' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => self::ERROR_STATUS,
                'message' => $validator->errors()
            ], 400);
        }

        try {
            $data = $request->all();
            if($request->hasFile('logo')){
                $file = $request->file('logo');
                $source = 'upload/producer/';
                $file_name = $this->producerRepository->upload($file , $source);
                $data['logo'] = $file_name;
            }
            $this->producerRepository->create($data);
            $newProducer = $this->producerRepository->getAll();
            return response()->json([
                'status' => self::SUCCESS_STATUS,
                'data' => $newProducer
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
    public function AjaxEditNameProducer(Request $request) {
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
            $idproducer = $request->get('id');
            $nameChange = $request->get('name');
            $producerNew = $this->producerRepository->update(
                $idproducer,
                ["name" => $nameChange]
            );
            return response()->json([
                'status' => self::SUCCESS_STATUS,
                'data' => $producerNew
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
    public function AjaxEditLogoProducer(Request $request) {
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
            $idproducer = $request->get('id');
            $newLogo = '';
            if($request->hasFile('logo')){
                $file = $request->file('logo');
                $source = 'upload/producer/';
                $file_name = $this->producerRepository->upload($file , $source);
                $newLogo = $file_name;
            }
            $producerNew = $this->producerRepository->update(
                $idproducer,
                ["logo" => $newLogo]
            );
            return response()->json([
                'status' => self::SUCCESS_STATUS,
                'data' => $producerNew
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
    public function AjaxDeleteProducer(Request $request) {
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
            $idproducer = $request->get('id');
            $this->producerRepository->delete($idproducer);
            return response()->json([
                'status' => self::SUCCESS_STATUS
            ],Response::HTTP_OK);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => self::ERROR_STATUS,
                'message' => self::MSG_ERROR_EXCEPTION
            ], 500);
        }
    }
}
