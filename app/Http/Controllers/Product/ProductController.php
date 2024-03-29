<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\PhoneDetails;
use App\Models\Brand;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function detail($phone_id, $detail_id, $spec_id = 0)
    {
        if ($spec_id != 0) {
            $current_details = PhoneDetails::where('specific_id', '=', $spec_id)->first();
        }
        else {
            $current_details = PhoneDetails::where('phone_details_id', '=', $detail_id)->first();
        }
        $other_details_specs = $current_details->parentPhone()->first()->Specifics()->get();
        $other_details_colors = $current_details->parentSpecific()->first()->detailsColorsOfThisSpecs();

        return view('product.detail', compact('phone_id', 'detail_id', 'current_details', 'other_details_colors', 'other_details_specs'));
    }

    public function products($brand_id) {
        
        $brands = Brand::all();
        if ($brand_id == 0) {
            $title = 'Tất cả sản phẩm';
            $products = PhoneDetails::paginate(16);
        } else {
            $brand = Brand::where('brand_id', '=', $brand_id)->first();
            $title = $brand->brand_name;
            $products = $brand->PhoneDetails()->paginate(16);
        }
        return view('product.products', compact('title', 'brands' ,'products'));
    }

    public function search($search_string) {
        $products = PhoneDetails::join('phones', 'phones.phone_id', '=' ,'phone_details.phone_id')
        ->join('phone_specifics', 'phone_specifics.specific_id', '=', 'phone_details.specific_id')
        ->where('phones.phone_name', 'like', '%' . $search_string . '%')
        ->orWhere('phone_specifics.specific_name', 'like', '%' . $search_string . '%')
        ->select('phone_details.*');
    }

    public function filter($brand, $priceRange, $os, $name, $price, $review) {

    }
}