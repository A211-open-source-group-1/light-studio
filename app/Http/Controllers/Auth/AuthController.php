<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Providers\Mailer;
use Exception;
use Illuminate\Support\Facades\Cookie;
use NguyenAry\VietnamAddressAPI\Address;

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
                cookie()->queue('phone_number', $request->input('phone_number'), 7 * 24 * 60);
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
            return response()->json(['isLoginSucceed' => true]);
        } else {
            return response()->json(['isLoginSucceed' => false]);
        }
    }

    public function User_info()
    {
        if (Auth::id()) {
            $user = Auth::user(); // Lấy thông tin của người dùng hiện tại
            $isVerified = Auth::user()->email_verified_at;
            return view('Auth.info', compact('user', 'isVerified'));
        }
        return redirect("/");
    }

    public function update(Request $request)
    {
        $id = $request->only('id');
        $user = User::where('id', $id)->update([
            'name' => $request->input('fullname'),
            'address' => $request->input('address'),
            'gender' => $request->input('gender'),
            'email' => $request->input('email'),
            'province_id' => $request->input('province_id'),
            'district_id' => $request->input('district_id'),
            'ward_id' => $request->input('ward_id')
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
            'province_id' => 'required',
            'district_id' => 'required',
            'ward_id' => 'required',
            'password' => 'required',
            'repassword' => 'required',
            'address' => 'required'
        ]);

        Address::setSchema(['name']);

        $password = $request->input('password');
        $repassword = $request->input('repassword');

        if ($password === $repassword) {
            $user = new User();
            $user->phone_number = $request->input('phoneNumber');
            $user->name = $request->input('fullname');
            $user->gender = $request->input('gender');
            $user->province_id = $request->input('province_id');
            $user->district_id = $request->input('district_id');
            $user->ward_id = $request->input('ward_id');
            $user->address = $request->input('address');
            $user->user_point = 0;
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->save();

            $token = base64_encode($user->email);
            $new_token = new Token();
            $new_token->token = $token;
            $new_token->save();

            $email = $user->email;
            $name = $user->name;

            Mailer::sendVerifyEmail($email, $name, $token);

            return view('auth.verified_email', compact('email'));
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
        return view("Auth.ResultIdentify", compact('user'));
    }

    public function resetPassword(Request $request)
    {
        $phone_number = $request->phone_number;
        $user = User::where('phone_number', $phone_number)->first();
        if ($user) {
            if ($request->newPassword === $request->rePassword) {
                $user->update(['password' => bcrypt($request->newPassword)]);
                return redirect('/');
            } else {
                return view('fallout');
            }
        }
        return view('fallout');
    }
    public function admin()
    {
        return view('auth.loginAdmin');
    }
    public function authAdmin(Request $request)
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
            return redirect()->route('indexAdmin');
        } else {
            return redirect()->back()->withErrors('Có lỗi xảy ra. Vui lòng thử lại sau');
        }
    }
    public function customer()
    {
        $user = User::all();
        return view('Admin.customer.customer', compact('user'));
    }
    public function deleteUser(Request $request)
    {
        try {

            $user = User::find($request->deleteUserId);
            if (!$user) {
                throw new Exception('User not found' . $request->deleteUserId);
            }
            $user->delete();
            $message = "Xóa thành công " . $user->id;
            return redirect()->back()->with('mess', $message);
        } catch (Exception $e) {
            $message = "Xóa không thành công: " . $e->getMessage();
            return redirect()->back()->with('mess', $message);
        }
    }
    public function getUser($id)
    {
        $user = User::find($id);

        if ($user) {
            return response()->json($user);
        } else {
            return response()->json(['message' => 'Không tìm thấy'], 404);
        }
    }
    public function editUser(Request $request)
    {
        $id = $request->only('id');
        $user = User::where('id', $id)->update([
            'name' => $request->input('fullname'),
            'address' => $request->input('address'),
            'gender' => $request->input('gender'),
            'email' => $request->input('email')
        ]);
        return redirect()->back();
    }
    public function searchUser($searchTerm)
    {
        $users = User::where('name', 'like', '%' . $searchTerm . '%')
            ->orWhere('email', 'like', '%' . $searchTerm . '%')
            ->orWhere('id', 'like', '%' . $searchTerm . '%')
            ->orWhere('address', 'like', '%' . $searchTerm . '%')
            ->orWhere('phone_number', 'like', '%' . $searchTerm . '%')
            ->get();
        if ($users->isEmpty()) {
            $users = User::all();
            return response()->json($users);
        }
        return response()->json($users);
    }
    public function logoutAdmin()
    {
        Session::flush();
        Auth::logout();
        return redirect('/admin');
    }
    public function getAllProvinces()
    {
        Address::setSchema(['name', 'type']);
        return response()->json(Address::getProvinces());
    }
    public function getDistricts($province_id)
    {
        Address::setSchema(['name', 'type']);
        return response()->json(Address::getDistrictsByProvinceId($province_id));
    }
    public function getWards($district_id)
    {
        Address::setSchema(['name', 'type']);
        return response()->json(Address::getWardsByDistrictId($district_id));
    }

    public function user_verify_request()
    {
        if (Auth::check()) {
            $token = base64_encode(Auth::user()->email);

            Token::where('token', '=', $token)->delete();

            $new_token = new Token();
            $new_token->token = $token;
            $new_token->save();

            $email = Auth::user()->email;
            $name = Auth::user()->name;

            Mailer::sendVerifyEmail($email, $name, $token);

            return view('auth.verified_email', compact('email'));
        }
        return response()->back();
    }

    public function user_forgot_password_request($user_id)
    {
        if ($user_id) {
            // code gi ke tao nha - Vinh said

            $user = User::where('id', $user_id)->first();
            $token = base64_encode($user->id . '-' . date('Y-m-d H:i:s'));
            $new_token = new Token();
            $new_token->token = $token;
            $new_token->save();

            $email = $user->email;
            $name = $user->name;

            Mailer::sendResetPasswordEmail($email, $name, $token);
            return view('Auth.verified_email_forgot_password', compact('email'));
        }
        return redirect()->route('identify');
    }

    public function user_reset_password($token)
    {
        // code này đỉnh - Vinh dep trai
        $c_token = Token::where('token', '=', $token)->first();
        if ($c_token != null) {
            $decode = base64_decode($token);
            $pos = strpos($decode, '-');
            $result = substr($decode, 0, $pos);
            User::where('id', '=', $result)->first()->update([
                'email_verified_at' => date('Y-m-d H:i:s')
            ]);
            $user = User::where('id', $result)->first();
            $c_token->delete();
            return view('Auth.ResetPassword', compact('user'));
        } else {
            return view('auth.verified_results.error_verified');
        }
    }

    public function user_verify($token)
    {
        $c_token = Token::where('token', '=', $token)->first();
        if ($c_token != null) {
            User::where('email', '=', base64_decode($token))->first()->update([
                'email_verified_at' => date('Y-m-d H:i:s')
            ]);
            $c_token->delete();
            return view('auth.verified_results.successful_verified');
        } else {
            return view('auth.verified_results.error_verified');
        }
    }
}
