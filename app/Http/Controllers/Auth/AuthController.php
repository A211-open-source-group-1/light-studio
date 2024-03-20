<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(Request $request) {
        $request->validate([
            'phone_number' => 'required',
            'password' => 'required'
        ]);
        $credentials = $request->only('phone_number', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->back();
        }
        return redirect('/fallout')->withErrors('ko dc rui');
    }

    public function register(Request $request) {
        // $request->validate([
        //     'phoneNumber' => 'required',

        // ]);
    }

    public function logout() {
        Session::flush();
        Auth::logout();
        return redirect()->back();
    }
}
