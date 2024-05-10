@extends('templates.appAdmin')
@section('content')
    <title>Đơn hàng</title>
    <div class="container-fluid mt-3 border-top" id="orderedCart">
        <div class="row">
            <div class="col-12 mt-3 text-center border-bottom">
                <h3>Đơn hàng</h3>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-12">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active position-relative" id="nav-processing-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-processing" type="button" role="tab" aria-controls="nav-processing"
                            aria-selected="true">Chờ xác nhận
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ $processingOrdersCount }}
                                <span class="visually-hidden">Tổng số đơn hàng chờ xác nhận</span>
                            </span>
                        </button>
                        <button class="nav-link position-relative" id="nav-proceed-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-proceed" type="button" role="tab" aria-controls="nav-proceed"
                            aria-selected="false">Đã xác nhận</button>
                        <button class="nav-link position-relative" id="nav-delivering-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-delivering" type="button" role="tab" aria-controls="nav-delivering"
                            aria-selected="false">Đang giao</button>
                        <button class="nav-link position-relative" id="nav-delivered-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-delivered" type="button" role="tab" aria-controls="nav-delivered"
                            aria-selected="false">Đã giao</button>
                        <button class="nav-link position-relative" id="nav-all-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-all" type="button" role="tab" aria-controls="nav-all"
                            aria-selected="false">Tất cả</button>
                    </div>
                </nav>

                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-processing" role="tabpanel"
                        aria-labelledby="nav-processing-tab">
                        <div class="container-fluid mt-2">
                            <form id="setProcessingOrderForm" method="post">
                                @csrf
                            </form>
                                @foreach ($processingOrders as $order)
                                    <div class="col-12" id="processing-{{ $order->order_id }}">
                                        <div class="card">
                                            <div class="card-body">
                                                <p>Ngày đặt hàng: {{ $order->order_date }}</p>
                                                <p>Tên khách hàng: {{ $order->name }}</p>
                                            </div>
                                            <div class="card-footer">
                                                <button data-order-id="{{ $order->order_id }}" data-bs-toggle="modal"
                                                    data-bs-target="#details_show" type="button"
                                                    class="btn btn-success show-ordered-product-btn">Danh sách mặt
                                                    hàng</button>
                                                <button data-order-id="{{ $order->order_id }}" type="button"
                                                    class="btn btn-primary btn-processing" type="submit">Xác nhận đơn
                                                    hàng</button>
                                                <button type="button" class="btn btn-danger">Hủy đơn hàng</button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            
                            <div class="w-100 text-center">
                                {!! $processingOrders->links() !!}
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-proceed" role="tabpanel" aria-labelledby="nav-proceed-tab">
                        <div class="container-fluid mt-2">
                            <form id="setProceedOrderForm" method="post">
                                @csrf
                            </form>
                                @foreach ($proceedOrders as $order)
                                    <div class="col-12" id="proceed-{{ $order->order_id }}">
                                        <div class="card">
                                            <div class="card-body">
                                                <p>Thời gian xác nhận: {{ $order->order_date }}</p>
                                                <p>Tên khách hàng: {{ $order->name }}</p>
                                            </div>
                                            <div class="card-footer">
                                                <button data-order-id="{{ $order->order_id }}" data-bs-toggle="modal"
                                                    data-bs-target="#details_show" type="button"
                                                    class="btn btn-success show-ordered-product-btn">Danh sách mặt
                                                    hàng</button>
                                                <button data-order-id="{{ $order->order_id }}" type="button"
                                                    class="btn btn-primary btn-proceed">Xác nhận giao hàng</button>
                                                <button type="button" class="btn btn-danger">Hủy đơn hàng</button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            
                            <div class="w-100 text-center">
                                {!! $proceedOrders->links() !!}
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-delivering" role="tabpanel" aria-labelledby="nav-delivering-tab">
                        <div class="container-fluid mt-2">
                            <form id="setDeliveringOrderForm" method="post">
                                @csrf
                            </form>
                                @foreach ($deliveringOrders as $order)
                                    <div class="col-12" id="delivering-{{ $order->order_id }}">
                                        <div class="card">
                                            <div class="card-body">
                                                <p>Thời gian giao: {{ $order->order_date }}</p>
                                                <p>Tên khách hàng: {{ $order->name }}</p>
                                            </div>
                                            <div class="card-footer">
                                                <button data-order-id="{{ $order->order_id }}" data-bs-toggle="modal"
                                                    data-bs-target="#details_show" type="button"
                                                    class="btn btn-success show-ordered-product-btn">Danh sách mặt
                                                    hàng</button>
                                                <button data-order-id="{{ $order->order_id }}" type="button"
                                                    class="btn btn-primary btn-delivering">Xác nhận nhận hàng</button>
                                                <button data-order-id="{{ $order->order_id }}" type="button"
                                                    class="btn btn-warning btn-return">Xác nhận trả hàng</button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            
                            <div class="w-100 text-center">
                                {!! $deliveringOrders->links() !!}
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-delivered" role="tabpanel" aria-labelledby="nav-delivered-tab">
                        <div class="container-fluid mt-2">
                            @foreach ($deliveredOrders as $order)
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <p>Thời gian nhận: {{ $order->order_date }}</p>
                                            <p>Tên khách hàng: {{ $order->name }}</p>
                                        </div>
                                        <div class="card-footer">
                                            <button data-order-id="{{ $order->order_id }}" data-bs-toggle="modal"
                                                data-bs-target="#details_show" type="button"
                                                class="btn btn-success show-ordered-product-btn">Danh sách mặt
                                                hàng</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="w-100 text-center">
                                {!! $deliveredOrders->links() !!}
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">
                        <div class="container-fluid mt-2">
                            @foreach ($allOrders as $order)
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <p>Ngày đặt hàng: {{ $order->order_date }}</p>
                                            <p>Tên khách hàng: {{ $order->name }}</p>
                                        </div>
                                        <div class="card-footer">
                                            <button data-order-id="{{ $order->order_id }}" data-bs-toggle="modal"
                                                data-bs-target="#details_show" type="button"
                                                class="btn btn-success show-ordered-product-btn">Danh sách mặt
                                                hàng</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="w-100 text-center">
                                {!! $allOrders->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="details_show" tabindex="-1" aria-labelledby="details_show_label" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Danh sách mặt hàng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid p-0 m-0">
                        <div class="row">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Hình ảnh</th>
                                        <th scope="col">Mã sản phẩm</th>
                                        <th scope="col">Giá</th>
                                        <th scope="col">Giảm giá</th>
                                        <th scope="col">Số lượng</th>
                                        <th scope="col">Tổng trả</th>
                                    </tr>
                                </thead>
                                <tbody id="details_show_body">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/admin/order_management/orderHandler.js') }}"></script>
@endsection
