@extends('templates.app')


@section('content')
<form method="get" action="{{route('resetPassword')}}">
    @csrf
    @method('get')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center border-bottom">
                <h4>Quên mật khẩu</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
            </div>
            <div class="col-6">
                <div class="form">
                    <div class="form-group">
                        <label>Email</label>
                        <input name="phone_number" class="form-control" value="{{$user->phone_number}}" readonly />
                    </div>
                    <div class="form-group">
                        <label>Mật khẩu mới</label>
                        <input id="newPassword" name="newPassword" class="form-control" type="password" required />
                    </div>
                    <div class="form-group">
                        <label>Xác thực mật khẩu</label>
                        <input id="rePassword" name="rePassword" class="form-control" type="password" required />
                    </div>
                </div>
            </div>
            <div class="col-3">
            </div>
        </div>
        <div class="row">
            <div class="col-3">

            </div>
            <div class="col-6">
                <div class="row">
                    <div class="col-12 text-center d-inline">
                        <a class="btn btn-primary mt-3" href="/">Trở lại</a>
                        <input class="mt-3 btn btn-success" type="submit" value="Đổi mật khẩu" />
                    </div>
                </div>
            </div>
            <div class="col-3">

            </div>
        </div>
    </div>
</form>


@endsection