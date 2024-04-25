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
                            <td>{{ $row->specifics_count }} <button type="button"
                                    class="btn btn-sm btn-warning edit-phone-specs-btn" data-bs-toggle="modal"
                                    data-bs-target="#editPhoneSpecifics" data-phone-id="{{ $row->phone_id }}">Chi
                                    tiết</button></td>
                            <td>{{ $row->phone_details_count }} <button type="button"
                                    class="btn btn-sm btn-warning edit-phone-details-btn" data-bs-toggle="modal"
                                    data-bs-target="#editDetails" data-phone-id="{{ $row->phone_id }}">Chi
                                    tiết</button></td>
                            <td>
                                <a class="col btn btn-primary phone-edit-btn" data-bs-toggle="modal"
                                    data-bs-target="#editPhone" data-phone-id="{{ $row->phone_id }}">Sửa</a>
                                <a class="col btn btn-danger phone-delete-btn" data-bs-toggle="modal" data-bs-target="#"
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
