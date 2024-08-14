<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Repositories\Attribute\AttributeRepository;
use App\Repositories\AttributeSpec\AttributeSpecRepository;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Producer\ProducerRepository;
use App\Repositories\Product\ProductRepository;
use App\Repositories\ProductAttribute\ProductAttributeRepository;
use App\Repositories\Status\StatusRepository;
use Illuminate\Http\Request;

class AdminController extends Controller
{
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

    public function index() {
        $productCount = count($this->productRepository->getAll());
        $userCount = count(User::all());
        $productSold = count(Product::query()->where('status_id', '=', '6')->get());
        $productNewCount = count(Product::query()->where('status_id', '=', '1')->get());
        $productNew = Product::query()->where('status_id', '=', '1')
        ->orderBy('created_at', 'DESC')->take(10)->get();
        $priceSum = Product::query()
            ->pluck('price')
            ->map(function ($price) {
                // Xóa các ký tự không phải số và chuyển đổi thành số thực
                return (float) str_replace(['đ', '.'], '', $price);
            })
            ->sum();

        $totalPrice = number_format($priceSum, 0, '', '.') . 'đ';
        return view('admin.page.dashboard.index', compact(
            'productCount',
            'userCount',
            'productSold',
            'productNew',
            'productNewCount',
            'totalPrice'
        ));
    }
}
