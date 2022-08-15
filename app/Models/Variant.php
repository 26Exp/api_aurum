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
        'attribute_id',
        'attribute_value_id',
        'price',
        'stock',
        'sku',
    ];

    protected $casts = [
        'product_id' => 'integer',
        'attribute_id' => 'integer',
        'attribute_value_id' => 'integer',
        'price' => 'float',
        'stock' => 'integer',
        'sku' => 'string',
    ];

    protected $appends = [
        'slug_ro',
        'slug_ru',
        'attribute',
        'value',
    ];

    public function getAttributeAttribute()
    {
        return $this->attribute()->first();
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }

    public function getValueAttribute()
    {
        return $this->value()->first();
    }

    public function value()
    {
        return $this->belongsTo(AttributeValue::class, 'attribute_value_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function getSlugRoAttribute()
    {
        return $this->product()->pluck('slug_ro')->first();
    }

    public function getSlugRuAttribute()
    {
        return $this->product()->pluck('slug_ru')->first();
    }
}
