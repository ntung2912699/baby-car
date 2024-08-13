<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute_spec extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'attribute_spec';

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'attribute_id',
        'value'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function product()
    {
        return $this->belongsToMany(Product::class, 'product_attribute');
    }
}
