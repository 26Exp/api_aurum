<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['category_id', 'name', 'locale', 'slug', 'description', 'meta_title', 'meta_description'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getName(): string
    {
        return $this->name;
    }
}
