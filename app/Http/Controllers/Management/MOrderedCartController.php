<?php

namespace App\Http\Controllers\Management;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MOrderedCartController extends Controller
{
    //
    public function index()
    {
        return view('admin.orderedCart.orderedCart');
    }
}
