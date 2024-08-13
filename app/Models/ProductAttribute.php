<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'product_attribute';

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'product_id',
        'attribute_spec_id'
    ];
}
