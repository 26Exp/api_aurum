<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupProduct extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'group_id',
        'product_id',
    ];
}
