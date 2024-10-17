<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'product';

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'category_id',
        'producer_id',
        'model_id',
        'status_id',
        'name',
        'price',
        'cost_price', // Giá nhập
        'sale_price', // Giá bán
        'thumbnail',
        'gallery',
        'description'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function producer()
    {
        return $this->belongsTo(Producer::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function model()
    {
        return $this->belongsTo(ProductModel::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(ProductStatus::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function spec()
    {
        return $this->belongsToMany(Attribute_spec::class, 'product_attribute');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contact()
    {
        return $this->hasMany(ContactRequest::class);
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($product) {
            $product->spec()->detach();
        });
    }
}
