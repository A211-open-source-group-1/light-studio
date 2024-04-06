@extends('templates.appAdmin')
@section('content')

<title>Khách hàng</title>
<div class="container-fluid mt-3 border-top " id="customer">
    <div class="row">
        <div class="col-12 mt-3 text-center border-bottom">
            <h3>Khách hàng</h3>
        </div>
    </div>
    <div class="row">
        <table class="table" >
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tên khách hàng</th>
                    <th scope="col">Số điện thoại</th>
                    <th scope="col">Giới tính</th>
                    <th scope="col">Địa chỉ</th>
                    <th scope="col">Email</th>
                    <th scope="col">Điểm tích lũy</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody id="data-body">
                @foreach ($user as $row)
                <tr>
                    <th scope="row">{{$row->id}}</th>
                    <td>{{$row->name}}</td>
                    <td>{{$row->phone_number }}</td>
                    <td>{{ $row->gender }}</td>
                    <td>{{$row->address}}</td>
                    <td>{{ $row->email }}</td>
                    <td>{{ $row->user_point }}</td>
                    <td>
                        <a class="btn btn-primary">Sửa</a>
                        &nbsp; &nbsp;
                        <a class="btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#deleteUser" data-user-id="{{$row->id}}" >Xóa</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
@endsection

@if(session('mess'))
    <script>
        alert({{ json_encode(session('mess')) }});
    </script>
@endif
