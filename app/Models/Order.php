<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'user_id',
        'receiver_name',
        'receiver_address',
        'receiver_phone',
        'status_id',
        'payment_method_id ',
        'order_date',
        'order_proceed_date',
        'order_delivering_date',
        'order_delivered_date',
        'order_total_price',
        'order_address'
    ];
    protected $table = 'order';
    protected $primaryKey = 'order_id';
    public $timestamps = false;

    public function parentUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function OrderStatus()
    {
        return $this->belongsTo(OrderStatus::class, 'status_id', 'status_id');
    }
    public function PaymentMeThod()
    {
        return $this->belongsTo(PaymentMeThod::class, 'payment_method_id', 'payment_method_id');
    }

    public function OrderDetails() {
        return $this->hasMany(OrderDetails::class, 'order_id', 'order_id');
    }
}
