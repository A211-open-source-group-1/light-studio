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
        $brands = Brand::all();
        return view('admin.brand.index', compact('brands'));
    }

    public function listItemBrand($id)
    {
        $brand = Brand::find($id);
        if (!$brand) {
            return 'Không tìm thấy';
        }
        $brandItems = $brand->Phones()->select('*')->withCount('Specifics')
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
        $mess = "";
        if ($request->hasFile('brand_img') && $request->file('brand_img')->isValid()) {

            $extension = $request->file('brand_img')->guessExtension();
            $allowedExtensions = ['jpg', 'png', 'jpeg'];
            if (!in_array($extension, $allowedExtensions)) {
                $mess = "FILE PHẢI LÀ .JPG, .PNG , .JPEG";
                return redirect()->back()->with('mess', $mess);
            }
            $fileSize = $request->file('brand_img')->getSize() / 1024 / 1024;
            if ($fileSize > 25) {
                $mess = "FILE ẢNH PHẢI CÓ KÍCH THƯỚC DƯỚI 25MB";
                return redirect()->back()->with('mess', $mess);
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
                return redirect()->back();
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->withErrors('Có lỗi xảy ra. Vui lòng thử lại sau');
            }
        } else {
            return redirect()->back()->withErrors('File không hợp lệ hoặc không tồn tại');
        }
    }

    public function loadModalBrand($id)
    {
        $brand= Brand::where('brand_id','=',$id)->first();
        if($brand)
        {
            return response()->json($brand);
        }
        return response()->json('loi');

    }
    public function editBrand(Request $request)
    {
        $request->validate([
            'brandName' => 'required',
        ], [
            'brandName.required' => 'Vui lòng nhập tên loại sản phẩm.',
        ]);
        try {
            $brandItems = Brand::where('brand_id','=',$request->brand_id)->first();
            $brandItems->brand_name = $request->brandName;
            $brandItems->brand_description = $request->brandDescription;
            $brandItems->save();
            return redirect()->back()->with('successful', 'Sửa thành công');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors('Có lỗi xảy ra. Vui lòng thử lại sau');
        }     
    

    }

    public function searchBrand($term)
    {
        $brand = Brand::where('brand_id', 'like', '%' . $term . '%')
            ->orWhere('brand_name', 'like', '%' . $term . '%')
            ->orWhere('brand_description', 'like', '%' . $term . '%')->get();

        if ($brand->isEmpty()) {
            $brand = Brand::all();
            return response()->json($brand);
        }
        return response()->json($brand);
    }
    public function deleteBrand(Request $request)
    {
        try {

            $brand = Brand::find($request->deleteBrandID);
            if (!$brand) {
                throw new \Exception('Brand không tìm thấy' . $request->deleteBrandID);
            }
            $brand->delete();
            $message = "Xóa thành công ".$brand->brand_id;    
            return redirect()->back()->with('mess',$message);
        } catch (\Exception $e) {
            $message = "Xóa không thành công: " . $e->getMessage();
            return redirect()->back()->with('mess',$message);
        }
    }
}
