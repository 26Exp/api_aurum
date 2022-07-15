<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'path',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function getPathAttribute()
    {
        return '/images/uploads/'.$this->attributes['path'];
    }
}
