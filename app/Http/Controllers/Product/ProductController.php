<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function detail($id)
    {
        return view('product.detail');
    }
}
