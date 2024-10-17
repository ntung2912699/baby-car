<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Repositories\Attribute\AttributeRepository;
use App\Repositories\AttributeSpec\AttributeSpecRepository;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Producer\ProducerRepository;
use App\Repositories\Product\ProductRepository;
use App\Repositories\ProductAttribute\ProductAttributeRepository;
use App\Repositories\Status\StatusRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    const MSG_ERROR_EXCEPTION = 'Đã xảy ra lỗi hệ thống! Vui lòng thử lại sau';
    const SUCCESS_STATUS = 'SUCCESS';
    const ERROR_STATUS = 'ERROR';

    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * @var StatusRepository
     */
    protected $statusRepository;

    /**
     * @var ProducerRepository
     */
    protected $producerRepository;

    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * @var AttributeRepository
     */
    protected $attributeRepository;

    /**
     * @var AttributeSpecRepository
     */
    protected $attributeSpecRepository;

    /**
     * @var ProductAttributeRepository
     */
    protected $productAttributeRepository;

    /**
     * ProductController constructor.
     * @param AttributeRepository $attributeRepository
     * @param ProductRepository $productRepository
     * @param ProducerRepository $producerRepository
     * @param StatusRepository $statusRepository
     * @param CategoryRepository $categoryRepository
     * @param AttributeSpecRepository $attributeSpecRepository
     * @param ProductAttributeRepository $productAttributeRepository
     */
    public function __construct(
        AttributeRepository $attributeRepository,
        ProductRepository $productRepository,
        ProducerRepository $producerRepository,
        StatusRepository $statusRepository,
        CategoryRepository $categoryRepository,
        AttributeSpecRepository $attributeSpecRepository,
        ProductAttributeRepository $productAttributeRepository
    )
    {
        $this->attributeRepository = $attributeRepository;
        $this->attributeSpecRepository = $attributeSpecRepository;
        $this->categoryRepository = $categoryRepository;
        $this->producerRepository = $producerRepository;
        $this->productRepository = $productRepository;
        $this->statusRepository = $statusRepository;
        $this->productAttributeRepository = $productAttributeRepository;
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
                $product_data = $this->productRepository->searchMultipleColumnProduct($searchKey, $perPage, $sortField, $sortOrder);
            } else {
                $product_data = $this->productRepository->orderBy($sortField, $sortOrder)->paginate($perPage);
            }
            $countTotal = $this->productRepository->countTotal();
            $currentTotal = $product_data->count();

            return view('admin.page.product.index', compact(
                'product_data',
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

    public function create(Request $request) {
        try {
            $categories = $this->categoryRepository->getAll();
            $producers = $this->producerRepository->getAll();
            $status = $this->statusRepository->getAll();
            $attributes = $this->attributeRepository->getAll();
            return view('admin.page.product.form_create', compact(
                'categories',
                'producers',
                'status',
                'attributes'
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
            'category_id' => 'required',
            'producer_id' => 'required',
            'model_id' => 'required',
            'status_id' => 'required',
            'name' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'cost_price' => 'required|string|max:255',
            'thumbnail' => 'required',
            'gallery' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => self::ERROR_STATUS,
                'message' => $validator->errors()
            ], 400);
        }
        try {
            $data = $request->all();
        if ($request->hasFile('thumbnail')) {
                $file = $request->file('thumbnail');
                $source = 'upload/product/thumbnail/';
                $file_name = $this->productRepository->upload($file, $source);
//                $file_name = $this->productRepository->uploadFileToGoogleDrive($file);
                $data['thumbnail'] = $file_name;
            }
            if ($request->hasFile('gallery')) {
                $galleryList = [];
                foreach ($request->file('gallery') as $file) {
                    $source = 'upload/product/gallery/';
                    $file_name = $this->productRepository->upload($file, $source);
//                    $file_name = $this->productRepository->uploadFileToGoogleDrive($file);
                    $galleryList[] = $file_name;
                }
                $data['gallery'] = implode('|', $galleryList);
            }
            $data['sale_price'] = $request->get('price');
            $newData = $this->productRepository->create($data);
            if ($request->get('spec')) {
                $arrSpecID = explode(',', $request->get('spec'));
                $this->createAttributeProduct($arrSpecID, $newData);
            }
            return response()->json([
                'status' => self::SUCCESS_STATUS,
                'data' => $newData
            ], Response::HTTP_OK);

        } catch (\Exception $exception) {
            return response()->json([
                'status' => self::ERROR_STATUS,
                'message' => self::MSG_ERROR_EXCEPTION
            ], 500);
        }
    }

    /**
     * @param $AttrIds
     * @param $productData
     */
    function createAttributeProduct($AttrIds, $productData) {
        foreach ($AttrIds as $spec_id) {
            $this->productAttributeRepository->create(
                [
                    'product_id' => $productData->id,
                    'attribute_spec_id' => $spec_id
                ]
            );
        }
    }

    public function edit(Request $request, $id) {
        try {
            $product = $this->productRepository->find($id);
            $categories = $this->categoryRepository->getAll();
            $producers = $this->producerRepository->getAll();
            $status = $this->statusRepository->getAll();
            $attributes = $this->attributeRepository->getAll();
            $spec = [];
            if ($product && isset($product->spec)) {
                $spec = $product->spec;
            }

            return view('admin.page.product.form_edit', compact(
                'categories',
                'producers',
                'status',
                'attributes',
                'product',
                'spec'
            ));
        } catch (\Exception $e) {
            return view('admin.page.common.error_page');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'category_id' => 'required',
            'producer_id' => 'required',
            'model_id' => 'required',
            'status_id' => 'required',
            'name' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'cost_price' => 'required|string|max:255',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => self::ERROR_STATUS,
                'message' => $validator->errors()
            ], 400);
        }
        try {
            $data = $request->all();
            $productId = $request->get('id');
            $productTarget = $this->productRepository->find($productId);
            if ($request->hasFile('thumbnail')) {
                $file = $request->file('thumbnail');
                $source = 'upload/product/thumbnail/';
                $file_name = $this->productRepository->upload($file, $source);
//                $file_name = $this->productRepository->uploadFileToGoogleDrive($file);
                $data['thumbnail'] = $file_name;
            } else {
                $data['thumbnail'] = $productTarget->thumbnail;
            }
            if ($request->hasFile('gallery')) {
                $galleryList = [];
                foreach ($request->file('gallery') as $file) {
                    $source = 'upload/product/gallery/';
                    $file_name = $this->productRepository->upload($file, $source);
//                    $file_name = $this->productRepository->uploadFileToGoogleDrive($file);
                    $galleryList[] = $file_name;
                }
                $galleryOld = explode('|', $productTarget->gallery);
                $galleryMergedArray = array_merge($galleryOld, $galleryList);
                $data['gallery'] = implode('|', $galleryMergedArray);
            }
            if ($request->get('spec')) {
                $this->removeAttributeByProduct($productTarget);
                $arrSpecID = explode(',', $request->get('spec'));
                $this->createAttributeProduct($arrSpecID, $productTarget);
            }
            $data['sale_price'] = $request->get('price');
            $newData = $this->productRepository->update($productId, $data);
            return response()->json([
                'status' => self::SUCCESS_STATUS,
                'data' => $newData
            ], Response::HTTP_OK);

        } catch (\Exception $exception) {
            return response()->json([
                'status' => self::ERROR_STATUS,
                'message' => self::MSG_ERROR_EXCEPTION
            ], 500);
        }
    }

    /**
     * @param $AttrIds
     * @param $productData
     */
    function removeAttributeByProduct($productData) {
        $attributes = $productData->spec;
        foreach ($attributes as $attribute) {
            $productData->spec()->detach($attribute->id);
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function AjaxGetAttributes(Request $request) {
        try {
            $attributes = $this->attributeRepository->getAll();
            $status = $this->statusRepository->getAll();
            $categories = $this->categoryRepository->getAll();
            $producers = $this->producerRepository->getAll();
            foreach ($attributes as $attribute) {
                $spec = $attribute->spec;
                $attribute['spec'] = $spec;
            }
            return response()->json([
                'status' => self::SUCCESS_STATUS,
                'data' => [
                    'attributes' => $attributes,
                    'status' => $status,
                    'categories' => $categories,
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
    public function AjaxGetGallery(Request $request) {
        try {
            $id = $request->get('id');
            $product = $this->productRepository->find($id);
            $gallery =  explode('|', $product->gallery);
            return response()->json([
                'status' => self::SUCCESS_STATUS,
                'data' => [
                    'gallery' => $gallery,
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
    public function AjaxDeleteGallery(Request $request)
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
            $imageUrl = $request->input('image');
            $product = $this->productRepository->find($id);
            $galleryArray = explode('|', $product->gallery);
            $galleryArray = array_filter($galleryArray, function($url) use ($imageUrl) {
                return $url !== $imageUrl;
            });
            // Nối lại thành chuỗi
            $product->gallery = implode('|', $galleryArray);
            if ($product->gallery === '|') {
                $product->gallery = '';
            }

            // Lưu thay đổi
            $product->save();
            return response()->json([
                'status' => self::SUCCESS_STATUS,
                'data' => [
                    'gallery' => explode('|', $product->gallery),
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
    public function AjaxDeleteProduct(Request $request)
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
//            $productTarget = $this->productRepository->find($id);
//            $productTarget->spec()->detach();
            $this->productRepository->delete($id);
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
