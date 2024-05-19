@extends('templates.app')
@section('content')
    <div class="container-fluid p-0 m-0">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-10 col-lg-10 col-xl-10">
                {{ Breadcrumbs::render('products', $brand_id) }}
            </div>
        </div>
    </div>
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
                    <select class="form-select" id="select-brand" name="brand" onchange="defaultSubmit()">
                        <option value="">Tất cả</option>
                        @foreach ($brands as $row)
                            <option value="{{ $row->brand_name }}">{{ $row->brand_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-3 col-md-4 col-6 pe-0">
                    <select class="form-select" id="select-price-range" name="priceRange" onchange="defaultSubmit()">
                        <option value="">Mặc định</option>
                        <option value="range-1">Dưới 2 triệu</option>
                        <option value="range-2">Từ 2 - 4 triệu</option>
                        <option value="range-3">Từ 4 - 8 triệu</option>
                        <option value="range-4">Từ 8 - 15 triệu</option>
                        <option value="range-5">Trên 15 triệu</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-4 col-6 pe-0">
                    <select class="form-select" id="select-os" name="os" onchange="defaultSubmit()">
                        <option value="">Mặc định</option>
                        <option value="1">iOS</option>
                        <option value="2">Android</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-4 col-6 pe-0">
                    <select class="form-select" id="select-sort" name="sort" onchange="defaultSubmit()">
                        <option value="">Mặc định</option>
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
        <script>
            $('#select-brand').select2({
                placeholder: 'Thương hiệu',
                allowClear: true
            });
            $('#select-price-range').select2({
                placeholder: 'Khoảng giá',
                allowClear: true
            });
            $('#select-os').select2({
                placeholder: 'Hệ điều hành',
                allowClear: true
            });
            $('#select-sort').select2({
                placeholder: 'Sắp xếp',
                allowClear: true
            });
        </script>
        <section id="product-section">
            <div class="row mb-3 align-items-md-stretch">
                @foreach ($products as $row)
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 mb-3 d-flex align-items-stretch">
                        <div class="card zoom-on w-100 h-100 position-relative">
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
                            <img class="card-img-top card-img-product" style="height: 335px"
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
                                            class="fa-solid fa-code-compare"></i>
                                        So sánh</button>
                                </div>
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
