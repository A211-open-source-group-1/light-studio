<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class MBrandController extends Controller
{
    //
    public function brandIndex()
    {
        $brands= Brand::all();
        return view('admin.brand.index',compact('brands'));
    }

    public function listItemBrand($id)
    {
        $brand = Brand::find($id);
        if (!$brand) {
            return 'Không tìm thấy';
        }
        $brandItems = $brand->Phones()->select('*') ->withCount('Specifics')
        ->withCount('Colors')
        ->withCount('PhoneDetails')
        ->leftJoin('brand', 'brand.brand_id', '=', 'phones.brand_id')
        ->leftJoin('phone_category', 'phone_category.category_id', '=', 'phones.category_id')
        ->leftJoin('phone_os', 'phone_os.os_id', '=', 'phones.os_id')
        ->where('phones.brand_id', '=', $id)
        ->get();
        return response()->json([$brandItems]);
    }
    public function addBrand(Request $request)
    {
        try{
            $brand = new Brand();
            $brand->brand_name = $request->brand_name;
            $brand->brand_img = $request->brand_img;
            
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors('Có lỗi xảy ra. Vui lòng thử lại sau');
        }
    }
}
