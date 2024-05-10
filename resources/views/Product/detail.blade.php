@extends('templates.app')
@section('content')
    <script>
        function loadMore() {
            if (x + 10 >= max) {
                $("#btnLoad").addClass("hiddenComp");
            }
            for (let i = x + 1; i <= x + 10; ++i) {
                $("#" + i.toString()).removeClass("hiddenComp");
            }
            x += 10;
        }
    </script>
    <div class="container-fluid p-0 m-0">
        <div class="row p-0 m-0">
            <div class="col-0 col-sm-0 col-md-1 col-lg-1 col-xl-1">
            </div>
            <div class="col-12 col-sm-12 col-md-10 col-lg-10 col-xl-10">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 border-bottom">
                            <h4>{{ $current_details->parentPhone->phone_name . ' ' . $current_details->parentSpecific->specific_name . ' ' . $current_details->parentColor->color_name }}
                            </h4>
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
                                                        data-bs-slide-to="{{ $num }}" class="active "
                                                        aria-current="true" aria-label="Slide {{ $num++ }}"></button>
                                                @endforeach
                                            </div>
                                            <div class="carousel-inner">
                                                <div class="carousel-item active text-center">
                                                    <img src="{{ asset('/image/' . $current_details->thumbnail_img) }}"
                                                        class="btn d-block w-100 h-100 product-img info" alt="...">
                                                </div>
                                                @foreach ($images as $row)
                                                    <div class="carousel-item">
                                                        <img src="{{ asset('/image/' . $row->file_path) }}"
                                                            class="btn d-block w-100 h-100 product-img info" alt="...">
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
                                            href="{{ URL::to('/phone/' . $phone_id . '/detail/' . $current_details->phone_details_id . '/specs/' . $row->specific_id) }}">{{ $row->specific_name }}</a>
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
                            <h5 class="pb-2 border-bottom">Tình trạng:
                                @if ($current_details->quantity > 0)
                                    <span class="text-success fw-bold">Còn hàng</span>
                                @else
                                    <span class="text-danger fw-bold">Hết hàng</span>
                                @endif

                            </h5>
                            <h5 class="pb-2 border-bottom">Giá:
                                @if ($current_details->discount != 0)
                                    <span
                                        class="text-danger fw-bold text-decoration-line-through">{{ number_format($current_details->price, 0, ',', '.') }}
                                        VNĐ</span>
                                    <span class="text-danger fw-bold">
                                        {{ number_format($current_details->price - $current_details->discount, 0, ',', '.') }}
                                        VNĐ</span>
                                    <span class="badge bg-warning">GIẢM GIÁ</span>
                                @else
                                    <span
                                        class="text-danger fw-bold">{{ number_format($current_details->price, 0, ',', '.') }}
                                        VNĐ</span>
                                @endif
                            </h5>
                            <div class="d-grid gap-2 pb-2">
                                <script src="{{ asset('/js/cartHandler.js') }}"></script>
                                @if ($current_details->quantity > 0)
                                    <button class="btn btn-warning"
                                        onclick="AddToCart('{{ $current_details->phone_details_id }}')">THÊM VÀO
                                        GIỎ</button>
                                    <button class="btn btn-primary btn-block">MUA TRẢ GÓP</button>
                                    <button class="btn btn-primary btn-block">MUA TRẢ GÓP QUA THẺ</button>
                                @else
                                    <button class="btn btn-warning btn-block">LIÊN HỆ TÔI KHI CÓ HÀNG</button>
                                @endif
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
                            <h5 style="text-left">Video giới thiệu sản phẩm</h5>
                            <div class="w-100 text-center mt-3">
                                <iframe width="650" height="430"
                                    src="{{$current_details->parentPhone->youtube_url}}">
                                </iframe>
                            </div>
                        </div>
                        <div class="col-12 border-top mt-3 p-0">
                            <h5>Thông tin sản phẩm</h5>
                            <div class="container-fluid">
                                <div class="row">
                                    <div>
                                        @php
                                            echo $current_details->parentPhone->description;
                                        @endphp
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 border-top mt-3 p-0">
                            <h5>Đánh giá sản phẩm</h5>
                            <div class="container-fluid">
                                <?php
                                $num = 1;
                                ?>
                                <div class="row">
                                    @foreach ($reviews as $row)
                                        <div id="<?php echo $num; ?>"
                                            class="col-12 col-lg-7 border rounded mt-2 hiddenComp">
                                            <div class="container-fluid">
                                                <div class="row pt-1 border-bottom">
                                                    <div class="col-6">
                                                        <h6>{{ $row->parentUser->name }} <span class="lead fs-6">-
                                                                {{ $row->time }}</span></h6>
                                                    </div>
                                                    <div class="col-6 text-nowrap text-end">
                                                        @for ($i = 0; $i < $row->rating; $i++)
                                                            <i class="fa-solid fa-star text-warning"></i>
                                                        @endfor

                                                        @if ($row->rating < 5)
                                                            @php
                                                            $count = 5 - $row->rating;
                                                            @endphp
                                                            @for ($i = 0; $i < $count; $i++)
                                                                <i class="fa-regular fa-star text-warning"></i>
                                                            @endfor
                                                        @endif
                                                    </div>

                                                </div>
                                                <div class="row p-0">
                                                    <div class="col-12">
                                                        <p>{{ $row->content }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php $num++; ?>
                                        </div>
                                    @endforeach
                                    <div class="col-12 col-lg-7 border rounded mt-2">
                                        <div class="row p-2 text-center">
                                            <div class="col-10 ">
                                                <button class="btn btn-sm btn-outline-secondary p-2 " id="btnLoad"
                                                    onclick="loadMore()">Xem thêm đánh giá</button>
                                                @if (Auth::check())
                                                    <a id="rating-btn"
                                                        class="btn btn-primary btn-sm btn-outline-light p-2"
                                                        data-user-id="{{ '/phone' . $current_details->parentPhone->phone_id . '/detail/' . $current_details->phone_details_id . '/specs/0' }}">Viết
                                                        đánh giá</a>
                                                @else
                                                    <h6>Bạn cần đăng nhập để có thể đánh giá sản phẩm này!</h6>
                                                @endif
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
        </div>
        <div class="col-0 col-sm-0 col-md-1 col-lg-1 col-xl-1">

        </div>
    </div>
    </div>

    <div class="modal fade hide" id="ratingModal" tabindex="-1" aria-labelledby="ratingModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Đánh giá</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                </div>
                <form action="{{ route('userRatingProduct') }}" method="post">
                    {{ csrf_field() }}
                    <div class="modal-body card">
                        <div class="text-center">
                            <img class="card-img-top w-50" src="{{ asset('/image/' . $current_details->thumbnail_img) }}"
                                alt="Card image cap">
                        </div>
                        <div class="text-center ">
                            <i class="fa-regular fa-star text-warning fa-solid rating" data-index="1"></i>
                            <i class="fa-regular fa-star text-warning rating" data-index="2"></i>
                            <i class="fa-regular fa-star text-warning rating" data-index="3"></i>
                            <i class="fa-regular fa-star text-warning rating" data-index="4"></i>
                            <i class="fa-regular fa-star text-warning rating" data-index="5"></i>
                        </div>
                        <div class="text-center">
                            <input type="hidden" name="number_rating" class="number_rating">
                            <input type="hidden" name="phone_details_id"
                                value="{{ $current_details->phone_details_id }}">


                            <h4>{{ $current_details->parentPhone->phone_name . ' ' . $current_details->parentSpecific->specific_name . ' ' . $current_details->parentColor->color_name }}
                            </h4>

                        </div>
                        <div class="card-body">
                            <textarea placeholder="Mời bạn bình luận sản phẩm" name="content" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Gửi đánh giá</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade hide" id="infoProductModal" tabindex="-1" aria-labelledby="infoProductModal"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered w-100">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center">Hình ảnh sản phẩm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                </div>
                <div class="modal-body card">
                    <div class="text-center">
                        <h4>{{ $current_details->parentPhone->phone_name . ' ' . $current_details->parentSpecific->specific_name . ' ' . $current_details->parentColor->color_name }}
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-0 col-lg-1">
                            </div>
                            @php
                                $num = 1;
                            @endphp
                            <div class="col-12 col-lg-10">
                                <div id="carousel2" class="carousel carousel-dark slide" data-bs-ride="carousel2">
                                    <div class="carousel-indicators">
                                        <button type="button" data-bs-target="#carousel2" data-bs-slide-to="0"
                                            class="active" aria-current="true" aria-label="Slide 0"></button>
                                        @foreach ($images as $row)
                                            <button type="button" data-bs-target="#carousel2"
                                                data-bs-slide-to="{{ $num }}" class="active "
                                                aria-current="true" aria-label="Slide {{ $num++ }}"></button>
                                        @endforeach
                                    </div>
                                    <div class="carousel-inner">
                                        <div class="carousel-item active text-center">
                                            <img src="{{ asset('/image/' . $current_details->thumbnail_img) }}"
                                                class="btn d-block w-100 h-100 product-img " alt="...">
                                        </div>
                                        @foreach ($images as $row)
                                            <div class="carousel-item">
                                                <img src="{{ asset('/image/' . $row->file_path) }}"
                                                    class="btn d-block w-100 h-100 product-img " alt="...">
                                            </div>
                                        @endforeach
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel2"
                                        data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carousel2"
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let max = <?php echo $reviews->count(); ?>;
        let x = 5;
        $(document).ready(function() {
            if (5 >= max - 1) {
                $("#btnLoad").addClass("hiddenComp");
            }
            for (let i = 1; i <= 5; ++i) {
                $("#" + i.toString()).removeClass("hiddenComp");
            }
        });
    </script>
@endsection
