<?php


namespace App\Repositories\Product;


use App\Models\Product;
use App\Repositories\BaseRepository;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    /**
     * fix max price use filter
     */
    const MAX_PRICE = 3000000000;

    public function getModel()
    {
        return \App\Models\Product::class;
    }

    /**
     * Lấy các sản phẩm liên quan dựa trên cùng category và producer.
     *
     * @param Product $product
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function relateProduct(Product $product)
    {
        // Lấy thông tin category và producer của sản phẩm hiện tại
        $categoryId = $product->category_id;
        $modelId = $product->model_id;
        $price = $product->producer_id;

        return $this->model
            ->where(function ($query) use ($categoryId, $modelId, $price) {
                $query->where('category_id', $categoryId)
                    ->orWhere('model_id', $modelId)
                    ->orWhere('price', '=', $price);
            })
            ->where('id', '!=', $product->id) // Loại trừ sản phẩm hiện tại
            ->take(3) // Hoặc sử dụng ->limit(3) để giới hạn số lượng kết quả
            ->get();
    }

    /**
     * Tìm kiếm sản phẩm theo từ khóa.
     *
     * @param string $query
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function searchProduct($query)
    {
        return $this->model
            ->where('name', 'like', '%' . $query . '%')
            ->where('status_id', '=', 1)
            ->orWhere('description', 'like', '%' . $query . '%')
            ->orWhere('price', 'like', '%' . $query . '%')
            ->orderBy('created_at', 'desc') // Sắp xếp kết quả theo ngày tạo, mới nhất trước
            ->paginate(12);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function searchByProducerId($id)
    {
        return $this->model
            ->where('producer_id', '=', $id)
            ->where('status_id', '=', 1)
            ->paginate(12);
    }

    /**
     * @param array $filters
     * @return mixed
     */
    public function search(array $filters)
    {
        $query = $this->model->newQuery();

        if (!empty($filters['query'])) {
            $query->where('name', 'LIKE', '%' . $filters['query'] . '%');
        }

        if (!empty($filters['producer'])) {
            $query->where('producer_id', $filters['producer']);
        }

        if (!empty($filters['model'])) {
            $query->where('model_id', $filters['model']);
        }

        if (!empty($filters['category'])) {
            $query->where('category_id', $filters['category']);
        }

        // Chuyển đổi giá trị tiền tệ thành số
        function parsePrice($price)
        {
            // Loại bỏ ký tự không phải số
            return (float) str_replace(['.', 'đ'], '', $price);
        }

        // Xử lý giá tiền
        $priceRangeMin = !empty($filters['price_range_min']) ? parsePrice($filters['price_range_min']) : null;
        $priceRangeMax = !empty($filters['price_range_max']) ? parsePrice($filters['price_range_max']) : null;

        // Tìm kiếm theo khoảng giá
        if ($priceRangeMin !== null && $priceRangeMax !== null) {
            if ($priceRangeMax > self::MAX_PRICE) {
                // Nếu max_price > 3 tỷ, tìm các sản phẩm có giá lớn hơn 3 tỷ
                $query->whereRaw('CAST(REPLACE(REPLACE(price, ".", ""), "đ", "") AS DECIMAL(20,2)) >= ?', [$priceRangeMin]);
            } else {
                // Tìm trong khoảng giá
                $query->whereRaw('CAST(REPLACE(REPLACE(price, ".", ""), "đ", "") AS DECIMAL(20,2)) BETWEEN ? AND ?', [$priceRangeMin, $priceRangeMax]);
            }
        }

        if (!empty($filters['start_year']) && !empty($filters['end_year'])) {
            $query->whereHas('spec', function($subQuery) use ($filters) {
                $subQuery->whereBetween('value', [$filters['start_year'], $filters['end_year']]);
            });
        }

        if (!empty($filters['spec'])) {
            $query->whereHas('spec', function($subQuery) use ($filters) {
                $subQuery->whereIn('attribute_spec.id', $filters['spec']);
            });
        }

        $query->where('status_id', '=', 1);

        return $query->paginate(12);
    }

    /**
     * @param $searchKey
     * @param $perPage
     * @param $sortFields
     * @param $sortOrder
     * @return mixed
     */
    public function searchMultipleColumnProduct($searchKey, $perPage, $sortFields, $sortOrder)
    {
        $query = $this->model->query();

        // Tìm kiếm trong các trường fillable, ngoại trừ các trường liên kết
        foreach ($this->model->getFillable() as $field) {
            if (!in_array($field, ['status_id', 'producer_id', 'category_id', 'model_id'])) {
                $query->orWhere('product.' . $field, 'like', '%' . $searchKey . '%');
            }
        }

        // Thực hiện join với các bảng liên quan và thêm điều kiện tìm kiếm theo tên
        $query->leftJoin('product_status', 'product_status.id', '=', 'product.status_id');

        $query->leftJoin('producer', 'producer.id', '=', 'product.producer_id');

        $query->leftJoin('category', 'category.id', '=', 'product.category_id');

        $query->leftJoin('product_model', 'product_model.id', '=', 'product.model_id');

        // Điều kiện tìm kiếm cho tên của các bảng liên kết
        $query->orwhere(function ($q) use ($searchKey) {
            $q->orWhere('product_status.name', 'like', '%' . $searchKey . '%')
                ->orWhere('producer.name', 'like', '%' . $searchKey . '%')
                ->orWhere('category.name', 'like', '%' . $searchKey . '%')
                ->orWhere('product_model.name', 'like', '%' . $searchKey . '%');
        });

        // Điều kiện tìm kiếm cho các trường trong bảng sản phẩm
        $query->orwhere(function ($q) use ($searchKey) {
            $q->orWhere('product.id', 'like', '%' . $searchKey . '%')
                ->orWhere('product.name', 'like', '%' . $searchKey . '%')
                ->orWhere('product.price', 'like', '%' . $searchKey . '%')
                ->orWhere('product.thumbnail', 'like', '%' . $searchKey . '%')
                ->orWhere('product.gallery', 'like', '%' . $searchKey . '%')
                ->orWhere('product.description', 'like', '%' . $searchKey . '%');
        });

        // Sắp xếp kết quả
        $query->orderBy('product.' . $sortFields, $sortOrder);

        // Phân trang kết quả
        return $query->paginate($perPage);
    }
}

