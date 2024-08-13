<?php


namespace App\Repositories\Status;


use App\Repositories\BaseRepository;

class StatusRepository extends BaseRepository implements StatusRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\ProductStatus::class;
    }
}
