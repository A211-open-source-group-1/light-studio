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
        $request->validate([
            'brand_name' => 'required',
            'brand_img' => 'required|mimes:jpg,jpeg,png', 
        ], [
            'brand_name.required' => 'Vui lòng nhập tên',
            'brand_img.required' => 'Hình ảnh file phải là jpg, png, jpeg',
        ]);
    
        if ($request->hasFile('brand_img') && $request->file('brand_img')->isValid()) {
            $extension = $request->file('brand_img')->guessExtension();
            $allowedExtensions = ['jpg', 'png', 'jpeg'];
            if (!in_array($extension, $allowedExtensions)) {
                return "FILE LỖI - Phần mở rộng tệp không được phép.";
            }
    
            $originalFileName = $request->file('brand_img')->getClientOriginalName();
            $img = 'image' . time() . '-' . $request->brand_name . '-' . $originalFileName;
    
            $request->file('brand_img')->move(public_path('/image'), $img);
    
            try {
                $brand = new Brand();
                $brand->brand_name = $request->brand_name;
                $brand->brand_img = $img;
                $brand->brand_description = $request->brand_description;
                $brand->save();
    
             //   return redirect()->route('some.route')->with('success', 'Thương hiệu đã được thêm thành công!');
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->withErrors('Có lỗi xảy ra. Vui lòng thử lại sau');
            }
        } else {
            return redirect()->back()->withErrors('File không hợp lệ hoặc không tồn tại');
        }
    }
    
        

    public function searchBrands($term)
    {
        $brand = Brand::where('brand_id','like','%'.$term.'%')
        ->orWhere('brand_name','like','%'.$term.'%')
        ->orWhere('brand_description','like','%'.$term.'%');

        if($brand->isEmpty())
        {
            $brand = Brand::all();
        }
        return response()->json([$brand]);
    }
}
