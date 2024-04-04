<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title></title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{asset('/js/bootstrap.bundle.min.js')}}"></script>
    <script src="https://kit.fontawesome.com/a597e9f72c.js" crossorigin="anonymous"></script>
    <script src="{{asset('/js/buttonHandler.js')}}"></script>
    <script src="{{asset('/js/userHiddenHandler.js')}}"></script>
    <link rel="stylesheet" href="{{asset('/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/mycss.css')}}">
</head>
<boady>
<div class="container-fluid">
    <nav class="navbar navbar-expand-lg bg-light fixed-top mb-6">
            <div class="container-fluid">
                <a class="nav-brand" href="/">
                    <img class="logo-banner" src="{{asset('/image/logo-banner.png')}}">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler1">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarToggler1">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fa fa-info-circle" aria-hidden="true"></i> Về chúng tôi</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#"><i class="fa fa-mobile" aria-hidden="true"></i> Điện thoại</a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-item border-bottom">
                                    <a class="link-dark" href="{{URL::to('/product/brand/0')}}">Tất cả</a>
                                </li>
                                <li class="dropdown-item border-bottom">
                                    <a class="link-dark" href="#">Samsung</a>
                                </li>
                                <li class="dropdown-item border-bottom">
                                    <a class="link-dark" href="#">iPhone</a>
                                </li>
                                <li class="dropdown-item border-bottom">
                                    <a class="link-dark" href="#">Xiaomi</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#"><i class="fa fa-tablet" aria-hidden="true"></i> Máy tính bảng</a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-item border-bottom">
                                    <a class="link-dark" href="{{URL::to('/product/brand/0')}}">Tất cả</a>
                                </li>
                                <li class="dropdown-item border-bottom">
                                    <a class="link-dark" href="#">Samsung</a>
                                </li>
                                <li class="dropdown-item border-bottom">
                                    <a class="link-dark" href="#">iPhone</a>
                                </li>
                                <li class="dropdown-item border-bottom">
                                    <a class="link-dark" href="#">Xiaomi</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fa-solid fa-cube"></i> Phụ kiện</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fa fa-bell-o" aria-hidden="true"></i> Khuyến mãi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fa-regular fa-envelope"></i> Hỗ trợ</a>
                        </li>
                    </ul>
                    <div class="d-flex mt-3 me-2">
                        <a class="link-dark text-nowrap" href="{{route('cart')}}"><i class="fa-solid fa-cart-shopping"></i> Giỏ hàng</a>
                        <ul style="list-style: none">
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    @if (Auth::check())
                                        {{auth()->user()->name}}
                                    @else
                                        Tài khoản
                                    @endif
                                </a>
                                <ul class="dropdown-menu">
                                    @if (Auth::check())
                                    <li class="dropdown-item border-bottom">
                                    <a class="link-dark text-nowrap" href="{{route('user.info')}}">Thông tin cá nhân</a>
                                    </li>
                                    <li class="dropdown-item border-bottom">
                                        <a class="link-dark text-nowrap" href="#">Tra cứu đơn hàng</a>
                                    </li>
                          
                                    <li class="dropdown-item border-bottom">
                                        <a class="link-dark text-nowrap" href="{{route('logout')}}">Đăng xuất</a>
                                    </li>
                                    @else
                                    <li class="dropdown-item border-bottom">
                                        <a id="login-btn" class="link-dark text-nowrap" href="#">Đăng nhập</a>
                                    </li>
                                    <li class="dropdown-item border-bottom">
                                        <a id="register-btn" class="link-dark text-nowrap" href="#">Đăng ký</a>
                                    </li>
                                    @endif
                                </ul>
                            </li>
                        </ul>
                        
                        
                    </div>
                    <form class="d-flex m-1" action="{{route('search')}}" method="POST">
                        @csrf
                        <input class="form-control me-2" name="search_string" type="search" placeholder="Tìm kiếm" aria-label="Search">
                        <button class="btn" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
            </div>
    </nav>
</div>
<main class="container-fluid mt-6">
    <div class="row" style="height: 100px">
               
    </div>