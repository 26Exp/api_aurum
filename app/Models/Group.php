<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Group extends Model
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
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->slug_ro = Group::generateSlug($model->name_ro, 'ro');
            $model->slug_ru = Group::generateSlug($model->name_ro, 'ru');
        });
    }

    static function generateSlug(string $value, string $lang): string
    {
        $slug = Str::slug($value);
        $count = static::whereRaw("slug_$lang RLIKE '^{$slug}(-[0-9]+)?$'")->count();
        return $count ? "{$slug}-{$count}" : $slug;
    }
}
