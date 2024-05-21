@extends('templates.appAdmin')
@section('content')
<title>Nhân viên</title>
<div class="container-fluid mt-3 border-top" id="employee">
    <div class="row">
        <div class="col-12 mt-3 text-center border-bottom">
            <h3>Nhân viên</h3>
        </div>
        <div class="row">
            <label>Tìm kiếm</label>
            <input id="searchEmployee" type="search" name="searchEmployee" placeholder="Tìm kiếm">
        </div>
        <div class="row">
            <div class="col-12 p-0 m-0">
                <a href="#" class="btn btn-success mt-2 mb-2 btn-add-category" data-bs-toggle="modal" data-bs-target="#addEmployee">Thêm mới</a>
            </div>
        </div>
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Tên nhân viên</th>
                        <th scope="col">Số điện thoại</th>
                        <th scope="col">Giới tính</th>
                        <th scope="col">Địa chỉ</th>
                        <th scope="col">Email</th>
                        <th scope="col">Thao tác</th>
                    </tr>
                </thead>
                <tbody id="data-body">
                    @foreach ($employees as $row)
                    <tr>
                        <th scope="row">{{$row->id}}</th>
                        <td>{{$row->name}}</td>
                        <td>{{$row->phone_number }}</td>
                        <td>{{ $row->gender }}</td>
                        <td>{{$row->address}}</td>
                        <td>{{ $row->email }}</td>
                        <td>
                            <a class="col btn btn-primary edit-employee-btn" data-bs-toggle="modal" data-bs-target="#editEmployee" data-user-id="{{$row->id}}">Sửa</a>
                            <a class="col btn btn-danger delete-employee-btn" data-bs-toggle="modal" data-bs-target="#deleteEmployee" data-user-id="{{$row->id}}">Xóa</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection