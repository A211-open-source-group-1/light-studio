<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'phone_number' => 'required',
            'password' => 'required'
        ], [
            'phone_number.required' => 'Vui lòng nhập số điện thoại.',
            'password.required' => 'Vui lòng nhập mật khẩu.'
        ]);
    
        $credentials = $request->only('phone_number', 'password');
    
        if (Auth::attempt($credentials)) {
            $rem = $request->boolean('remember');
    
            if ($rem == 1) {
                $user = Auth::user();
                cookie()->queue('phone_number',$request->input('phone_number'), 7 * 24 * 60);
                cookie()->queue('password', $request->input('password'), 7 * 24 * 60);
                cookie()->queue('rem', $rem, 7 * 24 * 60);
            } else {
                if (Cookie::has('rem')) {
                    return redirect()->back()
                    ->withCookie(cookie()->forget('rem'))
                    ->withCookie(cookie()->forget('phone_number'))
                    ->withCookie(cookie()->forget('password')); 
                }
            }
    
            return redirect()->back();
        }
    
        return redirect()->back()->withErrors('Sai mật khẩu vui lòng thử lại');
    }
    
    public function User_info()
    {
        if (Auth::id()) {
            $user = Auth::user(); // Lấy thông tin của người dùng hiện tại
            return view('Auth.info', compact('user'));
        }
        return redirect("/");
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
            $user = Auth::user();
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
                       return redirect()->back()->withErrors('MẬT KHẨU XÁC THỰC KHÔNG KHỚP');
                    }
                } else {
                   return redirect()->back()->withErrors('MẬT KHẨU HIỆN TẠI KHÔNG KHỚP');
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
            return redirect()->back()->withErrors('Mật khẩu không chính xác');
        }
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->back();
    }
    public function identify()
    {
        return view('Auth.identify');
    }
    public function findNumberPhone(Request $request)
    {
        $phone_number = $request->input('phone_number');
        $user = User::where('phone_number', $phone_number)->first();
        
        if($user)
        {
            return "Tim thay sdt";
        }
        else
        {
            return "??????";
        }
    }
}
