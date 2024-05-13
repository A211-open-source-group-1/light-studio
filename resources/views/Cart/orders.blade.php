@extends('templates.app')
@section('content')
    <title>Đơn hàng</title>
    <div class="container-fluid mt-3 border-top" id="orderedCart">
        <div class="row">
            <div class="col-12 mt-3 text-center border-bottom">
                <h3>Đơn hàng của bạn</h3>
            </div>
        </div>
        <div class="row mt-1 mb-3">
            <div class="col-3">

            </div>
            <div class="col-6">
                <div class="container-fluid mt-2">
                    @foreach ($allOrders as $order)
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <p>Ngày đặt hàng: {{ $order->order_date }}</p>
                                    <p>Tên khách hàng: {{ $order->name }}</p>
                                    <p>Trạng thái: {{ $order->status_name }}</p>
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
            <div class="col-3">

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
