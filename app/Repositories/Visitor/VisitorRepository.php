<?php


namespace App\Repositories\Visitor;


use App\Repositories\BaseRepository;

class VisitorRepository extends BaseRepository implements VisitorRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Visitor::class;
    }
}
