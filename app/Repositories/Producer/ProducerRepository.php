<?php


namespace App\Repositories\Producer;


use App\Repositories\BaseRepository;

class ProducerRepository extends BaseRepository implements ProducerRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Producer::class;
    }
}
