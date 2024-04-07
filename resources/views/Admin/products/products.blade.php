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
                    </tr>
                </thead>
                <tbody id="data-body">
                    @foreach ($jPhones as $row)
                        <tr>
                            <td scope="row">{{ $row->phone_id }}</td>
                            <td>{{ $row->phone_name }}</td>
                            <td>{{ $row->brand_name }}</td>
                            <td></td>
                            <td></td>
                            <td>{{ $row->colors_count }}</td>
                            <td>{{ $row->specifics_count }}</td>
                            <td>{{ $row->phone_details_count }}</td>
                            <td>
                                <a class="col btn btn-primary edit-btn" data-bs-toggle="modal" data-bs-target="#"
                                    data-phone-id="{{ $row->phone_id }}">Sửa</a>

                                <a class="col btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#"
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
