<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MEmployeeController extends Controller
{
    public function index()
    {
        return view('admin.employee.employee');
    }
}
