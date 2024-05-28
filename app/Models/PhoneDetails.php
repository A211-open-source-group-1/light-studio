<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PhoneSpecs;
use App\Models\Color;
use App\Models\Image;

class PhoneDetails extends Model
{
    protected $fillable = [
        'phone_id',
        'specific_id',
        'color_id',
        'screen',
        'ram',
        'rom',
        'cpu',
        'front_cam',
        'rear_cam',
        'bluetooth_ver',
        'wifi_ver',
        'nfc',
        'price',
        'discount',
        'quantity',
        'thumbnail_img',
        'updated_at'
    ];

    protected $table = 'phone_details';
    protected $primaryKey = 'phone_details_id';
    public function parentPhone()
    {
        return $this->belongsTo(Phone::class, 'phone_id', 'phone_id');
    }

    public function parentColor()
    {
        return $this->belongsTo(Color::class, 'color_id', 'color_id');
    }

    public function parentSpecific()
    {
        return $this->belongsTo(PhoneSpecs::class, 'specific_id', 'specific_id');
    }

    public function childImages()
    {
        return $this->hasMany(Image::class, 'phone_details_id', 'phone_details_id');
    }

    public function siblingsWithColors()
    {
        $siblings = PhoneDetails::where('phone_details.phone_id', '=', $this->phone_id)->join('phone_colors', 'phone_details.color_id', '=', 'phone_colors.color_id')->get();
        return $siblings;
    }

    public function Reviews()
    {
        return $this->hasMany(Review::class, 'phone_details_id', 'phone_details_id');
    }

    public function OrderDetails()
    {
        return $this->hasMany(OrderDetails::class, 'phone_details_id', 'phone_details_id');
    }

    public function Carts()
    {
        return $this->hasMany(Cart::class, 'phone_details_id', 'phone_details_id');
    }

}
