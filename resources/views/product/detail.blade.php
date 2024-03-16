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
                        <h4>PRODUCT NAME</h4>
                    </div>
                    <div class="col-12 col-lg-8 mt-3 p-0">
                        <div id="carousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                              <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                              <button type="button" data-bs-target="#carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                              <button type="button" data-bs-target="#carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            </div>
                            <div class="carousel-inner">
                              <div class="carousel-item active">
                                <img src="{{asset('/image/banner1.jpg')}}" class="d-block w-100 product-img" alt="...">
                              </div>
                              <div class="carousel-item">
                                <img src="{{asset('/image/banner2.jpg')}}" class="d-block w-100 product-img" alt="...">
                              </div>
                              <div class="carousel-item">
                                <img src="{{asset('/image/banner3.jpg')}}" class="d-block w-100 product-img" alt="...">
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
                        <div class="container mt-4 p-3 border-top">
                            <h5 class="mt-3">Chọn phiên bản:</h5>
                            <div class="pb-2  text-center">
                                <button type="button" class="btn btn-sm btn-outline-secondary">Phiên bản 1</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary">Phiên bản 2</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary">Phiên bản 3</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary">Phiên bản 4</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 mt-3">
                        
                        <h5 class="pb-2 border-bottom">Tình trạng: <span class="text-success fw-bold">Còn hàng</span></h5>
                        <h5 class="pb-2 border-bottom">Giá: <span class="text-danger fw-bold">199xx VNĐ</span></h5>
                        <div class="d-grid gap-2 pb-2">
                            <button class="btn btn-warning">MUA NGAY</button>
                            <button class="btn btn-primary btn-block">MUA TRẢ GÓP</button>
                            <button class="btn btn-primary btn-block">MUA TRẢ GÓP QUA THẺ</button>
                        </div>
                        <h5 class="border-bottom pb-2">Thông số kỹ thuật</h5>
                        <table class="table table-striped">
                            <tr>
                                <td>Màn hình</td>
                                <td>text</td>
                            </tr>
                            <tr>
                                <td>Màu sắc</td>
                                <td>text</td>
                            </tr>
                            <tr>
                                <td>Bộ nhớ RAM</td>
                                <td>text</td>
                            </tr>
                            <tr>
                                <td>Bộ nhớ trong</td>
                                <td>text</td>
                            </tr>
                            <tr>
                                <td>CPU</td>
                                <td>text</td>
                            </tr>
                            <tr>
                                <td>Camera trước</td>
                                <td>text</td>
                            </tr>
                            <tr>
                                <td>Camera sau</td>
                                <td>text</td>
                            </tr>
                            <tr>
                                <td>Bluetooth</td>
                                <td>text</td>
                            </tr>
                            <tr>
                                <td>WiFi</td>
                                <td>text</td>
                            </tr>
                            <tr>
                                <td>NFC</td>
                                <td>text</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-12 border-top mt-3">
                        <h5>Thông tin sản phẩm</h5>
                        <div class="container-fluid" style="height: 180px">
                            <div class="row text-center">
                                <h1>Đang cập nhật...</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 border-top mt-3">
                        <h5>Đánh giá sản phẩm</h5>
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