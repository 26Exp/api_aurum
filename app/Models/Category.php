<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'name_ru',
        'name_ro',
        'parent_id',
    ];

    public function scopeWithoutTimestamps()
    {
        $this->timestamps = false;
        return $this;
    }
}
