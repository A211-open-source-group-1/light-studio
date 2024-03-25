@extends('templates.app')
@section('content')

<div class="container-fluid p-0 m-1">
    <div class="row border-bottom">
        <div class="col-12">
            <h5>{{$title}}</h5>
        </div>
    </div>
    <div class="row border-bottom mb-3 mt-1 pb-1">
        <div class="col-lg-2 col-md-4 col-6 pe-0">
            <select class="form-select" name="brand">
                <option selected disabled>Thương hiệu</option>
                @foreach($brands as $row)
                <option>{{$row->brand_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-2 col-md-4 col-6 pe-0">
            <select class="form-select" name="price">
                <option selected disabled>Khoảng giá</option>
            </select>
        </div>
        <div class="col-lg-2 col-md-4 col-6 pe-0">
            <select class="form-select" name="os">
                <option selected disabled>Hệ điều hành</option>
            </select>
        </div>
        <div class="col-lg-2 col-md-4 col-6 pe-0">
            <select class="form-select" name="sortByName">
                <option selected disabled>Sắp xếp theo tên</option>
            </select>
        </div>
        <div class="col-lg-2 col-md-4 col-6 pe-0">
            <select class="form-select" name="sortByPrice">
                <option selected disabled>Sắp xếp theo giá</option>
            </select>
        </div>
        <div class="col-lg-2 col-md-4 col-6 pe-0">
            <select class="form-select" name="sortByPrice">
                <option selected disabled>Sắp xếp theo đánh giá</option>
            </select>
        </div>
    </div>
    <div class="row mb-3 align-items-md-stretch">
        @foreach($products as $row)
        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 mb-3 d-flex align-items-stretch">
          <div class="card zoom-on" style="">
            <img class="card-img-top card-img-product" src="{{asset('/image/sample-card.jpg')}}">
            <div class="card-body text-center">
              <a class="text-decoration-none" href="{{URL::to('/phone/' . $row->parentPhone->phone_id . '/detail/' . $row->phone_details_id) . '/specs/0'}}"><h6 class="card-title fw-bold truncate-text">{{$row->parentPhone->phone_name . ' ' . $row->phone_details_name . ' ' . $row->color_name}}</h6></a>
              <h6 class="text-danger fw-bold">{{number_format($row->price, 0, ',', '.') ?? '...'}} VNĐ</h6>
            </div>
          </div>
        </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-12 text-center">
            {!!$products->links()!!}
        </div>
    </div>
</div>


@endsection