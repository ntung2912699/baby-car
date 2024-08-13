<?php


namespace App\Repositories\Roles;


use App\Repositories\BaseRepository;

class RolesRepository extends BaseRepository implements RolesRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\UserRoles::class;
    }
}
