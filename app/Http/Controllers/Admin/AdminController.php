<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactRequest;
use App\Models\Product;
use App\Models\User;
use App\Models\Visitor;
use App\Repositories\Attribute\AttributeRepository;
use App\Repositories\AttributeSpec\AttributeSpecRepository;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Producer\ProducerRepository;
use App\Repositories\Product\ProductRepository;
use App\Repositories\ProductAttribute\ProductAttributeRepository;
use App\Repositories\Status\StatusRepository;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    const CONTACT_STATUS_NEW = 'Mới';
    const CONTACT_STATUS_OLD = 'Đã Kết Nối';

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
        $visitorTodayCount = Visitor::query()->whereDate('created_at', Carbon::today())->count();
        $visitorWeekCount = \App\Models\Visitor::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $visitorMonthCount = \App\Models\Visitor::whereMonth('created_at', Carbon::now()->month)->count();

        // Function format giá trực tiếp trong controller
        $formatPriceToNumber = function ($price) {
            // Loại bỏ ký tự không phải số
            $formattedPrice = preg_replace('/[^\d]/', '', $price);
            return (int) $formattedPrice;
        };

        // Tính ngày bắt đầu và kết thúc của tuần (tuần bắt đầu từ thứ 2)
        $startOfWeek = Carbon::now()->modify('last monday');  // Bắt đầu từ thứ 2
        $endOfWeek = Carbon::now()->modify('next sunday');    // Kết thúc vào chủ nhật

        // Lấy doanh thu của tuần
        $weeklyRevenue = Product::where('status_id', 6) // Xe đã bán (status_id = 6)
        ->whereBetween('updated_at', [$startOfWeek, $endOfWeek])
            ->get()
            ->sum(function ($product) use ($formatPriceToNumber) {
                return $formatPriceToNumber($product->price);
            });

        // Lấy doanh thu của tháng
        $monthlyRevenue = Product::where('status_id', 6)
            ->whereMonth('updated_at', Carbon::now()->month)
            ->get()
            ->sum(function ($product) use ($formatPriceToNumber) {
                return $formatPriceToNumber($product->price);
            });

        // Lấy doanh thu của quý
        $quarterStart = Carbon::now()->firstOfQuarter();
        $quarterEnd = Carbon::now()->lastOfQuarter();
        $quarterlyRevenue = Product::where('status_id', 6)
            ->whereBetween('updated_at', [$quarterStart, $quarterEnd])
            ->get()
            ->sum(function ($product) use ($formatPriceToNumber) {
                return $formatPriceToNumber($product->price);
            });

        // Tính lợi nhuận của tuần
        $weeklyProfit = Product::where('status_id', 6) // Xe đã bán (status_id = 6)
        ->whereBetween('updated_at', [$startOfWeek, $endOfWeek])
            ->get()
            ->sum(function ($product) use ($formatPriceToNumber) {
                // Tính lợi nhuận cho mỗi sản phẩm: giá bán - giá nhập
                $salePrice = $formatPriceToNumber($product->sale_price);
                $costPrice = $formatPriceToNumber($product->cost_price);
                return $salePrice - $costPrice;
            });

        // Tính lợi nhuận của tháng
        $monthlyProfit = Product::where('status_id', 6)
            ->whereMonth('updated_at', Carbon::now()->month)
            ->get()
            ->sum(function ($product) use ($formatPriceToNumber) {
                // Tính lợi nhuận cho mỗi sản phẩm: giá bán - giá nhập
                $salePrice = $formatPriceToNumber($product->sale_price);
                $costPrice = $formatPriceToNumber($product->cost_price);
                return $salePrice - $costPrice;
            });

        $quarterlyProfit = Product::where('status_id', 6)
            ->whereBetween('updated_at', [$quarterStart, $quarterEnd])
            ->get()
            ->sum(function ($product) use ($formatPriceToNumber) {
                // Tính lợi nhuận cho mỗi sản phẩm: giá bán - giá nhập
                $salePrice = $formatPriceToNumber($product->sale_price);
                $costPrice = $formatPriceToNumber($product->cost_price);
                return $salePrice - $costPrice;
            });

        $priceSum = Product::query()
            ->where('status_id', '!=', 6) // Điều kiện where cho xe chưa bán
            ->pluck('price') // Lấy tất cả giá trị của cột "price"
            ->map(function ($price) {
                // Xóa ký tự "đ" và các dấu chấm phân cách phần nghìn, sau đó chuyển thành số thực
                return (float) preg_replace('/[^\d]/', '', $price);
            })
            ->sum(); // Tính tổng

        $totalPrice = number_format($priceSum, 0, '', '.') . ' VNĐ';

        $contactRequest = ContactRequest::query()->orderBy('status', 'desc')->take(10)->get();
        $contactNew = self::CONTACT_STATUS_NEW;
        $contactOld = self::CONTACT_STATUS_OLD;

        return view('admin.page.dashboard.index', compact(
            'productCount',
            'userCount',
            'productSold',
            'productNew',
            'productNewCount',
            'totalPrice',
            'visitorTodayCount',
            'visitorWeekCount',
            'visitorMonthCount',
            'weeklyRevenue',
            'monthlyRevenue',
            'quarterlyRevenue',
            'weeklyProfit',
            'monthlyProfit',
            'quarterlyProfit',
            'contactRequest',
            'contactNew',
            'contactOld'
        ));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function checkSessionToken(Request $request) {
        $user = auth('sanctum')->user();

        if ($user) {
            return response()->json(['status' => 'success', 'message' => 'Token hợp lệ.']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Token không hợp lệ hoặc đã hết hạn.'], 401);
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function updateStatusContact(Request $request) {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'id' => 'required|exists:contact_requests,id',
        ]);

        // Tìm bản ghi cần cập nhật
        $contact = ContactRequest::find($request->id);

        // Cập nhật trạng thái
        if ($request->status) {
            $contact->status = $request->status;
        }
        if ($request->note) {
            $contact->note = $request->note;
        }
        // Lưu thay đổi
        $contact->save();

        return response()->json(['message' => 'Thông tin đã được lưu!'], 200);
    }
}
