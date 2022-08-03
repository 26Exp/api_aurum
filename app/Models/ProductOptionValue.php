<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOptionValue extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'option_id',
        'locale',
        'name',
    ];

}
