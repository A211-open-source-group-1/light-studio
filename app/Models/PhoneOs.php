<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneOs extends Model
{
    protected $table = 'phone_os';
    protected $primaryKey = 'os_id';
    public $timestamps = false;

    public function Phones()
    {
        return $this->hasMany(Phone::class, 'os_id', 'os_id');
    }
}
