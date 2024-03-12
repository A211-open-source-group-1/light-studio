@extends('templates.app')
@section('content')  
  <div id="carousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="{{asset('/image/banner1.jpg')}}" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="{{asset('/image/banner2.jpg')}}" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="{{asset('/image/banner3.jpg')}}" class="d-block w-100" alt="...">
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
      <div class="row">
        <div class="col-12 mt-3">
          <h3>IPHONE SALE SẬP SÀN!</h3>
        </div>
      </div>
      <div class="row mb-3 align-items-md-stretch">
          <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 mb-3 d-flex align-items-stretch">
            <div class="card" style="">
              <img class="card-img-top" src="{{asset('/image/sample-card.jpg')}}">
              <div class="card-body text-center">
                <a href="{{URL::to('/detail/1')}}"><h5 class="card-title fw-bold">TITLE TEXT</h5></a>
                
                <h6 class="text-danger fw-bold">Giá: 29.990.000đ</h6>
                <a class="btn btn-warning" href="#">Thêm vào giỏ hàng</a>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 mb-3 d-flex align-items-stretch">
            <div class="card" style="">
              <img class="card-img-top" src="{{asset('/image/sample-card.jpg')}}">
              <div class="card-body text-center">
                <h5 class="card-title fw-bold">TITLE TEXT</h5>
                <h6 class="text-danger fw-bold">Giá: 29.990.000đ</h6>
                <a class="btn btn-warning" href="#">Thêm vào giỏ hàng</a>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 mb-3 d-flex align-items-stretch">
            <div class="card" style="">
              <img class="card-img-top" src="{{asset('/image/sample-card.jpg')}}">
              <div class="card-body text-center">
                <h5 class="card-title fw-bold">TITLE TEXT</h5>
                <h6 class="text-danger fw-bold">Giá: 29.990.000đ</h6>
                <a class="btn btn-warning" href="#">Thêm vào giỏ hàng</a>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 mb-3 d-flex align-items-stretch">
            <div class="card" style="">
              <img class="card-img-top" src="{{asset('/image/sample-card.jpg')}}">
              <div class="card-body text-center">
                <h5 class="card-title fw-bold">TITLE TEXT</h5>
                <h6 class="text-danger fw-bold">Giá: 29.990.000đ</h6>
                <a class="btn btn-warning" href="#">Thêm vào giỏ hàng</a>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 mb-3 d-flex align-items-stretch">
            <div class="card" style="">
              <img class="card-img-top" src="{{asset('/image/sample-card.jpg')}}">
              <div class="card-body text-center">
                <h5 class="card-title fw-bold">TITLE TEXT</h5>
                <h6 class="text-danger fw-bold">Giá: 29.990.000đ</h6>
                <a class="btn btn-warning" href="#">Thêm vào giỏ hàng</a>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 mb-3 d-flex align-items-stretch">
            <div class="card" style="">
              <img class="card-img-top" src="{{asset('/image/sample-card.jpg')}}">
              <div class="card-body text-center">
                <h5 class="card-title fw-bold">TITLE TEXT</h5>
                <h6 class="text-danger fw-bold">Giá: 29.990.000đ</h6>
                <a class="btn btn-warning" href="#">Thêm vào giỏ hàng</a>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 mb-3 d-flex align-items-stretch">
            <div class="card" style="">
              <img class="card-img-top" src="{{asset('/image/sample-card.jpg')}}">
              <div class="card-body text-center">
                <h5 class="card-title fw-bold">TITLE TEXT</h5>
                <h6 class="text-danger fw-bold">Giá: 29.990.000đ</h6>
                <a class="btn btn-warning" href="#">Thêm vào giỏ hàng</a>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 mb-3 d-flex align-items-stretch">
            <div class="card" style="">
              <img class="card-img-top" src="{{asset('/image/sample-card.jpg')}}">
              <div class="card-body text-center">
                <h5 class="card-title fw-bold">TITLE TEXT</h5>
                <h6 class="text-danger fw-bold">Giá: 29.990.000đ</h6>
                <a class="btn btn-warning" href="#">Thêm vào giỏ hàng</a>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 mb-3 d-flex align-items-stretch">
            <div class="card" style="">
              <img class="card-img-top" src="{{asset('/image/sample-card.jpg')}}">
              <div class="card-body text-center">
                <h5 class="card-title fw-bold">TITLE TEXT</h5>
                <h6 class="text-danger fw-bold">Giá: 29.990.000đ</h6>
                <a class="btn btn-warning" href="#">Thêm vào giỏ hàng</a>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 mb-3 d-flex align-items-stretch">
            <div class="card" style="">
              <img class="card-img-top" src="{{asset('/image/sample-card.jpg')}}">
              <div class="card-body text-center">
                <h5 class="card-title fw-bold">TITLE TEXT</h5>
                <h6 class="text-danger fw-bold">Giá: 29.990.000đ</h6>
                <a class="btn btn-warning" href="#">Thêm vào giỏ hàng</a>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 mb-3 d-flex align-items-stretch">
            <div class="card" style="">
              <img class="card-img-top" src="{{asset('/image/sample-card.jpg')}}">
              <div class="card-body text-center">
                <h5 class="card-title fw-bold">TITLE TEXT</h5>
                <h6 class="text-danger fw-bold">Giá: 29.990.000đ</h6>
                <a class="btn btn-warning" href="#">Thêm vào giỏ hàng</a>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 mb-3 d-flex align-items-stretch">
            <div class="card" style="">
              <img class="card-img-top" src="{{asset('/image/sample-card.jpg')}}">
              <div class="card-body text-center">
                <h5 class="card-title fw-bold">TITLE TEXT</h5>
                <h6 class="text-danger fw-bold">Giá: 29.990.000đ</h6>
                <a class="btn btn-warning" href="#">Thêm vào giỏ hàng</a>
              </div>
            </div>
          </div>
      </div>
  </div>
@endsection
