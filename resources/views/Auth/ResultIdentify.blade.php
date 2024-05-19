@extends('templates.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center border-bottom">
                <h4>Thông báo</h4>
            </div>
        </div>
        <div class="row text-center">
                    @if($user!=null)             
                    <h4>Tìm thấy số điện thoại {{$user->phone_number}}</h4>
                    <div class="col-12 text-center">
                        <div class="form">
                            <h4>Xin chào {{$user->name}} vui lòng nhấn <a href="/user_forgot_password_request/{{$user->id}}'">đây</a> để nhận mã xác nhận</h4>
                        </div>
                    </div>
                    @else
                    <h3>Không tìm thấy số điện thoại này! <a href="{{ route('identify')}}">Vui lòng thử lại</a></h3>
                    @endif
        </div>
    </div>
@endsection