<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;
    protected $fillable = [
        'status_id  ',
        'status_name ',
    ];

    protected $table = 'order_status';
    protected $primaryKey = 'status_id';
}
