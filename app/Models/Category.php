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
    protected $with = ['translations'];

    public function translations()
    {
        return $this->hasMany(CategoryTranslation::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
