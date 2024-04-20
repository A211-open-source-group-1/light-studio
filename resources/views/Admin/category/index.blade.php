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
            <label>Tìm kiếm</label>
            <input id="searchCategory" type="search" name="searchsearchCategory" placeholder="Tìm kiếm">
        </div>
        <div class="row">
            <div class="col-12 p-0 m-0">
                <a href="#" class="btn btn-success mt-2 mb-2 btn-add-category" data-bs-toggle="modal" data-bs-target="#addPhoneCategory">Thêm mới</a>
            </div>
        </div>
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" >ID</th>
                        <th scope="col" >Loại sản phẩm</th>
                        <th scope="col" >Chú thích</th>
                        <th scope="col" >Thao tác</th>
                    </tr>
                </thead>
                <tbody id="data-body">
                    @foreach ($phoneCategorys as $row)
                    <tr>
                        <th scope="row" class="align-middle">{{$row->category_id}}</th>
                        <td scope="row" class="align-middle">{{$row->category_name}}</td>
                        <td scope="row" class="align-middle">{{$row->category_description }}</td>
                        <td scope="row" class="align-middle">
                            <a class="col btn btn-primary listCategory-btn" data-bs-toggle="modal" data-bs-target="#listPhoneCategory" data-category-id="{{$row->category_id}}">Xem danh sách</a>
                            <a class="col btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#" data-category-id="{{$row->category_id}}">Xóa</a>
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

<!-- Modal -->
<div class="modal fade" id="addPhoneCategory" tabindex="-1" aria-labelledby="addPhoneCategoryLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <form action="{{route('addCategory')}}" method="post">

            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="addPhoneCategoryLabel">Thêm mới loại sản phẩm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                    @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="mb-3">
                        <label for="CategoryName" class="form-label">Tên loại sản phẩm</label>
                        <input type="text" class="form-control" id="CategoryName" name="CategoryName" placeholder="Nhập tên loại sản phẩm">
                        <div class="text-danger" id="errorCategoryName"></div>
                    </div>

                    <div class="mb-3">
                        <label for="descriptionCategory" class="form-label">Chú thích loại sản phẩm</label>
                        <textarea class="form-control" id="descriptionCategory" name="descriptionCategory" rows="3" placeholder="Thêm mô tả cho loại sản phẩm"></textarea>
                        <div class="text-danger" id="errordescriptionCategory"></div>
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <input type="submit" class="btn btn-primary" value="Tạo"></input>
            </div>
            </form>
        </div>
    </div>
</div>


@endsection