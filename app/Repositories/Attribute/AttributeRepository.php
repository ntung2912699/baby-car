<?php


namespace App\Repositories\Attribute;


use App\Repositories\BaseRepository;

class AttributeRepository extends BaseRepository implements AttributeRepositoryInterface
{

    public function getModel()
    {
        return \App\Models\Attribute::class;
    }
}
