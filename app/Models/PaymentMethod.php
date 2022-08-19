<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    public const STATUS_ACTIVE = 1;
    public const STATUS_INACTIVE = 0;

    public const CASH = 1;
    public const CARD = 2;


    public $timestamps = false;

    protected $fillable = [
        'name_ru',
        'name_ro',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

}
