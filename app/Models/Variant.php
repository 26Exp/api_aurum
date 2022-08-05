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
    ];

    protected $casts = [
        'product_id' => 'integer',
        'attribute_id' => 'integer',
        'attribute_value_id' => 'integer',
    ];

    protected $appends = ['attribute, attribute_value'];

    public function getAttributeAttribute()
    {
        return "$this->belongsTo(Attribute::class, 'attribute_id');";
    }
    public function getAttributeValueAttribute()
    {
        return "dw";
    }


}
