<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Image;
use App\Models\Phone;
use App\Models\PhoneCategory;
use App\Models\PhoneDetails;
use App\Models\PhoneOs;
use App\Models\PhoneSpecs;
use DOMDocument;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use function PHPUnit\Framework\assertNotFalse;

class MProductController extends Controller
{
    public function index($type)
    {
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

    public function editPhone($phone_id)
    {
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

    public function editPhoneSubmit(Request $request)
    {
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
            'description' => $description
        ]);
        return redirect()->back();
    }

    public function editColors($phone_id)
    {
        $phone = Phone::where('phone_id', '=', $phone_id)->first();
        $colors = Color::select('*')
            ->leftJoin('phones', 'phones.phone_id', '=', 'phone_colors.phone_id')
            ->withCount('PhoneDetails')
            ->where('phones.phone_id', '=', $phone_id)
            ->get();
        return response()->json([$colors, $phone]);
    }

    public function editSpecifics($phone_id)
    {
        $phone = Phone::where('phone_id', '=', $phone_id)->first();
        $specs = PhoneSpecs::select('*')
            ->leftJoin('phones', 'phones.phone_id', '=', 'phone_specifics.phone_id')
            ->withCount('PhoneDetails')
            ->where('phones.phone_id', '=', $phone_id)
            ->get();
        return response()->json([$specs, $phone]);
    }

    public function editDetails($phone_id)
    {
        $phone = Phone::where('phone_id', '=', $phone_id)->first();
        $details = PhoneDetails::select('*')
            ->leftJoin('phones', 'phones.phone_id', '=', 'phone_details.phone_id')
            ->leftJoin('phone_colors', 'phone_details.color_id', '=', 'phone_colors.color_id')
            ->leftJoin('phone_specifics', 'phone_details.specific_id', '=', 'phone_specifics.specific_id')
            ->where('phones.phone_id', '=', $phone_id)
            ->get();
        return response()->json([$details, $phone]);
    }

    public function editSelectedColor($color_id)
    {
        $color = Color::select('*')
            ->where('color_id', '=', $color_id)
            ->first();
        return response()->json($color);
    }

    public function editSelectedSpecific($specs_id)
    {
        $specs = PhoneSpecs::select('*')
            ->where('specific_id', '=', $specs_id)
            ->first();
        return response()->json($specs);
    }

    public function addDetails($phone_id)
    {
        $phone = Phone::where('phone_id', '=', $phone_id)->first();
        $colors = $phone->Colors()->get();
        $specs = $phone->Specifics()->get();
        return response()->json([$colors, $specs]);
    }

    public function editSelectedDetails($detail_id)
    {
        $detail = PhoneDetails::select('*')
            ->leftJoin('phones', 'phones.phone_id', '=', 'phone_details.phone_id')
            ->leftJoin('phone_colors', 'phone_details.color_id', '=', 'phone_colors.color_id')
            ->leftJoin('phone_specifics', 'phone_details.specific_id', '=', 'phone_specifics.specific_id')
            ->where('phone_details_id', '=', $detail_id)
            ->first();
        $image = Image::where('phone_details_id', '=', $detail_id)
            ->get();
        $phone = $detail->parentPhone()->first();
        $colors = $phone->Colors()->get();
        $specs = $phone->Specifics()->get();
        return response()->json([$detail, $image, $colors, $specs]);
    }

