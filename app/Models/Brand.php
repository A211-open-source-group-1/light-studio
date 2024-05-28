<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PhoneDetails;

class Brand extends Model
{
    protected $table = 'brand';
    protected $primaryKey = 'brand_id';
    public $timestamps = false;

    public function Phones()
    {
        return $this->hasMany(Phone::class, 'brand_id', 'brand_id');
    }

    public function PhoneDetails()
    {
        $phones = Brand::where('brand_id', '=', $this->brand_id)->first()->Phones;
        // $products = collect();
        // foreach($phones as $phone) {
        //     $currentPhoneDetails = $phone->PhoneDetails()->get();
        //     foreach($currentPhoneDetails as $detail) {
        //         $products->push($detail->first());
        //     }
        // }
        $products = PhoneDetails::join('phones', 'phones.phone_id', '=', 'phone_details.phone_id')
            ->join('brand', 'brand.brand_id', '=', 'phones.brand_id')
            ->join('phone_colors', 'phone_colors.color_id', '=', 'phone_details.color_id')
            ->where('brand.brand_id', '=', $this->brand_id);
        return $products;
    }

}
