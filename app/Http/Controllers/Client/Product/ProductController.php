<?php

namespace App\Http\Controllers\Client\Product;

use App\Http\Controllers\Controller;
use App\Models\ContactRequest;
use App\Models\Fee;
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
    const CONTACT_STATUS = 'Mới';
    const YEAR_MANU = 'Năm SX';
    const REGISTRATION_FEE = 3;
    const NO_FEE = 0;

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
                'relateProductByProducer',
            ));
        } catch (\Exception $exception) {
            return view('client.page.not-found');
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    protected function calculateFee(Request $request)
    {
        $product = $this->productRepository->find($request->get('product_id'));
        $state1 = $request->get('state1');
        $state2 = $request->get('state2');
        $fee1 = $request->get('fee1');
        $fee2 = $request->get('fee2');
        $fee3 = $request->get('fee3');
        $yearOfManufacture = date("Y");

        // Lấy năm sản xuất từ thuộc tính sản phẩm
        foreach ($product->spec as $item) {
            if ($item->attribute->name === self::YEAR_MANU) {
                $yearOfManufacture = $item->value;
            }
        }

        // Kiểm tra và lọc feeList theo state1 và state2
        if ($state1 == $state2) {
            $feeList = Fee::query()->where('fee_mode', '!=', 2)->get();
        } else {
            if ($state1 > $state2) {
                $feeList = Fee::query()->where('fee_mode', '!=', 1)->get();
            } else {
                $feeList = Fee::query()->where('fee_mode', '!=', 2)->get();
            }
        }

        $registration_rate = 0.02; // 2% phí trước bạ
        $registrationFee = number_format($this->calculateRegistrationFee(
                (int) str_replace(['.', ' VNĐ'], '', $product->price), $yearOfManufacture, $registration_rate
            ), 0, ',', '.') . " VNĐ";

        $total = (int) str_replace(['.', ' VNĐ'], '', $product->price); // Khởi tạo tổng

        foreach ($feeList as $item) {
            if ($item->fee_mode === self::REGISTRATION_FEE) {
                $item->fee_value = $registrationFee;
                $feeValueNumeric = (float) str_replace(['.', ' VNĐ'], '', $item->fee_value);
                $total += $feeValueNumeric;
            } else if ($item->fee_mode !== self::REGISTRATION_FEE && $item->fee_mode !== self::NO_FEE) {
                $item->fee_value = number_format($item->fee_value, 0, ',', '.') . " VNĐ";
                $feeValueNumeric = (float) str_replace(['.', ' VNĐ'], '', $item->fee_value);
                $total += $feeValueNumeric;
            } else {
                if ($fee1 != null && $item->id === intval($fee1)) {
                    $item->fee_value = number_format($item->fee_value, 0, ',', '.') . " VNĐ";
                    $feeValueNumeric = (float) str_replace(['.', ' VNĐ'], '', $item->fee_value);
                    $total += $feeValueNumeric;
                } else if ($fee2 != null && $item->id === intval($fee2)) {
                    $item->fee_value = number_format($item->fee_value, 0, ',', '.') . " VNĐ";
                    $feeValueNumeric = (float) str_replace(['.', ' VNĐ'], '', $item->fee_value);
                    $total += $feeValueNumeric;
                } else if ($fee3 != null && $item->id === intval($fee3)) {
                    $item->fee_value = number_format($item->fee_value, 0, ',', '.') . " VNĐ";
                    $feeValueNumeric = (float) str_replace(['.', ' VNĐ'], '', $item->fee_value);
                    $total += $feeValueNumeric;
                } else {
                    $item->fee_value = number_format($item->fee_value, 0, ',', '.') . " VNĐ";
                }
            }
        }

        // Định dạng tổng giá trị
        $totalFormatted = number_format($total, 0, ',', '.') . " VNĐ";

        return response()->json([
            'feeList' => $feeList,
            'total' => $totalFormatted,
            'fee1' => $fee1,
            'fee2' => $fee2,
            'fee3' => $fee3,
        ]);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    protected function calculateBank(Request $request)
    {
        // Lấy các giá trị đầu vào từ request
        $priceTotal = (int) str_replace(['.', ' VNĐ'], '', $request->get('priceTotal')); // Tổng giá trị sản phẩm
        $prepay = ((int) str_replace(['.', ' VNĐ'], '',  $request->get('prepay')) / $priceTotal) * 100; // Phần trăm trả trước
        $interestRate = (float) $request->get('interestRate'); // Lãi suất năm (phần trăm)
        $duration = (int) $request->get('duration'); // Thời hạn vay (số tháng)

        // Tính toán
        $prepayAmount = ($priceTotal * $prepay) / 100; // Số tiền trả trước
        $loanAmount = ($priceTotal - $prepayAmount) / $duration; // Số tiền gốc vay

        // Lãi suất hàng tháng
        $monthlyInterestRate = $interestRate / 12;

        // Tiền lãi hàng tháng (trả góp theo dư nợ giảm dần)
        $interest = $loanAmount * $monthlyInterestRate;

        // Tổng số tiền trả mỗi tháng
        $monthlyPayment = $loanAmount + $interest;

        // Trả về kết quả
        return response()->json([
            'total' => number_format($monthlyPayment, 0, ',', '.') . ' VNĐ', // Số tiền phải trả mỗi tháng
            'origin' => number_format($loanAmount, 0, ',', '.') . ' VNĐ', // Số tiền gốc vay
            'interest' => number_format($interest, 0, ',', '.') . ' VNĐ', // Số tiền lãi hàng tháng
        ]);
    }

    /**
     * @param $car_price
     * @param $manufacture_year
     * @param float $registration_rate
     * @return float|int
     */
    protected function calculateRegistrationFee($car_price, $manufacture_year, $registration_rate = 0.02) {
        // Tính tuổi xe
        $car_age = $this->calculateCarAge($manufacture_year);

        // Tính tỷ lệ khấu hao dựa trên tuổi xe
        $depreciation_rate = $this->getDepreciationRate($car_age);

        // Tính giá trị còn lại của xe
        $remaining_value = $car_price * $depreciation_rate;

        // Tính phí trước bạ
        $registration_fee = $remaining_value * $registration_rate;

        return $registration_fee;
    }

    /**
     * @param $manufacture_year
     * @return string
     */
    protected function calculateCarAge($manufacture_year) {
        $current_year = date("Y"); // Năm hiện tại
        return $current_year - $manufacture_year;
    }

    /**
     * @param $car_age
     * @return float
     */
    protected function getDepreciationRate($car_age) {
        if ($car_age < 1) {
            return 0.90; // 90% giá trị
        } elseif ($car_age >= 1 && $car_age < 3) {
            return 0.70; // 70% giá trị
        } elseif ($car_age >= 3 && $car_age < 6) {
            return 0.50; // 50% giá trị
        } elseif ($car_age >= 6 && $car_age < 10) {
            return 0.30; // 30% giá trị
        } else {
            return 0.20; // 20% giá trị
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

    public function storeInfo(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'product_id' => 'required'
        ]);

        $contact = $request->all();
        $contact['status'] = self::CONTACT_STATUS;
        $contact['note'] = "";

        ContactRequest::create($contact);

        return response()->json(['message' => 'Thông tin đã được lưu!'], 201);
    }
}
