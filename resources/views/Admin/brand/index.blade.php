@extends('templates.appAdmin')
@section('content')
<title>Thương hiệu</title>
<div class="container-fluid mt-3 border-top " id="brand">
    <div class="row">
        <div class="col-12 mt-3 text-center border-bottom">
            <h3>Thương hiệu</h3>
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
                        <th scope="col">ID</th>
                        <th scope="col">Hình ảnh</th>
                        <th scope="col">Thương hiệu</th>
                        <th scope="col">Chú thích</th>
                        <th scope="col">Thao tác</th>
                    </tr>
                </thead>
                <tbody id="data-body">
                    @foreach ($brands as $row)
                    <tr>
                        <th scope="row">{{$row->brand_id}}</th>
                        <td scope="row"><img src="{{ asset('/image/' . $row->brand_img) }}"></td>
                        <td scope="row">{{$row->brand_name }}</td>
                        <td scope="row">{{$row-> brand_description	}}</td>
                        <td scope="row">
                            <a class="col btn btn-primary list-brand-btn" data-bs-toggle="modal" data-bs-target="#listBrand" data-brand-id="{{$row->brand_id}}">Xem danh sách</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
<div class="modal fade" id="listBrand" tabindex="-1" aria-labelledby="listBrand" aria-hidden="true">
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
                    <tbody id="data-body-list-brand-item">


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