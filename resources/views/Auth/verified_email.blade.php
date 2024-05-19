@extends('templates.app')

@section('content')
    <div class="container-fluid">
        <div class="row" style="height: 230px">

        </div>
        <div class="row">
            <div class="col-3">
            </div>
            <div class="col-6">
                <h3>
                    Xin chào quý khách hàng, Email xác nhận đã được gửi tới email: {{ $email }}.
                </h3>
                <h3>
                    Hãy xác nhận Email để hoàn tất quá trình đăng ký!
                </h3>
            </div>
        </div>
        <div class="row" style="height: 230px">

        </div>
    </div>
@endsection
