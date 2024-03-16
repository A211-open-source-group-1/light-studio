<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneDetails extends Model
{
    protected $table = 'phone_details';
    public $timestamps = false;
    function parentPhone() {
        return $this->belongsTo(Phone::class, 'phone_id', 'phone_id');
    }
}
