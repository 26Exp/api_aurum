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
    protected $appends = [
        'name_ru',
        'name_ro',
    ];

    public function getnameRuAttribute()
    {
        $x = $this->hasOne(OptionTranslation::class, 'option_id', 'id')->where('locale', 'ru')->select('name', 'option_id');
        return $x->select('name')->first()['name'] ?? '';
    }

    public function getnameRoAttribute()
    {
        $x = $this->hasOne(OptionTranslation::class, 'option_id', 'id')->where('locale', 'ro')->select('name', 'option_id');
        return $x->select('name')->first()['name'] ?? '';
    }

}
