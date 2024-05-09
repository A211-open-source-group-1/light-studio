@extends('templates.appAdmin')
@section('content')
    <div class="container-fluid m-0 p-0 border-top">
        <div class="row">
            <div class="col-12 mt-3 text-center border-bottom">
                <h3>Đơn hàng</h3>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-12">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                      <button class="nav-link active" id="nav-processing-tab" data-bs-toggle="tab" data-bs-target="#nav-processing" type="button" role="tab" aria-controls="nav-processing" aria-selected="true">Chờ xác nhận</button>
                      <button class="nav-link" id="nav-proceed-tab" data-bs-toggle="tab" data-bs-target="#nav-proceed" type="button" role="tab" aria-controls="nav-proceed" aria-selected="false">Đã xác nhận</button>
                      <button class="nav-link" id="nav-delivering-tab" data-bs-toggle="tab" data-bs-target="#nav-delivering" type="button" role="tab" aria-controls="nav-delivering" aria-selected="false">Đang giao</button>
                      <button class="nav-link" id="nav-delivered-tab" data-bs-toggle="tab" data-bs-target="#nav-delivered" type="button" role="tab" aria-controls="nav-delivered" aria-selected="false">Đã giao</button>
                      <button class="nav-link" id="nav-all-tab" data-bs-toggle="tab" data-bs-target="#nav-all" type="button" role="tab" aria-controls="nav-all" aria-selected="false">Tất cả</button>
                    </div>
                  </nav>
                  
                  <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-processing" role="tabpanel" aria-labelledby="nav-processing-tab">
                        <div class="container-fluid mt-2">
                            @foreach ($processingOrders as $order)
                                <div class="col-12">
                                    <p>{{$order->order_date}}</p>
                                    <p>{{$order->name}}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-proceed" role="tabpanel" aria-labelledby="nav-proceed-tab">
                        <div class="container-fluid mt-2">
                            @foreach ($proceedOrders as $order)
                                <div class="col-12">
                                    <p>{{$order->order_date}}</p>
                                    <p>{{$order->name}}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-delivering" role="tabpanel" aria-labelledby="nav-delivering-tab">
                        <div class="container-fluid mt-2">
                            @foreach ($deliveringOrders as $order)
                                <div class="col-12">
                                    <p>{{$order->order_date}}</p>
                                    <p>{{$order->name}}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-delivered" role="tabpanel" aria-labelledby="nav-delivered-tab">
                        <div class="container-fluid mt-2">
                            @foreach ($deliveredOrders as $order)
                                <div class="col-12">
                                    <p>{{$order->order_date}}</p>
                                    <p>{{$order->name}}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">
                        <div class="container-fluid mt-2">
                            @foreach ($allOrders as $order)
                                <div class="col-12">
                                    <p>{{$order->order_date}}</p>
                                    <p>{{$order->name}}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
