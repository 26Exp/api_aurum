<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Vendor extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $appends = array('image');
    protected $hidden = array('image_id');
    protected $fillable = [
        'name',
        'slug',
        'image_id',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->slug = Vendor::generateSlug($model->name);
        });
    }

    public function getImageAttribute()
    {
        return Images::find($this->attributes['image_id']);
    }

    static function generateSlug($value)
    {
        $slug = Str::slug($value);
        $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
        return $count ? "{$slug}-{$count}" : $slug;
    }

}
