<?php

namespace App\Http\Controllers\Admin\ProductModel;

use App\Http\Controllers\Controller;
use App\Models\ProductModel;
use App\Repositories\Producer\ProducerRepository;
use App\Repositories\ProductModel\ProductModelRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ProductModelController extends Controller
{
    const MSG_ERROR_EXCEPTION = 'Đã xảy ra lỗi hệ thống! Vui lòng thử lại sau';
    const SUCCESS_STATUS = 'SUCCESS';
    const ERROR_STATUS = 'ERROR';

    /**
     * @var ProductModelRepository
     */
    protected $productModelRepository;

    /**
     * @var ProducerRepository
     */
    protected $producerRepository;

    /**
     * ProductModelController constructor.
     * @param ProductModelRepository $productModelRepository
     * @param ProducerRepository $producerRepository
     */
    public function __construct(
        ProductModelRepository $productModelRepository,
        ProducerRepository $producerRepository
    )
    {
        $this->productModelRepository = $productModelRepository;
        $this->producerRepository = $producerRepository;
    }

    /**
     * @param Request $request
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
                $models = $this->productModelRepository->searchMultipleByProducerID($id, $searchKey, $perPage, $sortField, $sortOrder);
            } else {
                $models = $this->productModelRepository->orderByProducerID($id, $sortField, $sortOrder)->paginate($perPage);
            }
            $countTotal = $this->productModelRepository->countTotal();
            $currentTotal = $models->count();
            $producers = $this->producerRepository->getAll();
            $producerTarget = $this->producerRepository->find($id);

            return view('admin.page.model.index', compact(
                'models',
                'sortField',
                'sortOrder',
                'perPage',
                'countTotal',
                'currentTotal',
                'searchKey',
                'producers',
                'producerTarget'
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
            'producer_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => self::ERROR_STATUS,
                'message' => $validator->errors()
            ], 400);
        }

        try {
            $data = $request->all();
            $this->productModelRepository->create($data);
            $id = $request->get('producer_id');
            $newProductModel = $this->productModelRepository->getByProducerID($id);
            $productModels = ProductModel::query()->where('producer_id', $id)->get();
            $producers = $this->producerRepository->getAll();
            return response()->json([
                'status' => self::SUCCESS_STATUS,
                'data' => [
                    'newProductModel' => $newProductModel,
                    'models' => $productModels,
                    'producers' => $producers,
                ]
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
    public function AjaxEditModel(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required|string|max:255',
            'producer_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => self::ERROR_STATUS,
                'message' => $validator->errors()
            ], 400);
        }

        try {
            $idmodel = $request->get('id');
            $nameChange = $request->get('name');
            $idProducerChange = $request->get('producer_id');
            $producerNew = $this->productModelRepository->update(
                $idmodel,
                [
                    "name" => $nameChange,
                    "producer_id" => $idProducerChange
                ]
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
    public function AjaxDeleteModel(Request $request) {
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
            $idmodel = $request->get('id');
            $this->productModelRepository->delete($idmodel);
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

    /**
     * @param $producerId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProductModels($producerId)
    {
        try {
            $productModels = ProductModel::query()->where('producer_id', $producerId)->get();
            $producers = $this->producerRepository->getAll();
            return response()->json([
                'status' => self::SUCCESS_STATUS,
                'data' => [
                    'models' => $productModels,
                    'producers' => $producers
                ]
            ], Response::HTTP_OK);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => self::ERROR_STATUS,
                'message' => self::MSG_ERROR_EXCEPTION
            ], 500);
        }
    }

}
