<?php


namespace App\Repositories\Product;


use App\Repositories\RepositoryInterface;
use App\Models\Product;

interface ProductRepositoryInterface extends RepositoryInterface
{
    public function relateProduct(Product $product);

    public function searchMultipleColumnProduct($searchKey, $perPage, $sortFields, $sortOrder);
}
