<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\PhoneDetails;
use App\Models\Brand;
use App\Models\Phone;
use Illuminate\Support\Facades\Auth;

use App\Models\Review;
use Carbon\Carbon;
use DOMDocument;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function detail($phone_id, $detail_id, $spec_id = 0)
    {
        if ($spec_id != 0) {
            $current_details = PhoneDetails::where('specific_id', '=', $spec_id)->first();
        } else {
            $current_details = PhoneDetails::where('phone_details_id', '=', $detail_id)->first();
        }
        $other_details_specs = $current_details->parentPhone()->first()->Specifics()->get();
        $other_details_colors = $current_details->parentSpecific()->first()->detailsColorsOfThisSpecs();
        $images = $current_details->childImages()->get();
        $reviews = $current_details->Reviews()->get();

        $other_phone_details = PhoneDetails::
        take(10)
        ->get()
        ->sortByDesc('created_at');

        return view('product.detail', compact('phone_id', 'detail_id', 'current_details', 'other_details_colors', 'other_details_specs', 'images', 'reviews', 'other_phone_details'));
    }

    public function products($brand_id)
    {
        session(['search' => null]);
        $brands = Brand::all();
        if ($brand_id == 0) {
            $title = 'Tất cả sản phẩm';
            $products = PhoneDetails::join('phones', 'phones.phone_id', '=', 'phone_details.phone_id')
                ->join('phone_specifics', 'phone_specifics.specific_id', '=', 'phone_details.specific_id')
                ->join('phone_colors', 'phone_colors.color_id', 'phone_details.color_id')
                ->where('phones.category_id', '=', 2)
                ->paginate(16);
        } else {
            $brand = Brand::where('brand_id', '=', $brand_id)->first();
            $title = $brand->brand_name;
            $products = $brand->PhoneDetails();
        }
        return view('product.products', compact('title', 'brands', 'products'));
    }

    public function tablet_products($brand_id)
    {
        session(['search' => null]);
        $brands = Brand::all();
        if ($brand_id == 0) {
            $title = 'Tất cả sản phẩm';
            $products = PhoneDetails::join('phones', 'phones.phone_id', '=', 'phone_details.phone_id')
                ->join('phone_specifics', 'phone_specifics.specific_id', '=', 'phone_details.specific_id')
                ->join('phone_colors', 'phone_colors.color_id', 'phone_details.color_id')
                ->where('phones.category_id', '=', 3)
                ->paginate(16);
        } else {
            $brand = Brand::where('brand_id', '=', $brand_id)->first();
            $title = $brand->brand_name;
            $products = $brand->PhoneDetails();
        }
        return view('product.tablet_products', compact('title', 'brands', 'products'));
    }

    public function search(Request $request)
    {
        $search_string = $request->search_string;
        $brands = Brand::all();
        $products = PhoneDetails::join('phones', 'phones.phone_id', '=', 'phone_details.phone_id')
            ->leftJoin('phone_specifics', 'phone_specifics.specific_id', '=', 'phone_details.specific_id')
            ->leftJoin('phone_colors', 'phone_colors.color_id', 'phone_details.color_id')
            ->leftJoin('brand', 'phones.brand_id', '=', 'brand.brand_id')
            ->leftJoin('phone_os', 'phones.os_id', '=', 'phone_os.os_id')
            ->where(function ($query) use ($search_string) {
                $query->where('phones.phone_name', 'like', '%' . $search_string . '%')
                    ->orWhere('phone_specifics.specific_name', 'like', '%' . $search_string . '%');
            })->paginate(16);
        $title = 'Tìm thấy ' . $products->total() . ' kết quả khớp với từ khóa "' . $request->search_string . '".';
        session(['search' => $request->search_string]);
        return view('product.products', compact('title', 'brands', 'products'));
    }

    public function filter(Request $request)
    {
        $brands = Brand::all();
        $products = new PhoneDetails();
        $products = $products->join('phones', 'phones.phone_id', '=', 'phone_details.phone_id')
            ->leftJoin('phone_specifics', 'phone_specifics.specific_id', '=', 'phone_details.specific_id')
            ->leftJoin('phone_colors', 'phone_colors.color_id', '=', 'phone_details.color_id')
            ->leftJoin('brand', 'phones.brand_id', '=', 'brand.brand_id')
            ->leftJoin('phone_os', 'phones.os_id', '=', 'phone_os.os_id');

        if (session('search', 'default') != 'default') {
            $search_string = session('search');
            $products = $products->where(function ($query) use ($search_string) {
                $query->where('phones.phone_name', 'like', '%' . $search_string . '%')
                    ->orWhere('phone_specifics.specific_name', 'like', '%' . $search_string . '%');
            });
        }

        $preFilter1 = '.';
        $preFilter2 = 'phone_details.';
        $preFilter3 = '.';
        $preFilter4 = 'phones.';
        $preFilter5 = 'phone_details.';
        $preFilter6 = 'phone_details.';

        if ($request->brand) {
            $products = $products->where('brand.brand_name', '=', $request->brand);
        }

        switch ($request->os) {
            case '1': {
                $products = $products->where(function ($query) {
                    $query->where('phones.os_id', '=', 1);
                });
                break;
            }
            case '2': {
                $products = $products->where(function ($query) {
                    $query->where('phones.os_id', '=', 2);
                });
                break;
            }
            default: {
                break;
            }
        }

        if ($request->priceRange == 'range-1') { // below 2mils VND
            $products = $products->where($preFilter2 . 'price', '<', 2000000);
        } else if ($request->priceRange == 'range-2') { // from 2mils to 4mils VND
            $products = $products->where($preFilter2 . 'price', '<', 4000000);
        } else if ($request->priceRange == 'range-3') { // from 4mils to 8mils VND
            $products = $products->where($preFilter2 . 'price', '<', 8000000);
        } else if ($request->priceRange == 'range-4') { // from 8mils to 15mils VND
            $products = $products->where($preFilter2 . 'price', '<', 15000000);
        } else if ($request->priceRange == 'range-5') { // above 15 mils VND
            $products = $products->where($preFilter2 . 'price', '>=', 15000000);
        }


        switch ($request->sort) {
            case 'name_asc': {
                $products = $products->orderBy($preFilter4 . 'phone_name', 'asc');
                break;
            }
            case 'name_desc': {
                $products = $products->orderBy($preFilter4 . 'phone_name', 'desc');
                break;
            }
            case 'price_asc': {
                $products = $products->orderBy($preFilter5 . 'price', 'asc');
                break;
            }
            case 'price_desc': {
                $products = $products->orderBy($preFilter5 . 'price', 'desc');
                break;
            }
            case 'review_asc': {
                ;
                break;
            }
            case 'review_desc': {
                ;
                break;
            }
            default:
                ;
                break;
        }

        $products = $products->paginate(16);

        return response(view('product.products', compact('brands', 'products'))->render());
    }

    public function userRatingProduct(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/')->withErrors('Vui lòng đăng nhập trước.');
        }
        $user = Auth::user();
        $current_details = PhoneDetails::where('phone_details_id', '=', $request->phone_details_id)->first();
        $review = new Review();
        $review->phone_details_id = $request->phone_details_id;
        $review->user_id = $user->id;
        $review->content = $request->content;
        $review->rating = $request->number_rating;
        $review->time = date('Y-m-d H:i:s');
        $review->save();
        return redirect()->back();
    }
}
