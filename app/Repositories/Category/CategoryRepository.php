<?php


namespace App\Repositories\Category;


use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\App;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{

    public function getModel()
    {
        return \App\Models\Category::class;
    }
}
