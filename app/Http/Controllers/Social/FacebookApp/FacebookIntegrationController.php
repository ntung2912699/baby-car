<?php

namespace App\Http\Controllers\Social\FacebookApp;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repositories\Product\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FacebookIntegrationController extends Controller
{
    /**
     * @var ProductRepository
     */
    protected $productRepository;


    public function __construct(
        ProductRepository $productRepository
    )
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        $productList = Product::query()->where('status_id', '=', 1)->paginate(5);
        return view('client.social.facebook.post_form', compact(
            'productList'
        ));
    }

    public function postToFacebook(Request $request)
    {
        $productIds = $request->input('products'); // Mảng các ID sản phẩm
        $products = Product::whereIn('id', $productIds)->get();

        $postResults = [];
        foreach ($products as $product) {
            $result = $this->postToFacebookApi($product);
            $postResults[] = $result;
        }

        $successCount = count(array_filter($postResults, fn($result) => !isset($result['error'])));
        $errorCount = count(array_filter($postResults, fn($result) => isset($result['error'])));

        $message = "{$successCount} bài viết đã được xuất bản thành công!";
        if ($errorCount > 0) {
            $message .= " {$errorCount} bài viết không xuất bản được.";
        }

        return redirect()->route('facebook.integration-post')->with('status', $message);
    }

    protected function postToFacebookApi($product)
    {
        // Thay thế bằng thông tin của bạn
        $accessToken = 'EAAMM0EQe3jwBO3Cz1L0SPyTm4xStKV7d4PP9BZA9foHxxA2JzBDwZCBuRU0frd6ZBcLWxUnkNs2HZCNiQDFmXSy7eSFCegARflSHIH3GccefuBMPA9pv9l2pCGICSw1WRhCRZAWLjuXtYzcpQVi2GXKEF4JQOSO3OSgZA6XnnuTmWS3K2r4eWQbTmE9dkGdTV34qOwRRZADZAWfIzZB7raTu7nhwhSbmFBVdTSGQ2LvsnHC2H3qvlfLWDubG3ZBDrKnKQ9NDJ7eZBFz9bMZD';
        $pageId = '469340602557693';

        $imageUrls = explode('|', $product->gallery);

        foreach ($imageUrls as $imageUrl) {
            $response = Http::withToken($accessToken)->post("https://graph.facebook.com/{$pageId}/photos", [
                'caption' => $product->description,
                'url' => $imageUrl,
                'access_token' => $accessToken
            ]);

            if ($response->failed()) {
                return ['error' => $response->json()]; // Trả về lỗi nếu có
            }
        }

        $message = $product->description;
        $link = $product->gallery;

        $response = Http::withToken($accessToken)->post("https://graph.facebook.com/{$pageId}/feed", [
            'message' => $message,
            'link' => $link,
            'access_token' => $accessToken
        ]);

        if ($response->failed()) {
            return ['error' => $response->json()]; // Trả về lỗi nếu có
        }

        return ['success' => true]; // Trả về thành công nếu không có lỗi
    }

    public function show($id)
    {
        $product = $this->productRepository->find($id);
        return response()->json([
            'name' => $product->name,
            'thumbnail' => $product->thumbnail,
            'description' => $product->description,
        ]);
    }
}
