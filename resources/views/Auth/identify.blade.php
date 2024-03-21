@extends('templates.app')
@section('content')

    <form method="post" action="{{route('findNumberPhone')}}">
        @csrf
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
                        <label>Số điện thoại</label>
                        <input name="phone_number" class="form-control" placeholder="Nhập số điện thoại tìm kiếm" type="tel"/>
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
                        <input class="mt-3 btn btn-success" type="submit" value="Tìm kiếm" />
                    </div>
                </div>
            </div>
            <div class="col-3">

            </div>
        </div>
    </div>
    </form>

@endsection