    public function editSelectedColorSubmit(Request $request)
    {
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

    public function editSelectedSpecificSubmit(Request $request)
    {
        $specs = PhoneSpecs::where('specific_id', '=', $request->current_specs_id)->first();
        $specs->update([
            'specific_name' => $request->current_specs_name
        ]);
        $specs->save();
        return redirect()->back();
    }

    public function editSelectedDetailsSubmit(Request $request)
    {
        $current_phone = PhoneDetails::where('phone_details_id', '=', $request->details_id)->first();
        $current_phone->update([
            'color_id' => $request->color_id,
            'specs_id' => $request->specs_id,
            'screen' => $request->screen,
            'ram' => $request->ram,
            'rom' => $request->rom,
            'cpu' => $request->cpu,
            'front_cam' => $request->front_cam,
            'rear_cam' => $request->rear_cam,
            'bluetooth_ver' => $request->bluetooth_ver,
            'wifi_ver' => $request->wifi_ver,
            'nfc' => $request->nfc,
            'price' => $request->price,
            'quantity' => $request->quantity
        ]);

        if ($request->discount != null) {
            $current_phone->update([
                'discount' => $request->discount
            ]);
        } else {
            $current_phone->update([
                'discount' => 0
            ]);
        }

        if ($request->has('thumbnail')) {
            $thumbnail_path = public_path() . '/image/' . $current_phone->thumbnail_img;
            if (file_exists($thumbnail_path) && $current_phone->thumbnail_img != 'no_image.png') {
                File::delete($thumbnail_path);
            }
            $thumbnailFileName = 'thumbnail_' . uniqId() . '.' . $request->file('thumbnail')->extension();
            $request->file('thumbnail')->storeAs('image', $thumbnailFileName, 'imageUpload');
            $current_phone->update([
                'thumbnail_img' => $thumbnailFileName,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }

        if ($request->has('delete-details-img')) {
            foreach ($request->input('delete-details-img') as $deleteImage) {
                $path = public_path() . '\\image\\' . $deleteImage;
                if (file_exists($path)) {
                    File::delete($path);
                }
                $cDeleteImage = Image::where('file_path', '=', $deleteImage)->first();
                if ($cDeleteImage != null) {
                    $cDeleteImage->delete();
                }
                $current_phone->update([
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }
        }

        if ($request->file('file') != null) {
            foreach ($request->file('file') as $file) {
                $fileName = 'img' . uniqId() . '.' . $file->extension();
                $file->storeAs('image', $fileName, 'imageUpload');
                $image = new Image();
                $image->phone_details_id = $current_phone->phone_details_id;
                $image->file_path = $fileName;
                $image->save();
                $current_phone->update([
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }
        }
        return response()->json(['isEditDetailsSucceed' => true]);
    }

    public function addColorSubmit(Request $request)
    {
        $new_color = new Color();
        $new_color->phone_id = $request->phone_id;
        $new_color->color_name = $request->new_color_name;
        $new_color->save();
        return response()->json(['isSucceed' => true]);
    }

    public function addSpecificSubmit(Request $request)
    {
        try {
            $new_specs = new PhoneSpecs();
            $new_specs->phone_id = $request->phone_id;
            $new_specs->specific_name = $request->new_specs_name;
            $new_specs->save();
            return response()->json(['isSpecsAdded' => true]);
        } catch (Exception $ex) {
            return response()->json(['isSpecsAdded' => false]);
        }
    }

    public function addPhoneDetailsSubmit(Request $request)
    {
        $newDetails = new PhoneDetails();
        $newDetails->phone_id = 1;
        $newDetails->color_id = $request->color_id;
        $newDetails->specific_id = $request->specs_id;
        $newDetails->screen = $request->screen;
        $newDetails->ram = $request->ram;
        $newDetails->rom = $request->rom;
        $newDetails->front_cam = $request->front_cam;
        $newDetails->rear_cam = $request->rear_cam;
        $newDetails->bluetooth_ver = $request->bluetooth_ver;
        $newDetails->wifi_ver = $request->wifi_ver;
        $newDetails->nfc = $request->nfc;
        $newDetails->price = $request->price;
        $newDetails->quantity = $request->quantity;
        
        if ($request->discount != null) {
            $newDetails->discount = $request->discount;
        } else {
            $newDetails->discount = 0;
        }

        $thumbnailFileName = 'no_image.png';
        if ($request->file('thumbnail') != null) {
            $thumbnailFileName = 'thumbnail_' . uniqId() . '.' . $request->file('thumbnail')->extension();
            $request->file('thumbnail')->storeAs('image', $thumbnailFileName, 'imageUpload');
        }
        $newDetails->thumbnail_img = $thumbnailFileName;
        $newDetails->save();

        if ($request->file('file') != null) {
            foreach ($request->file('file') as $file) {
                $fileName = 'img' . uniqId() . '.' . $file->extension();
                $file->storeAs('image', $fileName, 'imageUpload');
                $image = new Image();
                $image->phone_details_id = $newDetails->phone_details_id;
                $image->file_path = $fileName;
                $image->save();
            }
        }

        return response()->json(['isAddDetailsSucceed' => true]);
    }

    public function addPhoneSubmit(Request $request)
    {
        $new_phone = new Phone();
        $new_phone->phone_name = $request->phone_name;
        $new_phone->brand_id = $request->brand_id;
        $new_phone->category_id = $request->category_id;
        $new_phone->os_id = $request->os_id;
        $description = $request->description;
        if ($description == '') {
            $description = '<p></p>';
        }
        $dom = new DOMDocument();
        $dom->encoding = 'utf-8';
        $dom->loadHTML(mb_convert_encoding($description, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $description = $dom->saveHTML();
        $new_phone->description = $description;
        $new_phone->save();
        return redirect()->back();
    }

    public function addPhone()
    {
        $os = PhoneOs::all();
        $brands = Brand::all();
        $categories = PhoneCategory::all();
        return response()->json([$brands, $categories, $os]);
    }

    public function deletePhone($phone_id)
    {
        try {
            $phone = Phone::where('phone_id', '=', $phone_id)->first();
            $phone->PhoneDetails()->delete();
            $phone->Specifics()->delete();
            $phone->Colors()->delete();
            $phone->delete();
            return response()->json(['isDeletePhoneSucceed' => true]);
        } catch (Exception $ex) {
            return response()->json(['isDeletePhoneSucceed' => false]);
        }
    }

    public function deleteDetails($details_id)
    {
        $delete_details = PhoneDetails::where('phone_details_id', '=', $details_id)->first();
        $images = $delete_details->childImages()->get();
        $thumbnail_path = public_path() . '\\image\\' . $delete_details->thumbnail_img;
        if (file_exists($thumbnail_path) && $delete_details->thumbnail_img != 'no_image.png') {
            File::delete($thumbnail_path);
        }
        foreach ($images as $image) {
            $path = public_path() . '\\image\\' . $image->file_path;
            if (file_exists($path)) {
                File::delete($path);
            }
            $image->delete();
        }
        $delete_details->childImages()->delete();
        $delete_details->OrderDetails()->delete();
        $delete_details->Reviews()->delete();
        $delete_details->Carts()->delete();
        $delete_details->delete();
        return response()->json(['isDeleteDetailsSucceed' => true]);
    }

    public function deleteColor($color_id)
    {
        try {
            $delete_color = Color::where('color_id', '=', $color_id)->first();
            $delete_color->delete();
            return response()->json(['isSucceed' => true]);
        } catch (Exception $ex) {
            return response()->json(['isDeleteColorSucceed' => false, 'errorMsg' => $ex->getMessage()]);
        }
    }

    public function deleteSpecific($specs_id)
    {
        try {
            $delete_specs = PhoneSpecs::where('specific_id', '=', $specs_id)->first();
            $delete_specs->delete();
            return response()->json(['isDeleteSpecsSucceed' => true]);
        } catch (Exception $ex) {
            return response()->json(['isDeleteSpecsSucceed' => false, 'errorMsg' => $ex->getMessage()]);
        }
    }
}