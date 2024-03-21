<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
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

    public function User_info()
    {
        if (!Auth::check()) {
            return redirect('/')->withErrors('Vui lòng đăng nhập trước.');
        }
        if (Auth::id()) {
            $user = Auth::user(); // Lấy thông tin của người dùng hiện tại

            return view('Auth.info', compact('user'));
        }
    }
    public function update(Request $request)
    {
        $id = $request->only('id');
        $user = User::where('id', $id)->update([
            'name' => $request->input('fullname'), 'address' => $request->input('address'), 'gender' => $request->input('gender'), 'email' => $request->input('email')
        ]);
        return redirect()->back();
    }
    public function changePassword()
    {
        if (!Auth::check()) {
            return redirect('/')->withErrors('Vui lòng đăng nhập trước.');
        }
        if (Auth::id()) {
            $user = Auth::user(); // Lấy thông tin của người dùng hiện tại
            return view('Auth.ChangePassword', compact('user'));
        }
    }
    public function handleChangePassword(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/')->withErrors('Vui lòng đăng nhập trước.');
        }
        $user = Auth::user();
        if (Auth::id()) {
            if ($user) {
                if (Hash::check($request->input('password'), $user->password)) {
                    if ($request->input('rePassword') == $request->input('newPassword')) {
                        $user = User::find(Auth::id());
                        $user->update(['password' => bcrypt($request->input('newPassword'))]);
                        return redirect('/logout');
                    } else {
                        return 'MẬT KHẨU XÁC THỰC KHÔNG KHỚP';
                    }
                } else {
                    return 'MẬT KHẨU HIỆN TẠI KHÔNG KHỚP';
                }
            }
        }
    }
    public function register(Request $request)
    {
        $request->validate([
            'phoneNumber' => 'required',
            'email' => 'required',
            'fullname' => 'required',
            'gender' => 'required',
            'password' => 'required',
            'repassword' => 'required',
        ]);

        $password = $request->input('password');
        $repassword = $request->input('repassword');

        if ($password === $repassword) {

            $user = new User();
            $user->phone_number = $request->input('phoneNumber');
            $user->name = $request->input('fullname');
            $user->gender = $request->input('gender');
            $user->user_point = 0;
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->save();
            return ('Đăng ký thành công');
        } else {
            return redirect('/fallout')->withErrors('Mật khẩu không chính xác');
        }
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->back();
    }
}
