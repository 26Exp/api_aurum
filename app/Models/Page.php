<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_ru',
        'title_ro',
        'slug_ru',
        'slug_ro',
        'content_ru',
        'content_ro',
        'meta_title_ru',
        'meta_title_ro',
        'meta_description_ru',
        'meta_description_ro',
    ];

    protected $hidden = [
        'content_ru',
        'content_ro',
        'created_at',
        'updated_at',
        'meta_title_ru',
        'meta_title_ro',
        'meta_description_ru',
        'meta_description_ro',
    ];


    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug_ru = Page::generateSlug($model->title_ru, 'ru');
            $model->slug_ro = Page::generateSlug($model->title_ro, 'ro');
            $model->content_ru = htmlentities($model->content_ru);
            $model->content_ro = htmlentities($model->content_ro);
        });

        static::updating(function ($model) {
            $model->content_ru = htmlentities($model->content_ru);
            $model->content_ro = htmlentities($model->content_ro);
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
