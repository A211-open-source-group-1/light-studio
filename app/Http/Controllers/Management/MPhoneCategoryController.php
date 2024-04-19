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

        return view('Admin.category.index', compact('phoneCategorys'));
    }
    public function listPhoneCategory($id)
    {
        $phoneCategorys = Phone::select('*')
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

    public function searchCategory($searchItem)
    {
        $phoneCategorys = PhoneCategory::where('category_name', 'like', '%' . $searchItem . '%')
            ->orWhere('category_id', 'like', '%' . $searchItem . '%')
            ->orWhere('category_description', 'like', '%' . $searchItem . '%')
            ->get();
       if ($phoneCategorys->isEmpty()) {
            $phoneCategorys = PhoneCategory::all();
            return response()->json($phoneCategorys);
        }
        return response()->json($phoneCategorys);
    }
    public function addCategory(Request $request)
    {
        $request->validate([
            'CategoryName' => 'required',

        ], [
            'CategoryName.required' => 'Vui lòng nhập tên loại sản phẩm.',
        ]);
        try {
            $phoneCategory = new PhoneCategory();
            $phoneCategory->category_name = $request->CategoryName;
            $phoneCategory->category_description = $request->descriptionCategory;
            $phoneCategory->save();
            return redirect()->back()->with('successful', 'Tạo thành công');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors('Có lỗi xảy ra. Vui lòng thử lại sau');
        }
    }
}
