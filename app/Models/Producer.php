<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producer extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'producer';

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'name',
        'logo'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function product()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function model()
    {
        return $this->hasMany(ProductModel::class);
    }
}
