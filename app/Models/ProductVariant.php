<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'product_variation_id',
        'option_id',
    ];
    protected $appends = array('option');
    public function getOptionAttribute()
    {
        return $this->hasOne(Option::class, 'id', 'option_id')->get();
    }

    public function compactMode(): int
    {
        return $this->id;
    }
}
