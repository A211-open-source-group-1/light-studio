@extends('templates.app')
@section('content')
    <div class="container-fluid p-0 m-0">
        <div class="row p-0 m-0">
            <div class="col-0 col-sm-0 col-md-1 col-lg-1 col-xl-1">
            </div>
            <div class="col-12 col-sm-12 col-md-10 col-lg-10 col-xl-10">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 border-bottom">
                            <h4>{{ $current_details->parentPhone->phone_name }}</h4>
                        </div>
                        <div class="col-12 col-lg-6 mt-3 p-0">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-0 col-lg-1">

                                    </div>
                                    @php
                                        $num = 1;
                                    @endphp
                                    <div class="col-12 col-lg-10">
                                        <div id="carousel" class="carousel carousel-dark slide" data-bs-ride="carousel">
                                            <div class="carousel-indicators">
                                                <button type="button" data-bs-target="#carousel" data-bs-slide-to="0"
                                                    class="active" aria-current="true" aria-label="Slide 0"></button>
                                                @foreach ($images as $row)
                                                    <button type="button" data-bs-target="#carousel"
                                                        data-bs-slide-to="{{ $num }}" class="active"
                                                        aria-current="true" aria-label="Slide {{ $num++ }}"></button>
                                                @endforeach
                                            </div>
                                            <div class="carousel-inner">
                                                <div class="carousel-item active text-center">
                                                    <img src="{{ asset('/image/' . $current_details->thumbnail_img) }}"
                                                        class="d-block w-100 h-100 product-img" alt="...">
                                                </div>
                                                @foreach ($images as $row)
                                                    <div class="carousel-item">
                                                        <img src="{{ asset('/image/' . $row->file_path) }}"
                                                            class="d-block w-100 h-100 product-img" alt="...">
                                                    </div>
                                                @endforeach
                                            </div>
                                            <button class="carousel-control-prev" type="button" data-bs-target="#carousel"
                                                data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-bs-target="#carousel"
                                                data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-0 col-lg-1">

                                    </div>
                                </div>
                            </div>

                            <div class="container p-1 border-top border-end">
                                <h5 class="mt-3">Chọn phiên bản:</h5>
                                <div class="pb-2 text-center">
                                    @foreach ($other_details_specs as $row)
                                        <a class="btn btn-sm btn-outline-secondary"
                                            href="{{ URL::to('/phone/' . $phone_id . '/detail/' . '0' . '/specs/' . $row->specific_id) }}">{{ $row->specific_name }}</a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="container p-1 border-top border-end">
                                <h5 class="mt-3">Chọn màu sắc:</h5>
                                <div class="pb-2 text-center">
                                    @foreach ($other_details_colors as $row)
                                        <a class="btn btn-sm btn-outline-secondary"
                                            href="{{ URL::to('/phone/' . $phone_id . '/detail/' . $row->phone_details_id . '/specs/0') }}">{{ $row->color_name }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 mt-3">
                            <h5 class="pb-2 border-bottom">Tình trạng: <span class="text-success fw-bold">Còn hàng</span>
                            </h5>
                            <h5 class="pb-2 border-bottom">Giá: <span
                                    class="text-danger fw-bold">{{ number_format($current_details->price, 0, ',', '.') }}
                                    VNĐ</span></h5>
                            <div class="d-grid gap-2 pb-2">
                                <script src="{{ asset('/js/cartHandler.js') }}"></script>
                                <button class="btn btn-warning"
                                    onclick="AddToCart('{{ $current_details->phone_details_id }}')">THÊM VÀO GIỎ</button>
                                <button class="btn btn-primary btn-block">MUA TRẢ GÓP</button>
                                <button class="btn btn-primary btn-block">MUA TRẢ GÓP QUA THẺ</button>
                            </div>
                            <h5 class="border-bottom pb-2">Thông số kỹ thuật</h5>
                            <table class="table table-striped">
                                <tr>
                                    <td>Màn hình</td>
                                    <td>{{ $current_details->screen }}</td>
                                </tr>
                                <tr>
                                    <td>Màu sắc</td>
                                    <td>{{ $current_details->parentColor()->first()->color_name }}</td>
                                </tr>
                                <tr>
                                    <td>Bộ nhớ RAM</td>
                                    <td>{{ $current_details->ram }}</td>
                                </tr>
                                <tr>
                                    <td>Bộ nhớ trong</td>
                                    <td>{{ $current_details->rom }}</td>
                                </tr>
                                <tr>
                                    <td>CPU</td>
                                    <td>{{ $current_details->cpu }}</td>
                                </tr>
                                <tr>
                                    <td>Camera trước</td>
                                    <td>{{ $current_details->front_cam }}</td>
                                </tr>
                                <tr>
                                    <td>Camera sau</td>
                                    <td>{{ $current_details->rear_cam }}</td>
                                </tr>
                                <tr>
                                    <td>Bluetooth</td>
                                    <td>{{ $current_details->bluetooth_ver }}</td>
                                </tr>
                                <tr>
                                    <td>WiFi</td>
                                    <td>{{ $current_details->wifi_ver }}</td>
                                </tr>
                                <tr>
                                    <td>NFC</td>
                                    <td>{{ $current_details->nfc }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-12 border-top mt-3 p-0">
                            <h5>Thông tin sản phẩm</h5>
                            <div class="container-fluid" style="height: 180px">
                                <div class="row">
                                    <div>
                                        @php
                                            echo $current_details->parentPhone->description
                                        @endphp
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 border-top mt-3 p-0">
                            <h5>Đánh giá sản phẩm</h5>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 col-lg-7 border rounded mt-2">
                                        <div class="container-fluid">
                                            <div class="row pt-1 border-bottom">
                                                <div class="col-6">
                                                    <h6>Nguyễn An <span class="lead fs-6">- 18/12/2023 12:52</span></h6>
                                                </div>
                                                <div class="col-6 text-nowrap text-end">
                                                    <i class="fa-solid fa-star text-warning"></i>
                                                    <i class="fa-solid fa-star text-warning"></i>
                                                    <i class="fa-solid fa-star text-warning"></i>
                                                    <i class="fa-solid fa-star text-warning"></i>
                                                    <i class="fa-solid fa-star text-warning"></i>
                                                </div>
                                            </div>
                                            <div class="row p-0">
                                                <div class="col-12">
                                                    <p>mình mua điện thoại này 4 lần rùi, xài rất tốt, 3 tháng hư 1 lần.
                                                        recommend nha :D</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-7 border rounded mt-2">
                                        <div class="container-fluid">
                                            <div class="row pt-1 border-bottom">
                                                <div class="col-6">
                                                    <h6>Trần Đức Bình <span class="lead fs-6">- 12/03/2024 11:35</span>
                                                    </h6>
                                                </div>
                                                <div class="col-6 text-nowrap text-end">
                                                    <i class="fa-solid fa-star text-warning"></i>
                                                    <i class="fa-solid fa-star text-warning"></i>
                                                    <i class="fa-solid fa-star text-warning"></i>
                                                    <i class="fa-solid fa-star text-warning"></i>
                                                    <i class="fa-regular fa-star text-warning"></i>
                                                </div>
                                            </div>
                                            <div class="row p-0">
                                                <div class="col-12">
                                                    <p>điện thoại quá lởm, ko nên mua nhé mn</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-7 border rounded mt-2">
                                        <div class="container-fluid">
                                            <div class="row pt-1 border-bottom">
                                                <div class="col-6">
                                                    <h6>bảnh <span class="lead fs-6">- 19/03/2024 21:27</span></h6>
                                                </div>
                                                <div class="col-6 text-nowrap text-end">
                                                    <i class="fa-solid fa-star text-warning"></i>
                                                    <i class="fa-regular fa-star text-warning"></i>
                                                    <i class="fa-regular fa-star text-warning"></i>
                                                    <i class="fa-regular fa-star text-warning"></i>
                                                    <i class="fa-regular fa-star text-warning"></i>
                                                </div>
                                            </div>
                                            <div class="row p-0">
                                                <div class="col-12">
                                                    <p>tổ sư bọn bán điện thoại thất đức</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-7 border rounded mt-2">
                                        <div class="container-fluid">
                                            <div class="row pt-1 border-bottom">
                                                <div class="col-6">
                                                    <h6>superman can tho <span class="lead fs-6">- 15/01/2024 16:01</span>
                                                    </h6>

                                                </div>
                                                <div class="col-6 text-nowrap text-end">
                                                    <i class="fa-solid fa-star text-warning"></i>
                                                    <i class="fa-solid fa-star text-warning"></i>
                                                    <i class="fa-regular fa-star text-warning"></i>
                                                    <i class="fa-regular fa-star text-warning"></i>
                                                    <i class="fa-regular fa-star text-warning"></i>
                                                </div>
                                            </div>
                                            <div class="row p-0">
                                                <div class="col-12">
                                                    <p>tr ơi nghĩ gì mà dám bán cái điện thoại liệt màn hình >:(</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-7 border rounded mt-2">
                                        <div class="container-fluid">
                                            <div class="row p-2 text-center">
                                                <div class="col-12">
                                                    <h6>Bạn cần đăng nhập để có thể đánh giá sản phẩm này!</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 border-top mt-3 p-0">
                            <h5>Xem thêm sản phẩm khác</h5>
                            <div class="container-fluid" style="height: 180px">
                                <div class="row text-center">
                                    <h1>Đang cập nhật...</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-0 col-sm-0 col-md-1 col-lg-1 col-xl-1">

            </div>
        </div>
    </div>
@endsection
