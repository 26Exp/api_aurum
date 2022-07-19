<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProductTranslation extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'product_id',
        'locale',
        'name',
        'description',
        'meta_title',
        'meta_description',
        'out_of_stock_text',
        'slug',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->slug = ProductTranslation::generateSlug($model->name);
        });
    }

    /**
     * @param $value
     * @return string
     */
    static function generateSlug(string $value): string
    {
        $slug = Str::slug($value);
        $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
        return $count ? "{$slug}-{$count}" : $slug;
    }
}
