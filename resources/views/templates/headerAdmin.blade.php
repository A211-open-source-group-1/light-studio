<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('/css/bootstrap.min.css')}}">
    <script src="{{asset('/js/bootstrap.bundle.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('/css/admincss.css')}}">
    <script src="{{asset('/js/sidebarAdmin.js')}}"></script>


</head>
<body>

<div class="sidebar">
  <a href="{{ route('indexAdmin') }}" id="home">Home</a>
  <a href="{{route('customer')}}" id="customer">Khách hàng</a>
</div>

<div class="content">