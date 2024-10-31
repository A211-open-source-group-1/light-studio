@extends('templates.app')
@section('content')
<div class="container-fluid p-0 m-0">
    <div class="row">
        <div class="col-0 col-lg-1 col-xl-1">
        </div>
        <div class="col-12 col-sm-12 col-md-10 col-lg-10 col-xl-10">
            {{ Breadcrumbs::render('user.info') }}
        </div>
    </div>
</div>
<!-- -- -->
<form method="post" action="/update">
    @csrf
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
                @if (Session::has('msg'))
                <div class="alert alert-success w-100 mt-1" role="alert">
                    <p class="fw-bold">{{ Session::get('msg') }}</p>
                </div>
                @endif
                <div class="form">
                    <div class="form-group">
                        <label>ID tài khoản</label>
                        <input name="id" class="form-control" value="{{ $user->id }}" readonly />
                    </div>
                    <div class="form-group">
                        <label>Số căn cước</label>
                        <input name="id" class="form-control" value="{{ $user->citizen_ID }}" readonly />
                    </div>
                    <div class="form-group">
                        <label>Ngày hết hạn</label>
                        @php
                        $formattedDateCard = $user->dateCard ? \Carbon\Carbon::createFromFormat('Y-m-d', $user->dateCard)->format('d-m-Y') : null;
                        @endphp
                        <input name="id" class="form-control" value="{{ $formattedDateCard }}" readonly />
                    </div>
                    <div class="form-group">
                        <label>Số căn cước</label>
                        <input name="id" class="form-control" value="{{ $user->citizen_ID }}" readonly />
                    </div>
                    <div class="form-group">
                        <label>Họ và tên</label>
                        <input id="fullname" name="fullname" class="form-control" type="text"
                            value="{{ $user->name }}"
                            @if($user->citizen_ID !== null) readonly @endif
                        required />
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
                        <div class="container-fluid m-0 p-0">
                            <div class="row">
                                <div class="col-12">
                                    <label>Tỉnh/thành phô</label>
                                    <select id="user_province" name="province_id"
                                        data-current-id="{{ $user->province_id }}">

                                    </select>
                                </div>
                                <div class="col-12">
                                    <label>Quận/huyện/thị xã</label>
                                    <select id="user_district" name="district_id"
                                        data-current-id="{{ $user->district_id }}">

                                    </select>
                                </div>
                                <div class="col-12">
                                    <label>Xã/phường</label>
                                    <select id="user_ward" name="ward_id" data-current-id="{{ $user->ward_id }}">

                                    </select>
                                </div>
                                <div class="col-12">
                                    <label>Số nhà, tên đường, thôn/ấp</label>
                                    <input id="user_address" name="address" class="form-control" type="text"
                                        value="{{ $user->address }}" />
                                </div>
                            </div>
                        </div>




                    </div>
                    <div class="form-group">
                        <label>Số điện thoại</label>
                        <input id="phonenumber" name="phonenumber" class="form-control" type="tel" readonly required
                            minlength="10" value="{{ $user->phone_number }}" />
                    </div>

                    <div class="form-group">
                        <label>Email
                            @if ($isVerified == null)
                            <span>(Chưa xác nhận)</span>
                            <span><a href="{{ route('user_verify_request') }}">Gửi lại Email xác nhận!</a></span>
                            @endif
                        </label>
                        <input id="email" name="email" class="form-control" type="email" required
                            value="{{ $user->email }}" />
                    </div>
                    <div class="form-group">
                        <label>Điểm tích lũy</label>
                        <input id="user_point" name="text" class="form-control" type="text" readonly
                            value="{{ $user->user_point }}" />
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
                        @if($user->citizen_ID === null)
                        <a class="btn btn-danger mt-3" href="{{route('verifyCitizen')}}">Xác thực</a>
                        @endif
                        <a class="btn btn-primary mt-3" href="{{ route('ChangePassword') }}">Đổi mật khẩu</a>
                        <input class="mt-3 btn btn-success" type="submit" value="Lưu thay đổi" />
                    </div>
                </div>
            </div>
            <div class="col-3">

            </div>
        </div>
    </div>
</form>
<script src="{{ asset('/js/user/editUserInfo.js') }}"></script>
@endsection