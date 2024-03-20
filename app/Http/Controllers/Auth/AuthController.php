<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
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
        $request->validate([
            'phoneNumber' => 'required',
            'email' =>'required',
            'fullname'=>'required',
            'gender'=>'required',
            'password'=>'required',
            'repassword'=>'required',
        ]);
       
        $password = $request->input('password');
        $repassword =$request->input('repassword');
    
        if($password===$repassword) {

            $user = new User();
            $user->phone_number = $request->input('phoneNumber');
            $user->name =$request->input('fullname');
            $user->gender = $request->input('gender');
            $user ->user_point=0;
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->save();
            return ('Đăng ký thành công');
        } else {
            return redirect('/fallout')->withErrors('Mật khẩu không chính xác');
        }
    }

    public function logout() {
        Session::flush();
        Auth::logout();
        return redirect()->back();
    }
}
