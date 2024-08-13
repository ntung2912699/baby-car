<?php


namespace App\Repositories\SocialAccount;


use App\Repositories\BaseRepository;

class SocialAccountRepository extends BaseRepository implements SocialAccountRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\SocialAccount::class;
    }
}
