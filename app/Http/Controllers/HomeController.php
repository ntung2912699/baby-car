<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Repositories\Attribute\AttributeRepository;
use App\Repositories\AttributeSpec\AttributeSpecRepository;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Producer\ProducerRepository;
use App\Repositories\Product\ProductRepository;
use App\Repositories\ProductAttribute\ProductAttributeRepository;
use App\Repositories\Status\StatusRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * @var ProducerRepository;
     */
    protected $producerRepository;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * HomeController constructor.
     * @param ProductRepository $productRepository
     * @param ProducerRepository $producerRepository
     * @param UserRepository $userRepository
     */
    public function __construct(
        ProductRepository $productRepository,
        ProducerRepository $producerRepository,
        UserRepository $userRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->producerRepository = $producerRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        try {
            $products = Product::query()->where('status_id', '=', 1)->orderBy('created_at', 'ASC')->paginate(12);
            $producers = $this->producerRepository->getAll();
            $countProduct = $this->productRepository->countTotal();
            $countUser = $this->userRepository->countTotal();
            $productSold = Product::query()->where('status_id', '=', 6)->get();
            $countProductSold = count($productSold);
            return view('home', compact(
                'products',
                'producers',
                'countProduct',
                'countUser',
                'countProductSold'
            ));
        } catch (\Exception $exception) {
            return view('client.page.not-found');
        }
    }

    public function contact() {
        return view('client.page.contact');
    }
}
