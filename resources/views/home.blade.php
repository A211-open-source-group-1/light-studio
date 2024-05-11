@extends('templates.app')
@section('content')
    <div id="carousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active" aria-current="true"
                aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('/image/banner-ip15.png') }}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('/image/banner-ip15.png') }}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('/image/banner-ip15.png') }}" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="container-fluid mt-3 border-top border-bottom">
        @if ($productsType1)
            <div class="row">
                <div class="col-12 mt-3">
                    <h3>IPHONE MỚI NHẤT!</h3>
                </div>
            </div>
            <div class="row mb-3 align-items-md-stretch">
                @foreach ($productsType1 as $row)
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 mb-3 d-flex align-items-stretch">
                        <div class="card zoom-on w-100 h-100 position-relative" style="">
                            <div class="position-absolute top-0 start-0 ms-5 mt-3" style="width: 100%">
                                @if ($row->discount != 0)
                                    <span class="translate-middle badge bg-warning">
                                        GIẢM GIÁ
                                    </span>
                                @endif
                                @if ($row->quantity <= 0)
                                    <span class="translate-middle badge bg-danger">
                                        HẾT HÀNG
                                    </span>
                                @endif
                            </div>
                            <img class="card-img-top card-img-product w-100 h-100"
                                src="{{ asset('/image/' . $row->thumbnail_img) }}">
                            <div class="card-body text-center">
                                <a class="text-decoration-none"
                                    href="{{ URL::to('/phone/' . $row->parentPhone->phone_id . '/detail/' . $row->phone_details_id) . '/specs/0' }}">
                                    <h6 class="card-title fw-bold truncate-text">
                                        {{ ($row->phone_name ?? 'null') . ' ' . ($row->specific_name ?? 'null') . ' ' . ($row->color_name ?? 'null') }}
                                    </h6>
                                </a>
                                @if ($row->discount != 0)
                                    <h6 class="text-danger fw-bold text-decoration-line-through">
                                        {{ number_format($row->price, 0, ',', '.') }}
                                        VNĐ</h6>
                                    <h6 class="text-danger fw-bold">
                                        {{ number_format($row->price - $row->discount, 0, ',', '.') }}
                                        VNĐ</h6>
                                @else
                                    <h6 class="text-danger fw-bold">{{ number_format($row->price, 0, ',', '.') }}
                                        VNĐ</h6>
                                @endif

                                @if ($row->reviews_count > 0)
                                    <div class="text-center d-inline">
                                        @if ($row->reviews_avg_rating >= 4.5)
                                            <i class="fa-regular fa-star text-warning fa-solid"></i>
                                            <i class="fa-regular fa-star text-warning fa-solid"></i>
                                            <i class="fa-regular fa-star text-warning fa-solid"></i>
                                            <i class="fa-regular fa-star text-warning fa-solid"></i>
                                            <i class="fa-regular fa-star text-warning fa-solid"></i>
                                        @elseif ($row->reviews_avg_rating >= 3.5)
                                            <i class="fa-regular fa-star text-warning fa-solid"></i>
                                            <i class="fa-regular fa-star text-warning fa-solid"></i>
                                            <i class="fa-regular fa-star text-warning fa-solid"></i>
                                            <i class="fa-regular fa-star text-warning fa-solid"></i>
                                            <i class="fa-regular fa-star text-warning rating"></i>
                                        @elseif ($row->reviews_avg_rating >= 2.5)
                                            <i class="fa-regular fa-star text-warning fa-solid"></i>
                                            <i class="fa-regular fa-star text-warning fa-solid"></i>
                                            <i class="fa-regular fa-star text-warning fa-solid"></i>
                                            <i class="fa-regular fa-star text-warning rating"></i>
                                            <i class="fa-regular fa-star text-warning rating"></i>
                                        @elseif ($row->reviews_avg_rating >= 1.5)
                                            <i class="fa-regular fa-star text-warning fa-solid"></i>
                                            <i class="fa-regular fa-star text-warning fa-solid"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                        @elseif ($row->reviews_avg_rating >= 0.5)
                                            <i class="fa-regular fa-star text-warning fa-solid"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                        @else
                                            <i class="fa-regular fa-star text-warning"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                        @endif
                                    </div>
                                    <p class="p-0 m-0 d-inline"> ({{ $row->reviews_count }})</p>
                                @else
                                    <div class="text-center">
                                        <p class="p-0 m-0 d-inline">Chưa có đánh giá</p>
                                    </div>
                                @endif
                                <div class="text-start">
                                    <button class="btn btn-sm btn-outline-primary"><i
                                            class="fa-solid fa-code-compare"></i> So
                                        sánh</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        @if ($productsType2)
            <div class="row">

                <div class="col-12 mt-3">
                    <h3>SAMSUNG MỚI NHẤT!</h3>
                </div>
            </div>
            <div class="row mb-3 align-items-md-stretch">
                @foreach ($productsType2 as $row)
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 mb-3 d-flex align-items-stretch">
                        <div class="card zoom-on w-100 h-100 position-relative" style="">
                            <div class="position-absolute top-0 start-0 ms-5 mt-3" style="width: 100%">
                                @if ($row->discount != 0)
                                    <span class="translate-middle badge bg-warning">
                                        GIẢM GIÁ
                                    </span>
                                @endif
                                @if ($row->quantity <= 0)
                                    <span class="translate-middle badge bg-danger">
                                        HẾT HÀNG
                                    </span>
                                @endif
                            </div>
                            <img class="card-img-top card-img-product w-100 h-100"
                                src="{{ asset('/image/' . $row->thumbnail_img) }}">
                            <div class="card-body text-center">
                                <a class="text-decoration-none"
                                    href="{{ URL::to('/phone/' . $row->parentPhone->phone_id . '/detail/' . $row->phone_details_id) . '/specs/0' }}">
                                    <h6 class="card-title fw-bold truncate-text">
                                        {{ ($row->phone_name ?? 'null') . ' ' . ($row->specific_name ?? 'null') . ' ' . ($row->color_name ?? 'null') }}
                                    </h6>
                                </a>
                                @if ($row->discount != 0)
                                    <h6 class="text-danger fw-bold text-decoration-line-through">
                                        {{ number_format($row->price, 0, ',', '.') }}
                                        VNĐ</h6>
                                    <h6 class="text-danger fw-bold">
                                        {{ number_format($row->price - $row->discount, 0, ',', '.') }}
                                        VNĐ</h6>
                                @else
                                    <h6 class="text-danger fw-bold">{{ number_format($row->price, 0, ',', '.') }}
                                        VNĐ</h6>
                                @endif

                                @if ($row->reviews_count > 0)
                                    <div class="text-center d-inline">
                                        @if ($row->reviews_avg_rating >= 4.5)
                                            <i class="fa-regular fa-star text-warning fa-solid"></i>
                                            <i class="fa-regular fa-star text-warning fa-solid"></i>
                                            <i class="fa-regular fa-star text-warning fa-solid"></i>
                                            <i class="fa-regular fa-star text-warning fa-solid"></i>
                                            <i class="fa-regular fa-star text-warning fa-solid"></i>
                                        @elseif ($row->reviews_avg_rating >= 3.5)
                                            <i class="fa-regular fa-star text-warning fa-solid"></i>
                                            <i class="fa-regular fa-star text-warning fa-solid"></i>
                                            <i class="fa-regular fa-star text-warning fa-solid"></i>
                                            <i class="fa-regular fa-star text-warning fa-solid"></i>
                                            <i class="fa-regular fa-star text-warning rating"></i>
                                        @elseif ($row->reviews_avg_rating >= 2.5)
                                            <i class="fa-regular fa-star text-warning fa-solid"></i>
                                            <i class="fa-regular fa-star text-warning fa-solid"></i>
                                            <i class="fa-regular fa-star text-warning fa-solid"></i>
                                            <i class="fa-regular fa-star text-warning rating"></i>
                                            <i class="fa-regular fa-star text-warning rating"></i>
                                        @elseif ($row->reviews_avg_rating >= 1.5)
                                            <i class="fa-regular fa-star text-warning fa-solid"></i>
                                            <i class="fa-regular fa-star text-warning fa-solid"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                        @elseif ($row->reviews_avg_rating >= 0.5)
                                            <i class="fa-regular fa-star text-warning fa-solid"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                        @else
                                            <i class="fa-regular fa-star text-warning"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                        @endif
                                    </div>
                                    <p class="p-0 m-0 d-inline"> ({{ $row->reviews_count }})</p>
                                @else
                                    <div class="text-center">
                                        <p class="p-0 m-0 d-inline">Chưa có đánh giá</p>
                                    </div>
                                @endif
                                <div class="text-start">
                                    <button class="btn btn-sm btn-outline-primary"><i
                                            class="fa-solid fa-code-compare"></i> So sánh</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        @if ($productsType3)
            <div class="row">
                <div class="col-12 mt-3">
                    <h3>ĐIỆN THOẠI GIẢM GIÁ HOT!</h3>
                </div>
            </div>
            <div class="row mb-3 align-items-md-stretch">
                @foreach ($productsType3 as $row)
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 mb-3 d-flex align-items-stretch">
                        <div class="card zoom-on w-100 h-100 position-relative" style="">
                            <div class="position-absolute top-0 start-0 ms-5 mt-3" style="width: 100%">
                                @if ($row->discount != 0)
                                    <span class="translate-middle badge bg-warning">
                                        GIẢM GIÁ
                                    </span>
                                @endif
                                @if ($row->quantity <= 0)
                                    <span class="translate-middle badge bg-danger">
                                        HẾT HÀNG
                                    </span>
                                @endif
                            </div>
                            <img class="card-img-top card-img-product w-100 h-100"
                                src="{{ asset('/image/' . $row->thumbnail_img) }}">
                            <div class="card-body text-center">
                                <a class="text-decoration-none"
                                    href="{{ URL::to('/phone/' . $row->parentPhone->phone_id . '/detail/' . $row->phone_details_id) . '/specs/0' }}">
                                    <h6 class="card-title fw-bold truncate-text">
                                        {{ ($row->phone_name ?? 'null') . ' ' . ($row->specific_name ?? 'null') . ' ' . ($row->color_name ?? 'null') }}
                                    </h6>
                                </a>
                                @if ($row->discount != 0)
                                    <h6 class="text-danger fw-bold text-decoration-line-through">
                                        {{ number_format($row->price, 0, ',', '.') }}
                                        VNĐ</h6>
                                    <h6 class="text-danger fw-bold">
                                        {{ number_format($row->price - $row->discount, 0, ',', '.') }}
                                        VNĐ</h6>
                                @else
                                    <h6 class="text-danger fw-bold">{{ number_format($row->price, 0, ',', '.') }}
                                        VNĐ</h6>
                                @endif

                                @if ($row->reviews_count > 0)
                                    <div class="text-center d-inline">
                                        @if ($row->reviews_avg_rating >= 4.5)
                                            <i class="fa-regular fa-star text-warning fa-solid"></i>
                                            <i class="fa-regular fa-star text-warning fa-solid"></i>
                                            <i class="fa-regular fa-star text-warning fa-solid"></i>
                                            <i class="fa-regular fa-star text-warning fa-solid"></i>
                                            <i class="fa-regular fa-star text-warning fa-solid"></i>
                                        @elseif ($row->reviews_avg_rating >= 3.5)
                                            <i class="fa-regular fa-star text-warning fa-solid"></i>
                                            <i class="fa-regular fa-star text-warning fa-solid"></i>
                                            <i class="fa-regular fa-star text-warning fa-solid"></i>
                                            <i class="fa-regular fa-star text-warning fa-solid"></i>
                                            <i class="fa-regular fa-star text-warning rating"></i>
                                        @elseif ($row->reviews_avg_rating >= 2.5)
                                            <i class="fa-regular fa-star text-warning fa-solid"></i>
                                            <i class="fa-regular fa-star text-warning fa-solid"></i>
                                            <i class="fa-regular fa-star text-warning fa-solid"></i>
                                            <i class="fa-regular fa-star text-warning rating"></i>
                                            <i class="fa-regular fa-star text-warning rating"></i>
                                        @elseif ($row->reviews_avg_rating >= 1.5)
                                            <i class="fa-regular fa-star text-warning fa-solid"></i>
                                            <i class="fa-regular fa-star text-warning fa-solid"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                        @elseif ($row->reviews_avg_rating >= 0.5)
                                            <i class="fa-regular fa-star text-warning fa-solid"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                        @else
                                            <i class="fa-regular fa-star text-warning"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                        @endif
                                    </div>
                                    <p class="p-0 m-0 d-inline"> ({{ $row->reviews_count }})</p>
                                @else
                                    <div class="text-center">
                                        <p class="p-0 m-0 d-inline">Chưa có đánh giá</p>
                                    </div>
                                @endif
                                <div class="text-start">
                                    <button class="btn btn-sm btn-outline-primary"><i
                                            class="fa-solid fa-code-compare"></i> So sánh</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
