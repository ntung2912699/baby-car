<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'service';

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'name',
        'param'
    ];
}
