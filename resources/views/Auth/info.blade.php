@extends('templates.app')
@section('content')
<!-- -- -->
<form method="post" action="/update">
{{ csrf_field() }}
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center border-bottom">
                <h4>CHỈNH SỬA TÀI KHOẢN</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
            </div>
            <div class="col-6">
                <div class="form">
                    <div class="form-group">
                        <label>ID tài khoản</label>
                        <input name="id" class="form-control" value="{{$user->id}}" readonly />
                    </div>

                    <div class="form-group">
                        <label>Họ và tên</label>
                        <input id="fullname" name="fullname" class="form-control" type="text" value="{{ $user->name }}" required />
                    </div>
                    <div class="form-group">
                        <label>Giới tính</label>
                        <select id="slt" name="gender" class="form-control">
                            <option value="Nam" {{ $user->gender == 'Nam' ? 'selected' : '' }}>Nam</option>
                            <option value="Nữ" {{ $user->gender == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                        </select>

                    </div>
                    <div class="form-group">
                        <label>Địa chỉ</label>
                        <input id="user_address" name="address" class="form-control" type="text"  value="{{ $user->address }}" />
                    </div>
                    <div class="form-group">
                        <label>Số điện thoại</label>
                        <input id="phonenumber" name="phonenumber" class="form-control" type="tel"  readonly required minlength="10" value="{{ $user->phone_number }}" />
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input id="email" name="email" class="form-control" type="email" required value="{{ $user->email }}" />
                    </div>
                    <div class="form-group">
                        <label>Điểm tích lũy</label>
                        <input id="user_point" name="text" class="form-control" type="text" readonly value="{{$user->user_point}}" />
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
                        <a class="btn btn-primary mt-3" href="{{route('ChangePassword')}}">Đổi mật khẩu</a> 
                        <input class="mt-3 btn btn-success" type="submit" value="Lưu thay đổi" />
                    </div>
                </div>
            </div>
            <div class="col-3">

            </div>
        </div>
    </div>
</form>
@endsection