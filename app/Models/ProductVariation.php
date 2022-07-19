<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'product_id',
        'sku',
        'stock',
        'price',
    ];
    protected $appends = array('variants');
    public function getVariantsAttribute()
    {
        return $this->hasMany(ProductVariant::class, 'product_variation_id', 'id')->get();
    }

    public function compactMode(): array
    {
        return [
                'id' => $this->id,
                'sku' => $this->sku,
                'stock' => $this->stock,
                'price' => $this->price,
                'options' => $this->variants->map(function ($variant) {
                    return $variant->compactMode();
                })->toArray(),
            ];
    }
}
