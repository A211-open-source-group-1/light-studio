<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="{{asset('/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('/css/mycss.css')}}">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/a597e9f72c.js" crossorigin="anonymous"></script>
    <script src="{{asset('/js/bootstrap.js')}}"></script>
    <script src="{{asset('/js/buttonHandler.js')}}"></script>
</head>
<body>
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
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fa fa-mobile" aria-hidden="true"></i> Điện thoại</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fa fa-tablet" aria-hidden="true"></i> Máy tính bảng</a>
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
                    <div class="d-flex">
                        <button class="btn btn-light text-nowrap"><i class="fa-solid fa-cart-shopping"></i> Giỏ hàng</button>
                        <button id="login-btn" class="btn btn-light text-nowrap">Đăng nhập</button>
                        <button id="register-btn" class="btn btn-light text-nowrap">Đăng ký</button>
                    </div>
                    <form class="d-flex mt-3">
                        
                        <input class="form-control me-2" type="search" placeholder="Tìm kiếm" aria-label="Search">
                        <button class="btn" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
            </div>
    </nav>
</div>
<main class="container-fluid mt-6">
    <div class="row" style="height: 100px">
        
    </div>