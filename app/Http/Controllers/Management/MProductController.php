<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Phone;
use App\Models\PhoneDetails;
use Exception;
use Illuminate\Http\Request;

class MProductController extends Controller
{
    public function index() {
        try {
            $jPhones = Phone::
            select('*')
            ->withCount('Specifics')
            ->withCount('Colors')
            ->withCount('PhoneDetails')
            ->join('brand', 'brand.brand_id', '=', 'phones.brand_id')
            ->get();
            return view('admin.products.products', compact('jPhones'));
        } catch (Exception $ex) {
            return $ex;
        }
    }
}
