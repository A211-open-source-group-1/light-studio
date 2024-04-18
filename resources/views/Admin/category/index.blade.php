@extends('templates.appAdmin')
@section('content')
<script src="{{ asset('/js/admin/categoryhandle.js') }}"></script>
<title>Loại điện thoại</title>
<div class="container-fluid mt-3 border-top " id="category">
    <div class="row">
        <div class="col-12 mt-3 text-center border-bottom">
            <h3>Loại điện thoại</h3>
        </div>
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Loại sản phẩm</th>
                        <th scope="col">Chú thích</th>
                        <th scope="col">Thao tác</th>
                    </tr>
                </thead>
                <tbody id="data-body">
                    @foreach ($phoneCategorys as $row)
                    <tr>
                        <th scope="row">{{$row->category_id}}</th>
                        <td scope="row">{{$row->category_name}}</td>
                        <td scope="row">{{$row->category_description }}</td>
                        <td scope="row">
                            <a class="col btn btn-primary listCategory-btn" data-bs-toggle="modal" data-bs-target="#listPhoneCategory" data-category-id="{{$row->category_id}}">Xem danh sách</a>
                            <a class="col btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#deleteUser" data-category-id="{{$row->category_id}}">Xóa</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>

<div class="modal fade" id="listPhoneCategory" tabindex="-1" aria-labelledby="listPhoneCategory" aria-hidden="true">
<div class="modal-dialog modal-xl modal-dialog-centered w-100" style="bs-modal-with:1200px">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center">Danh sách sản phẩm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
            </div>
            <div class="modal-body card">   
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Tên điện thoại</th>
                        <th scope="col">Thương hiệu</th>
                        <th scope="col">Loại</th>
                        <th scope="col">Hệ điều hành</th>
                        <th scope="col">Số màu sắc hiện có</th>
                        <th scope="col">Số phiên bản hiện có</th>
                        <th scope="col">Số sản phẩm con hiện có</th>
                        <th scope="col">Hành động</th>
                    </tr>
                </thead>
                <tbody id="data-body-list">
                      
             
                </tbody>
            </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
@endsection