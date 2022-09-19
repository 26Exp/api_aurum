<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Attribute extends Model
{
    use HasFactory;

    public const SIZE = 1;
    public const MATERIAL = 2;

    public $timestamps = false;

    protected $fillable = [
        'name_ru',
        'name_ro',
        'slug_ru',
        'slug_ro',
        'is_filterable',
    ];

    protected $casts = [
        'is_filterable' => 'boolean',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($model) {
            $model->slug_ru = Attribute::generateSlug($model->name_ru, 'ru');
            $model->slug_ro = Attribute::generateSlug($model->name_ro, 'ro');
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function values()
    {
        return $this->hasMany(AttributeValue::class);
    }
}
