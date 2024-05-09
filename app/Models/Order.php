<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id ',
        'user_id ',
        'status_id ',
        'payment_method_id ',
        'order_date',
        'order_total_price',
        'order_address'
    ];
    protected $table = 'order';
    protected $primaryKey = 'order_id';
    public $timestamps = false;

    public function parentUser() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function OrderStatus() {
        return $this->hasMany(OrderStatus::class, 'status_id', 'status_id');
    }
    public function PaymentMeThod() {
        return $this->hasMany(PaymentMeThod::class, 'payment_method_id', 'payment_method_id');
    }

    
}
