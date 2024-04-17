@extends('templates.appAdmin')
@section('content')
    <title>Điện thoại</title>
    <div class="container-fluid mt-3 border-top " id="products">
        <div class="row">
            <div class="col-12 mt-3 text-center border-bottom">
                <h3>Điện thoại</h3>
            </div>
        </div>
        <div class="row">
            <label>Tìm kiếm</label>
            <input type="search" name="search" placeholder="Tìm kiếm">
        </div>
        <div class="row">
            <div class="col-12 p-0 m-0">
                <a href="#" class="btn btn-success mt-2 mb-2">Thêm mới</a>
            </div>
        </div>
        <div class="row">
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
                <tbody id="data-body">
                    @foreach ($jPhones as $row)
                        <tr>
                            <td scope="row">{{ $row->phone_id }}</td>
                            <td>{{ $row->phone_name }}</td>
                            <td>{{ $row->brand_name }}</td>
                            <td>{{ $row->category_name }}</td>
                            <td>{{ $row->os_name }}</td>
                            <td>{{ $row->colors_count }} <button type="button"
                                    class="btn btn-sm btn-warning edit-phone-color-btn" data-bs-toggle="modal"
                                    data-bs-target="#editPhoneColor" data-phone-id="{{ $row->phone_id }}">Chi tiết</button>
                            </td>
                            <td>{{ $row->specifics_count }} <button type="button" class="btn btn-sm btn-warning">Chi
                                    tiết</button></td>
                            <td>{{ $row->phone_details_count }} <button type="button" class="btn btn-sm btn-warning">Chi
                                    tiết</button></td>
                            <td>
                                <a class="col btn btn-primary phone-edit-btn" data-bs-toggle="modal"
                                    data-bs-target="#editPhone" data-phone-id="{{ $row->phone_id }}">Sửa</a>
                                <a class="col btn btn-danger phone-edit-btn" data-bs-toggle="modal" data-bs-target="#"
                                    data-phone-id="{{ $row->phone_id }}">Xóa</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection

@if (session('mess'))
    <script>
        alert("{{ session('mess') }}");
    </script>
@endif

<div class="modal fade" id="editPhoneColor" tabindex="-1" aria-labelledby="editPhoneColor" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Chỉnh sửa màu sắc sản phẩm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <label for="ec_phone_id">Mã điện thoại</label>
                            <input readonly id="ec_phone_id" class="form-control" type="text">
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="ec_phone_name">Tên sản phẩm</label>
                            <input readonly id="ec_phone_name" class="form-control" type="text">
                        </div>
                    </div>
                    <form id="edit-color-form" method="POST" class="form border-0 d-none" action="{{route('editSelectedColorSubmit')}}">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <label for="ec_color_id">Mã màu</label>
                                <input readonly id="ec_color_id" name="current_color_id" class="form-control" type="text">
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="ec_color_name">Tên màu</label>
                                <input id="ec_color_name" name="current_color_name" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">

                            </div>
                            <div class="col-4 text-end">
                                <button id="submit-edit-color-form-btn" class="btn btn-success" type="submit">Lưu</button>
                                <button id="close-edit-color-form-btn" class="btn btn-dark" type="button">Hủy</button>
                            </div>
                        </div>
                        <div class="row" id="notification" class="d-none">
                            <p class="text-success text-end mt-3">Sửa thành công!</p>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-12">
                            <div class="container-fluid m-0 p-0">
                                <table class="table table-light">
                                    <thead>
                                        <tr>
                                            <th scope="col">Mã màu</th>
                                            <th scope="col">Tên màu</th>
                                            <th scope="col">Số lượng PB</th>
                                            <th scope="col">Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody id="color-board">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                {{-- <button type="submit" class="btn btn-success">Lưu</button> --}}
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button>
            </div>
        </div>
    </div>
</div>
