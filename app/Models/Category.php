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
    protected $casts = [
        'parent_id' => 'integer',
    ];
    protected $with = ['ru', 'ro'];

    public function ru()
    {
        return $this->hasOne(CategoryTranslation::class, 'category_id', 'id')->where('locale', 'ru');
    }

    public function ro()
    {
        return $this->hasOne(CategoryTranslation::class, 'category_id', 'id')->where('locale', 'ro');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function compactMode(): array
    {
        return [
            'id' => $this->id,
            'name_ru' => $this->ru->getName(),
        ];
    }

}
