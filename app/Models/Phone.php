<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $table = 'phones';
    public $timestamps = false;

    function PhoneDetails() {
        return $this->hasMany(PhoneDetails::class, 'phone_id', 'phone_id');
    }

    
}
