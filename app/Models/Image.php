<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'path',
        'product_id',
        'is_main',
    ];

    protected $casts = [
        'is_main' => 'boolean',
    ];

    protected $appends = [
        'url',
    ];

   // Add custom attributes to your model
    public function getUrlAttribute()
    {
         return asset('images/uploads/' . $this->path);
    }
}
