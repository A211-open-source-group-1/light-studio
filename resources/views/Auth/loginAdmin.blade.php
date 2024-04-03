<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin login</title>
    <script src="{{asset('/js/bootstrap.bundle.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/admincss.css')}}">
    <script src="{{asset('/js/userHiddenHandler.js')}}"></script>

</head>
@php
    $rem = Cookie::get('rem');
    $phone_number = Cookie::get('phone_number');
    $password=Cookie::get('password');
@endphp
<body>        
    <form action="authAdmin" method="post" id="loginForm">
    {{ csrf_field() }}
  <div class="imgcontainer">
    <img src="{{asset('/image/logo-banner.png')}}" alt="Avatar" class="avatar">
  </div>

  <div class="container w-50">
  <div class="mb-2">

    <label for="uname"><b>Số điện thoại</b></label>
    <input type="text" placeholder="Nhập số điện thoại" name="phone_number" id="phone_number" >
    <label class="text-danger" id="errorPhoneNumberLogin"></label>
</div>
    <div class="mb-2">
    <label for="psw"><b>Mật khẩu</b></label>
    <input type="password" placeholder="Nhập mật khẩu" name="password" id="password" >
    <label class="text-danger" id="errorPasswordLogin"></label>
    </div>
  

    <button type="button" onclick="check_Login()">Đăng nhập</button>
    <div class="row">
    <div class="row">
        <label>
        <input type="checkbox" name="remember" class="form-check-input" {{ $rem == 1 ? 'checked' : '' }}>             
        <label class="form-check-label">Ghi nhớ đăng nhập</label>             
    </label>
    </div>
    <div class="row mt-3 ">
        <div class="border-top"></div>
 <a  class="mt-3" href="#">Quên mật khẩu</a>
    </div>
    </div>
   
    
    
    </div>
   
  </div>
</form>


</body>
</html>