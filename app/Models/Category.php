<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'parent_id',
    ];

    public function translations()
    {
        return $this->hasMany(CategoryTranslation::class);
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function byLanguage(Language $language)
    {
        return $this->translations()->where('locale', $language->code)->get();
    }


//    public function products()
//    {
//        return $this->belongsToMany(Product::class);
//    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * @return Model|\Illuminate\Database\Eloquent\Relations\HasMany|object|null
     */
    public function getTranslated()
    {
        return $this->translations()->where('locale', App::getLocale())->first();
    }

}
