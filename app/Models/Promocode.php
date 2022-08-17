<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promocode extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'code',
        'discount',
        'active',
        'is_percentage',
        'multiple_use',
        'uses',
        'max_uses',
        'users',
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
        'is_percentage' => 'boolean',
        'multiple_use' => 'boolean',
        'users' => 'array',
    ];

    protected $dates = [
        'expires_at',
        'users',
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
