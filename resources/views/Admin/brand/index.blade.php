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
            <input id="searchBrand" type="search" name="searchBrand" placeholder="Tìm kiếm">
        </div>
        <div class="row">
            <div class="col-12 p-0 m-0">
                <a href="#" class="btn btn-success mt-2 mb-2 btn-add-category" data-bs-toggle="modal" data-bs-target="#addBrand">Thêm mới</a>
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
                        <th scope="row" class="text-center align-middle">{{$row->brand_id}}</th>
                        <td scope="row" class="align-middle"><img class="img-brand" src="{{ asset('/image/' . $row->brand_img) }}"></td>
                        <td scope="row" class="align-middle">{{$row->brand_name }}</td>
                        <td scope="row" class="align-middle">{{$row-> brand_description	}}</td>
                        <td scope="row" class="align-middle">
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

<div class="modal fade" id="addBrand" tabindex="-1" aria-labelledby="addBrand" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <form action="{{route('addBrand')}}" method="post" enctype="multipart/form-data">

            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="addBrandLabel">Thêm mới thương hiệu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                    @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="mb-3">
                        <label for="brand_img" class="form-label">Chọn hình ảnh đại diện</label>
                        <input type="file" class="form-control" id="brand_img" name="brand_img" placeholder="Nhập tên thương hiệu">
                        <div class="text-danger" id="errorbrand_img"></div>
                    </div>

                    <div class="mb-3">
                        <label for="brand_name" class="form-label">Tên thương hiệu</label>
                        <input type="text" class="form-control" id="brand_name" name="brand_name" placeholder="Nhập tên thương hiệu">
                        <div class="text-danger" id="errorbrand_name"></div>
                    </div>

                    <div class="mb-3">
                        <label for="brand_description" class="form-label">Chú thích thương hiệu</label>
                        <textarea class="form-control" id="brand_description" name="brand_description" rows="3" placeholder="Thêm mô tả cho loại sản phẩm"></textarea>
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

@if(session('mess'))
<script>
  alert("{{ session('mess') }}");
</script>
@endif
@endsection