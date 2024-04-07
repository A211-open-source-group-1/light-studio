<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <script src="https://kit.fontawesome.com/a597e9f72c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('/css/admincss.css') }}">
    <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/js/sidebarAdmin.js') }}"></script>


</head>

<body>

    <div class="sidebar">
        <a href="{{ route('indexAdmin') }}" id="home">Trang chủ</a>
        <a href="{{ route('customer') }}" id="customer">Khách hàng</a>
        <a href="#" id="phone">Điện thoại</a>
        <a href="#" id="order">Đơn hàng</a>
        <a href="#">Sản phẩm</a>
    </div>
    <div class="content">
