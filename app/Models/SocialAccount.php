<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'social_account';

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'token',
        'profile_id'
    ];
}
