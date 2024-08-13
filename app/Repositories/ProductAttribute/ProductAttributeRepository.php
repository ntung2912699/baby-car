<?php


namespace App\Repositories\ProductAttribute;


use App\Repositories\BaseRepository;

class ProductAttributeRepository extends BaseRepository implements ProductAttributeRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\ProductAttribute::class;
    }
}

