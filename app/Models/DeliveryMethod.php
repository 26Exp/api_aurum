<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryMethod extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'name_ru',
        'name_ro',
        'description_ru',
        'description_ro',
        'price'
    ];

    protected $casts = [
        'price' => 'float'
    ];
}
