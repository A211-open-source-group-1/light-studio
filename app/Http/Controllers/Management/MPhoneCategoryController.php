<?php

namespace App\Http\Controllers\Management;
use App\Models\PhoneCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Phone;

class MPhoneCategoryController extends Controller
{
    //
    public function index()
    {
        $phoneCategorys = PhoneCategory::all();
        
        return view('Admin.category.index',compact('phoneCategorys'));
    }
    public function listPhoneCategory($id)
    {
        $phoneCategorys = Phone:: select('*')
        ->withCount('Specifics')
        ->withCount('Colors')
        ->withCount('PhoneDetails')
        ->leftJoin('brand', 'brand.brand_id', '=', 'phones.brand_id')
        ->leftJoin('phone_category', 'phone_category.category_id', '=', 'phones.category_id')
        ->leftJoin('phone_os', 'phone_os.os_id', '=', 'phones.os_id')
        ->where('phones.category_id', '=', $id)
        ->get();
        return response()->json([$phoneCategorys]);
    }
}
