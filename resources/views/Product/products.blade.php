@extends('templates.app')
@section('content')
    <div class="container-fluid p-0">
        <div class="row border-bottom">
            <div class="col-12">
                <h5>{{ $title ?? '' }}</h5>
            </div>
        </div>
        <script src="{{ asset('/js/productHandler.js') }}"></script>
        <form id="filterForm">
            @csrf
            <div id="filterDiv" class="row border-bottom mb-3 mt-1 pb-1">
                <div class="col-lg-3 col-md-4 col-6 pe-0">
                    <select class="form-select" name="brand" onchange="defaultSubmit()">
                        <option selected disabled>Thương hiệu</option>
                        <option>Tất cả</option>
                        @foreach ($brands as $row)
                            <option value="{{ $row->brand_name }}">{{ $row->brand_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-3 col-md-4 col-6 pe-0">
                    <select class="form-select" name="priceRange" onchange="defaultSubmit()">
                        <option selected disabled>Khoảng giá</option>
                        <option value="default">Mặc định</option>
                        <option value="range-1">Dưới 2 triệu</option>
                        <option value="range-2">Từ 2 - 4 triệu</option>
                        <option value="range-3">Từ 4 - 8 triệu</option>
                        <option value="range-4">Từ 8 - 15 triệu</option>
                        <option value="range-5">Trên 15 triệu</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-4 col-6 pe-0">
                    <select class="form-select" name="os" onchange="defaultSubmit()">
                        <option selected disabled>Hệ điều hành</option>
                        <option value="android">Android</option>
                        <option value="ios">iOS</option>
                        <option>Khác</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-4 col-6 pe-0">
                    <select class="form-select" name="sort" onchange="defaultSubmit()">
                        <option selected disabled>Sắp xếp</option>
                        <option>Mặc định</option>
                        <option value="name_asc">Tên giảm dần</option>
                        <option value="name_desc">Tên tăng dần</option>
                        <option value="price_asc">Giá tăng dần</option>
                        <option value="price_desc">Giá giảm dần</option>
                        <option value="review_asc">Đánh giá cao nhất</option>
                        <option value="review_desc">Đánh giá tệ nhất</option>
                    </select>
                </div>
            </div>
        </form>
        <section id="product-section">
            <div class="row mb-3 align-items-md-stretch">
                @foreach ($products as $row)
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 mb-3 d-flex align-items-stretch">
                        <div class="card zoom-on w-100 h-100" style="">
                            <img class="card-img-top card-img-product w-100 h-100"
                                src="{{ asset('/image/' . $row->thumbnail_img) }}">
                            <div class="card-body text-center">
                                <a class="text-decoration-none"
                                    href="{{ URL::to('/phone/' . $row->parentPhone->phone_id . '/detail/' . $row->phone_details_id) . '/specs/0' }}">
                                    <h6 class="card-title fw-bold truncate-text">
                                        {{ ($row->phone_name ?? 'null') . ' ' . ($row->specific_name ?? 'null') . ' ' . ($row->color_name ?? 'null') }}
                                    </h6>
                                </a>
                                <h6 class="text-danger fw-bold">{{ number_format($row->price, 0, ',', '.') ?? 'null' }} VNĐ
                                </h6>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    {!! $products->links() !!}
                </div>
            </div>
        </section>
    </div>
@endsection
