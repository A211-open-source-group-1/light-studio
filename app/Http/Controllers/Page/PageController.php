<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\PageModel;
use App\Models\Phone;
use App\Models\PhoneDetails;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productsType1 = null;
        $brandType1 = Brand::where('brand_name', '=', 'Apple')->first();
        if ($brandType1 != null) {
            $productsType1 = PhoneDetails::select('*')
                ->withAvg('Reviews', 'rating')
                ->withCount('Reviews')
                ->join('phones', 'phones.phone_id', '=', 'phone_details.phone_id')
                ->join('phone_specifics', 'phone_specifics.specific_id', '=', 'phone_details.specific_id')
                ->join('phone_colors', 'phone_colors.color_id', 'phone_details.color_id')
                ->where('phones.category_id', '=', 2)
                ->where(function ($query) use ($brandType1) {
                    return $query->where('phones.brand_id', '=', $brandType1->brand_id);
                })
                ->orderBy('phone_details.created_at', 'desc')
                ->paginate(8);
        }
        $brandType2 = Brand::where('brand_name', '=', 'Samsung')->first();
        $productsType2 = null;
        if ($brandType2 != null) {
            $productsType2 = PhoneDetails::select('*')
                ->withAvg('Reviews', 'rating')
                ->withCount('Reviews')
                ->join('phones', 'phones.phone_id', '=', 'phone_details.phone_id')
                ->join('phone_specifics', 'phone_specifics.specific_id', '=', 'phone_details.specific_id')
                ->join('phone_colors', 'phone_colors.color_id', 'phone_details.color_id')
                ->where('phones.category_id', '=', 2)
                ->where(function ($query) use ($brandType2) {
                    return $query->where('phones.brand_id', '=', $brandType2->brand_id);
                })
                ->orderBy('phone_details.created_at', 'desc')
                ->paginate(8);
        }
        $productsType3 = PhoneDetails::select('*')
            ->withAvg('Reviews', 'rating')
            ->withCount('Reviews')
            ->join('phones', 'phones.phone_id', '=', 'phone_details.phone_id')
            ->join('phone_specifics', 'phone_specifics.specific_id', '=', 'phone_details.specific_id')
            ->join('phone_colors', 'phone_colors.color_id', 'phone_details.color_id')
            ->where('phones.category_id', '=', 2)
            ->where(function ($query) {
                return $query->where('phone_details.discount', '>=', 1000000);
            })
            ->orderBy('phone_details.created_at', 'desc')
            ->paginate(8);
        return view('home', compact('productsType1', 'productsType2', 'productsType3'));
    }

    public function login()
    {

    }

    public function register()
    {

    }

    public function aboutus()
    {
        return view('aboutus');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    // public function show(PageModel $pageModel)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(PageModel $pageModel)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, PageModel $pageModel)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(PageModel $pageModel)
    // {
    //     //
    // }
}
