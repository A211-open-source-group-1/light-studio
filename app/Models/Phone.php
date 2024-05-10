<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $fillable = [
        'phone_name',
        'description',
        'os_id',
        'category_id',
        'brand_id'
    ];
    protected $table = 'phones';
    protected $primaryKey = 'phone_id';

    function PhoneDetails() {
        return $this->hasMany(PhoneDetails::class, 'phone_id', 'phone_id');
    }

    public function parentCategory() {
        return $this->belongsTo(PhoneCategory::class, 'category_id', 'category_id');
    }

    public function parentBrand() {
        return $this->belongsTo(Brand::class, 'brand_id', 'brand_id');
    }

    public function parentOs() {
        return $this->belongsTo(PhoneOs::class, 'os_id', 'os_id');
    }

    function Specifics() {
        return $this->hasMany(PhoneSpecs::class, 'phone_id', 'phone_id');
    }

    function Colors() {
        return $this->hasMany(Color::class, 'phone_id', 'phone_id');
    }
}
