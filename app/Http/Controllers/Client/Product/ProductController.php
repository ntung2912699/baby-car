<?php

namespace App\Http\Controllers\Client\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductModel;
use App\Repositories\Attribute\AttributeRepository;
use App\Repositories\AttributeSpec\AttributeSpecRepository;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Producer\ProducerRepository;
use App\Repositories\Product\ProductRepository;
use App\Repositories\ProductModel\ProductModelRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
     * @var ProducerRepository
     */
    protected $producerRepository;

    /**
     * @var ProductModelRepository
     */
    protected $productModelRepository;

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
     * ProductController constructor.
     * @param ProductRepository $productRepository
     * @param ProducerRepository $producerRepository
     * @param CategoryRepository $categoryRepository
     * @param AttributeRepository $attributeRepository
     * @param ProductModelRepository $productModelRepository
     * @param AttributeSpecRepository $attributeSpecRepository
     */
    public function __construct(
        ProductRepository $productRepository,
        ProducerRepository $producerRepository,
        CategoryRepository $categoryRepository,
        AttributeRepository $attributeRepository,
        ProductModelRepository $productModelRepository,
        AttributeSpecRepository $attributeSpecRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->producerRepository = $producerRepository;
        $this->categoryRepository = $categoryRepository;
        $this->attributeRepository = $attributeRepository;
        $this->productModelRepository = $productModelRepository;
        $this->attributeSpecRepository = $attributeSpecRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function detail($id)
    {
        try {
            $product = $this->productRepository->find($id);
            $attributeByProduct = $product->spec;
            $gallery = explode('|', $product->gallery);
            $relateProduct = $this->productRepository->relateProduct($product);
            $relateProductByProducer = $this->productRepository->relateProductByProducer($product);
            return view('client.page.product-detail', compact(
                'product',
                'attributeByProduct',
                'gallery',
                'relateProduct',
                'relateProductByProducer'
            ));
        } catch (\Exception $exception) {
            return view('client.page.not-found');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function search(Request $request) {
        try {
            $query = $request->get('query');
            $products = $this->productRepository->searchProduct($query);
            $categories = $this->categoryRepository->getAll();
            $producers = $this->producerRepository->getAll();
            $attributes = $this->attributeRepository->getAll();
            $productModels = $this->productModelRepository->getAll();
            $stringSearch = $query;
            return view('client.page.product-list', compact(
                'products',
                'query',
                'categories',
                'producers',
                'attributes',
                'productModels',
                'stringSearch'
            ));
        } catch (\Exception $exception) {
            return view('client.page.not-found');
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function showProductByProducer($id) {
        try {
            $products = $this->productRepository->searchByProducerId($id);
            $producerTarget = $this->producerRepository->find($id);
            $categories = $this->categoryRepository->getAll();
            $producers = $this->producerRepository->getAll();
            $attributes = $this->attributeRepository->getAll();
            $productModels = $this->productModelRepository->getAll();
            $producerTargetId = $id;
            $stringSearch = $producerTarget->name;
            return view('client.page.product-list', compact(
                'products',
                'producerTarget',
                'categories',
                'producers',
                'attributes',
                'producerTargetId',
                'productModels',
                'stringSearch'
            ));
        } catch (\Exception $exception) {
            return view('client.page.not-found');
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function productList() {
        try {
            $products = Product::query()->where('status_id', '=', 1)->orderBy('created_at', 'asc')->paginate(12);
            $categories = $this->categoryRepository->getAll();
            $producers = $this->producerRepository->getAll();
            $attributes = $this->attributeRepository->getAll();
            $productModels = $this->productModelRepository->getAll();
            $stringSearch = "";
            return view('client.page.product-list', compact(
                'products',
                'categories',
                'producers',
                'attributes',
                'productModels',
                'stringSearch'
            ));
        } catch (\Exception $exception) {
            return view('client.page.not-found');
        }
    }

    public function productSearch(Request $request) {
        try {
            // Lấy các tham số từ yêu cầu
            $enablePriceRange = $request->input('enable_price_range');
            $filters = [
                'query' => $request->input('query'),
                'producer' => $request->input('producer'),
                'category' => $request->input('category'),
                'model' => $request->input('model'),
                'price_range_min' => $enablePriceRange?$request->input('price_range_min'):null,
                'price_range_max' => $enablePriceRange?$request->input('price_range_max'):null,
                'start_year' => $request->input('start_year'),
                'end_year' => $request->input('end_year'),
                'spec' => array_filter($request->input('spec', []), function($value) {
                    return !is_null($value);
                })
            ];

            $stringSearch = $this->buildStringSearch($filters);

            // Sử dụng repository để tìm kiếm
            $products = $this->productRepository->search($filters);

            // Lấy dữ liệu cần thiết cho view
            $categories = $this->categoryRepository->getAll();
            $producers = $this->producerRepository->getAll();
            $models = ProductModel::query()->where('producer_id', '=', $request->input('producer'));
            $attributes = $this->attributeRepository->getAll();
            $productModels = $this->productModelRepository->getAll();
            // Trả về view với dữ liệu
            return view('client.page.product-list', [
                'products' => $products,
                'producers' => $producers,
                'models' => $models,
                'selectedModelId' => $request->input('model'),
                'categories' => $categories,
                'attributes' => $attributes,
                'query' => $filters['query'],
                'producerTarget' => $producers->find($filters['producer']),
                'producerId' => $filters['producer'],
                'categoryId' => $filters['category'],
                'price_range_min' => $filters['price_range_min'],
                'price_range_max' => $filters['price_range_max'],
                'start_year' => $filters['start_year'],
                'end_year' => $filters['end_year'],
                'spec' => $filters['spec'],
                'productModels' => $productModels,
                'stringSearch' => $stringSearch
            ]);
        } catch (\Exception $exception) {
            return view('client.page.not-found');
        }
    }

    /**
     * @param $param
     * @return string
     */
    private function buildStringSearch($param) {
        $queryString = "";
        if ($param['producer']) {
            $name = $this->producerRepository->find($param['producer'])->name;
            $queryString = $queryString != ""?$queryString.' > '.$name:$queryString.$name;
        }
        if ($param['category']) {
            $name = $this->categoryRepository->find($param['category'])->name;
            $queryString = $queryString != ""?$queryString.' > '.$name:$queryString.$name;
        }
        if ($param['model']) {
            $name = $this->productModelRepository->find($param['model'])->name;
            $queryString = $queryString != ""?$queryString.' > '.$name:$queryString.$name;
        }
        if ($param['query']) {
            $queryString = $queryString != ""?$queryString.' > '.$param['query']:$queryString.$param['query'];
        }
        if ($param['price_range_min'] && $param['price_range_max']) {
            $price_min = number_format($param['price_range_min'], 0, ',', '.') . ' ₫';
            $price_max = number_format($param['price_range_max'], 0, ',', '.') . ' ₫';
            $queryString = $queryString != ""?
                $queryString.' > '.$price_min.' - '.$price_max
                :$queryString.$price_min.' - '.$price_max;
        }
        if ($param['price_range_min'] && !$param['price_range_max']) {
            $price_min = number_format($param['price_range_min'], 0, ',', '.') . ' ₫';
            $queryString = $queryString != ""?$queryString.' > '.$price_min:$queryString.$price_min;
        }
        if ($param['price_range_max'] && !$param['price_range_min']) {
            $price_max = number_format($param['price_range_max'], 0, ',', '.') . ' ₫';
            $queryString = $queryString != ""?$queryString.' > '.$price_max:$queryString.$price_max;
        }
        if ($param['start_year'] && $param['end_year']) {
            $queryString = $queryString != ""?
                $queryString.' > '.$param['start_year'].' - '.$param['end_year']
                :$queryString.$param['start_year'].' - '.$param['end_year'];
        }
        if ($param['start_year'] && !$param['end_year']) {
            $queryString = $queryString != ""?$queryString.' > '.$param['start_year']:$queryString.$param['start_year'];
        }
        if ($param['end_year'] && !$param['start_year']) {
            $queryString = $queryString != ""?$queryString.' > '.$param['end_year']:$queryString.$param['end_year'];
        }
        if (count($param['spec'])) {
            foreach ($param['spec'] as $item) {
                if (!empty($item)) {
                    $name = $this->attributeSpecRepository->find($item)->value;
                    $queryString = $queryString != ""?$queryString.' > '.$name:$queryString.$name;
                }
            }
        }

        return $queryString;
    }

    /**
     * @param $producerId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProductModels($producerId)
    {
        try {
            $productModels = ProductModel::query()->where('producer_id', $producerId)->get();
            return response()->json([
                'status' => self::SUCCESS_STATUS,
                'data' => $productModels
            ], Response::HTTP_OK);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => self::ERROR_STATUS,
                'message' => self::MSG_ERROR_EXCEPTION
            ], 500);
        }
    }
}
