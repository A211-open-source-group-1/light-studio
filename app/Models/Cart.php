<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\PhoneDetails;

class cart extends Model
{
    protected $table = 'cart';
    protected $primaryKey = 'cart_id';
    public $timestamps = false;

    public function parentUser() {
        return $this->belongsTo(User::class, 'id', 'id');
    }

    public function parentPhoneDetails() {
        return $this->belongsTo(PhoneDetails::class, 'phone_details_id', 'phone_details_id');
    }
}
