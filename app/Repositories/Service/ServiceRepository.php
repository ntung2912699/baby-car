<?php


namespace App\Repositories\Service;


use App\Repositories\BaseRepository;

class ServiceRepository extends BaseRepository implements ServiceRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Service::class;
    }
}
