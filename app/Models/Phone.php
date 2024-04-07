<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $fillable = [
        'phone_name',
        'description'
    ];
    protected $table = 'phones';
    protected $primaryKey = 'phone_id';
    public $timestamps = false;

    function PhoneDetails() {
        return $this->hasMany(PhoneDetails::class, 'phone_id', 'phone_id');
    }

    function Specifics() {
        return $this->hasMany(PhoneSpecs::class, 'phone_id', 'phone_id');
    }

    function Colors() {
        return $this->hasMany(Color::class, 'phone_id', 'phone_id');
    }

    function parentBrand() {
        return $this->belongsTo(Brand::class, 'brand_id', 'brand_id');
    }
}
