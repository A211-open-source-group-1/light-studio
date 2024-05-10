<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        ' order_details_id',
        'order_id',
        'phone_details_id',
        'order_quantity',
        'total_price'
    ];

    protected $primaryKey = 'order_details_id';
    protected $table = 'order_details';
    public $timestamps = false;
    public function parentOrder()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }
    public function PhoneDetails()
    {
        return $this->hasMany(PhoneDetails::class, 'phone_details_id', 'phone_details_id');
    }
}
