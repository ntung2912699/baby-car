<?php


namespace App\Repositories\Fee;


use App\Repositories\BaseRepository;

class FeeRepository extends BaseRepository implements FeeRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Fee::class;
    }
}
