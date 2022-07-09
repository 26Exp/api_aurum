<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['code', 'name'];
    public const LOCALE_RU = 'ru';
    public const LOCALE_RO = 'ro';
}
