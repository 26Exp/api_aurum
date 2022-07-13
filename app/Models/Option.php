<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\App;

class Option extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'category_id',
    ];
    protected $casts = [
        'category_id' => 'integer',
    ];
    protected $with = ['OptionTranslations'];

    public function OptionTranslations(): HasMany
    {
        return $this->hasMany(OptionTranslation::class);
    }
}
