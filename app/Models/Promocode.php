<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promocode extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'discount',
        'active',
        'uses',
        'max_uses',
        'expires_at',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'active' => 'boolean',
        'uses' => 'integer',
        'max_uses' => 'integer',
        'expires_at' => 'datetime',
        'discount' => 'integer',
    ];

    protected $dates = [
        'expires_at',
    ];

    protected static function boot()
    {
        parent::boot();
        self::created(function ($model) {
            $model->uses = 0;
            $model->code = strtoupper($model->code);
        });

        self::updated(function ($model) {
            $model->code = strtoupper($model->code);
        });
    }
}
