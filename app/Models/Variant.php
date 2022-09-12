<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'product_id',
        'price',
        'stock',
        'sku',
        'name',
    ];

    protected $casts = [
        'name' => 'string',
        'product_id' => 'integer',
        'price' => 'float',
        'stock' => 'integer',
        'sku' => 'string',
    ];

    protected $appends = [
        'attributes',
    ];

    public function getAttributesAttribute()
    {
        return $this->attributes()->get();
    }

    public function attributes()
    {
        return $this->hasMany(Variation::class, 'variant_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    protected static function booted()
    {
        static::created(function ($variant) {
            $variant->product->calculatePrice();
        });

        static::updated(function ($variant) {
            $variant->product->calculatePrice();
        });

    }

}
