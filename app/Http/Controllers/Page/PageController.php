<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
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
        $phones = PhoneDetails::join('phones', 'phones.phone_id', '=', 'phone_details.phone_id')
            ->join('phone_specifics', 'phone_specifics.specific_id', '=', 'phone_details.specific_id')
            ->join('phone_colors', 'phone_colors.color_id', 'phone_details.color_id')
            ->paginate(10);
        return view('home', compact('phones'));
    }
    
    public function login()
    {
        
    }

    public function register() {
        
    }

    public function aboutus(){
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
    public function show(PageModel $pageModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PageModel $pageModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PageModel $pageModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PageModel $pageModel)
    {
        //
    }
}
