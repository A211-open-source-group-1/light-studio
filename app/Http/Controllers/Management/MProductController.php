<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Phone;
use App\Models\PhoneCategory;
use App\Models\PhoneDetails;
use App\Models\PhoneOs;
use DOMDocument;
use Exception;
use Illuminate\Http\Request;

class MProductController extends Controller
{
    public function index($type) {
        try {
            $jPhones = Phone::
            select('*')
            ->withCount('Specifics')
            ->withCount('Colors')
            ->withCount('PhoneDetails')
            ->leftJoin('brand', 'brand.brand_id', '=', 'phones.brand_id')
            ->leftJoin('phone_category', 'phone_category.category_id', '=', 'phones.category_id')
            ->leftJoin('phone_os', 'phone_os.os_id', '=', 'phones.os_id')
            ->where('phones.category_id', '=', $type)
            ->get();
            return view('admin.products.products', compact('jPhones'));
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function editPhone($phone_id) {
        $phone = Phone::
        select('*')
        ->leftJoin('brand', 'brand.brand_id', '=', 'phones.brand_id')
        ->leftJoin('phone_category', 'phone_category.category_id', '=', 'phones.category_id')
        ->leftJoin('phone_os', 'phone_os.os_id', '=', 'phones.os_id')
        ->where('phones.phone_id', '=', $phone_id)
        ->first();

        $brands = Brand::all();
        $categories = PhoneCategory::all();
        $phoneos = PhoneOs::all();
        
        return response()->json([$phone, $brands, $categories, $phoneos]);
    }

    public function editPhoneSubmit(Request $request) {
        $phone = Phone::where('phone_id', '=', $request->phone_id)
        ->first();
        $description = $request->description;
        $dom = new DOMDocument();
        $dom->encoding = 'utf-8';
        $dom->loadHTML(mb_convert_encoding($description, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $description = $dom->saveHTML();
        $phone->update([
            'phone_name' => $request->phone_name,
            'os_id' => $request->os_id,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'description' =>  $description
        ]);
        return redirect()->back();
    }

    public function editColors($phone_id) {
        $phone = Phone::where('phone_id', '=', $phone_id)->first();
        $colors = Color::select('*')
        ->leftJoin('phones', 'phones.phone_id', '=', 'phone_colors.phone_id')
        ->withCount('PhoneDetails')
        ->where('phones.phone_id', '=', $phone_id)
        ->get() ;
        return response()->json([$colors, $phone]);
    }

    public function editSpecifics($phone_id) {

    }

    public function editDetails($phone_id) {

    }

    public function editSelectedColor($color_id) {
        $color = Color::select('*')
        ->where('color_id', '=', $color_id)
        ->first();
        return response()->json($color);
    }

    public function editSelectedSpecific($specs_id) {

    }

    public function editSelectedDetails($detail_id) {

    }

    public function editSelectedColorSubmit(Request $request) {
        $color = Color::where('color_id', '=', $request->current_color_id)
        ->first();
        if ($color != null) {
            $color->update(
                [
                    'color_name' => $request->current_color_name
                ]
            );
        }
        return redirect()->back();
    }

    public function editSelectedSpecificSubmit(Request $request) {

    }

    public function editSelectedDetailsSubmit(Request $request) {

    }

    public function addColor($phone_id) {

    }

    public function addSpecific($phone_id) {

    }

    public function addDetails($phone_id) {

    }

    public function addColorSubmit(Request $request) {

    }

    public function addSpecificSubmit(Request $request) {

    }

    public function addDetailsSubmit(Request $request) {

    }

    public function deleteDetails($detail_id) {

    }

    public function deleteColor($color_id) {

    }

    public function deleteSpecific($specs_id) {

    }
}