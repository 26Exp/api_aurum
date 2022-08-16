<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use function PHPUnit\Framework\isEmpty;

class Product extends Model
{
    use HasFactory;

    public const STATUS_DRAFT = 0;
    public const STATUS_PUBLISHED = 1;
    public const HAS_VARIATION = true;
    public const HAS_NO_VARIATION = false;
    public const HAS_DISCOUNT = true;
    public const HAS_NO_DISCOUNT = false;
    public const HAS_BADGE = true;
    public const HAS_NO_BADGE = false;
    public const HAS_IMAGE = true;

    public const STATUSES = [
        self::STATUS_DRAFT => 'Draft',
        self::STATUS_PUBLISHED => 'Published',
    ];

    protected $fillable = [
        'name_ru',
        'name_ro',
        'slug_ru',
        'slug_ro',
        'description_ru',
        'description_ro',
        'meta_title_ru',
        'meta_description_ru',
        'meta_title_ro',
        'meta_description_ro',
        'price',
        'sale_price',
        'sku',
        'stock',
        'status',
        'has_variation',
        'manufacturer_id',
        'category_id',
        'weight',
        'has_custom_msg',
        'out_of_stock_text_ro',
        'out_of_stock_text_ru',
    ];

    protected $casts = [
        'has_variation' => 'boolean',
        'has_discount' => 'boolean',
        'has_badge' => 'boolean',
        'has_image' => 'boolean',
        'status' => 'integer',
        'manufacturer_id' => 'integer',
        'category_id' => 'integer',
        'price' => 'float',
        'stock' => 'integer',
        'sale_price' => 'float',
        'images' => 'array',
        'sku' => 'integer',
        'weight' => 'float',
        'has_custom_msg' => 'boolean',
    ];

    protected $appends = [
        'images',
        'variants',
    ];

    public function getImagesAttribute()
    {
        return $this->images()->count() ? $this->images()->get() :
            [
                'id' => null,
                'path' => null,
                'is_main' => true,
                'is_dummy' => true,
                'url' => 'https://dummyimage.com/600x600/a1a1a1/fff',
            ];
    }

    public function getManufacturerAttribute()
    {
        return $this->manufacturer()->first();
    }

    public function getCategoryAttribute()
    {
        return $this->category()->first();
    }

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($model) {
            $model->slug_ru = Product::generateSlug($model->name_ru, 'ru');
            $model->slug_ro = Product::generateSlug($model->name_ro, 'ro');
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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

/**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function variants(): HasMany
    {
        return $this->hasMany(Variant::class);
    }

    public function getVariantsAttribute()
    {
        return $this->variants()->get();
    }


    public function attachImages(array $images): Product
    {
        $imagesArray = [];
        $isMain = true;
        foreach ($images as $image_id) {
            $temporaryImage = TemporaryImage::find((int)$image_id);
            $imagesArray[] = [
                'path' => $temporaryImage->path,
                'is_main' => $isMain,
                'is_dummy' => false,
            ];
            $temporaryImage->delete();
            $isMain = false;
        }

        $this->images()->createMany($imagesArray);

        return $this;
    }

}
