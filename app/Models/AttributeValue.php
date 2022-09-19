<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    use HasFactory;
    public const GOLD = 1;
    public const SILVER = 2;

    public $timestamps = false;

    protected $fillable = [
        'attribute_id',
        'name_ru',
        'name_ro',
    ];
}
