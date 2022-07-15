<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'vendor_id',
        'discount_id',
        'user_id',
        'hasCustomMessage',
        'status',
    ];

    public const STATUS_DRAFT = 0;
    public const STATUS_PUBLISHED = 1;
}
