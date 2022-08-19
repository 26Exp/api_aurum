<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['order_id', 'product_id', 'variation_id', 'quantity', 'price', 'total'];
    protected $casts = [
        'order_id' => 'integer',
        'product_id' => 'integer',
        'variation_id' => 'integer',
        'quantity' => 'integer',
        'price' => 'float',
        'total' => 'float',
    ];
}
