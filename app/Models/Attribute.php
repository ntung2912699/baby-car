<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'attribute';

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'name'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function spec()
    {
        return $this->hasMany(Attribute_spec::class);
    }
}
