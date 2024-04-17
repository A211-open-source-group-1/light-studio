<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;
    protected $fillable = [
        'payment_method_id ',
        'payment_method_name',
     
    ];

    protected $primaryKey = 'payment_method_id';
    protected $table = 'payment_method';

}
