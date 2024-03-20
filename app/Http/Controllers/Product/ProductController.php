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
            $products = PhoneDetails::all();
        } else {
            $brand = Brand::where('brand_id', '=', $brand_id)->first();
            $title = $brand->brand_name;
            $products = $brand->PhoneDetails()->paginate(2);
        }
        return view('product.products', compact('title', 'brands' ,'products'));
    }
}