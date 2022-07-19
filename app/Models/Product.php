<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'vendor_id',
        'discount_id',
        'user_id',
        'hasCustomMessage',
        'status',
    ];

    protected $casts = [
        'category_id' => 'integer',
        'vendor_id' => 'integer',
        'discount_id' => 'integer',
        'user_id' => 'integer',
        'hasCustomMessage' => 'boolean',
        'status' => 'integer',
    ];

    public const STATUS_DRAFT = 0;
    public const STATUS_PUBLISHED = 1;
    public const STATUSES = [
        self::STATUS_DRAFT,
        self::STATUS_PUBLISHED,
    ];

    protected $appends = array('translation', 'variations');

    public function getTranslationAttribute()
    {
        return $this->hasMany(ProductTranslation::class, 'product_id', 'id')->get();
    }

    public function getVariationsAttribute()
    {
        return $this->hasMany(ProductVariation::class, 'product_id', 'id')->get();
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->user_id = Auth::id();
        });
    }

    public function compactMode(): array
    {
        $response = [
            'id' => $this->id,
            'category' => $this->category_id,
            'vendor_id' => $this->vendor_id,
            'status' => $this->status,
            'hasCustomMessage' => $this->hasCustomMessage,
            'discount_id' => $this->discount_id ?? null,
        ];
        foreach ($this->translation as $translation) {
            $response['name_' . $translation->locale] = $translation->name;
            $response['description_' . $translation->locale] = $translation->description;
            $response['meta_title_' . $translation->locale] = $translation->meta_title;
            $response['meta_description_' . $translation->locale] = $translation->meta_description;
            $response['out_of_stock_text_' . $translation->locale] = $translation->out_of_stock_text;
            $response['slug_' . $translation->locale] = $translation->slug;
        }

        $response['variations'] = [];
        foreach ($this->variations as $variation) {
            $response['variations'][] = $variation->compactMode();
        }

        return $response;
    }
}
