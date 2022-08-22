<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = ['order_id', 'amount', 'result', 'result_code', 'rrn', 'approval_code', 'card_number', 'ip', 'agent', 'all'];
    protected $casts = [
        'amount' => 'double',
    ];
}
