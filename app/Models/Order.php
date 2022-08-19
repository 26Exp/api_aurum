<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    use HasFactory;
    public const STATUS_PENDING = 0;
    public const STATUS_FAILED = 1;
    public const STATUS_NEW = 2;
    public const STATUS_PROCESSING = 3;
    public const STATUS_ON_HOLD = 4;
    public const STATUS_WAITING_FOR_PICKUP = 5;
    public const STATUS_SHIPPED = 6;
    public const STATUS_CANCELED = 7;
    public const STATUS_COMPLETED = 8;

    public const STATUS_LABELS = [
        self::STATUS_PENDING => 'Ожидает оплаты',
        self::STATUS_FAILED => 'Ошибка оплаты',
        self::STATUS_NEW => 'Новый',
        self::STATUS_PROCESSING => 'В обработке',
        self::STATUS_ON_HOLD => 'Ожидает подтверждения',
        self::STATUS_WAITING_FOR_PICKUP => 'Ожидает подтверждения',
        self::STATUS_SHIPPED => 'Отправлен',
        self::STATUS_CANCELED => 'Отменен',
        self::STATUS_COMPLETED => 'Завершен',
    ];

    protected $fillable = [
        'user_id',
        'address_id',
        'payment_method_id',
        'delivery_method_id',
        'promocode_id',
        'total_price',
        'status',
        'is_paid',
        'free_delivery',
        'is_created_by_admin',
    ];

    protected $casts = [
        'is_paid' => 'boolean',
        'free_delivery' => 'boolean',
        'is_created_by_admin' => 'boolean',
        'status' => 'integer',
        'address_id' => 'integer',
        'payment_method_id' => 'integer',
        'delivery_method_id' => 'integer',
        'promocode_id' => 'integer',
        'total_price' => 'float',
    ];


    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function address()
    {
        return $this->belongsTo(UserAddress::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function deliveryMethod()
    {
        return $this->belongsTo(DeliveryMethod::class);
    }

    public function promocode()
    {
        return $this->belongsTo(Promocode::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
