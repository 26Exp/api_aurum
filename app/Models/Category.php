<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'name_ru',
        'name_ro',
        'slug_ru',
        'slug_ro',
        'description_ru',
        'description_ro',
        'meta_title_ru',
        'meta_title_ro',
        'meta_description_ru',
        'meta_description_ro',
        'parent_id',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($model) {
            $model->slug_ru = Category::generateSlug($model->name_ru, 'ru');
            $model->slug_ro = Category::generateSlug($model->name_ro, 'ro');
        });
    }

    /**
     * @param string $value
     * @param string $lang
     * @return string
     */
    static function generateSlug(string $value, string $lang): string
    {
        $slug = Str::slug($value);
        $count = static::whereRaw("slug_$lang RLIKE '^{$slug}(-[0-9]+)?$'")->count();
        return $count ? "{$slug}-{$count}" : $slug;
    }
}
