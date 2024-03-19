<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\PhoneDetails;
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
}
