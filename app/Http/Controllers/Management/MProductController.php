<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Brand;
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
        $phone = Phone::where('phone_id', '=', 1)
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
}
