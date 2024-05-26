@extends('templates.appAdmin')
<title>Nhập xuất hàng hóa</title>

@section('content')
    <div class="container-fluid mt-3 border-top " id="importProduct">
        <div class="row">
            <div class="col-12 mt-3 text-center border-bottom">
                <h3>Nhập & xuất hàng hóa</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-2">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addImportReceipt">Tạo phiếu
                    nhập</button>
            </div>
            <div class="col-12 mt-2">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">

                        <button class="nav-link active position-relative" id="nav-temp-import-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-temp-import" type="button" role="tab" aria-controls="nav-temp-import"
                            aria-selected="false">Phiếu nhập tạm</button>
                        <button class="nav-link position-relative" id="nav-import-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-import" type="button" role="tab" aria-controls="nav-import"
                            aria-selected="false">Phiếu nhập lưu</button>
                        <button class="nav-link position-relative" id="nav-total-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-total" type="button" role="tab" aria-controls="nav-total"
                            aria-selected="true">Tất cả
                        </button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-import-tab">
                    <div class="tab-pane fade show active" id="nav-temp-import" role="tabpanel"
                        aria-labelledby="nav-temp-import-tab">
                        <div class="container-fluid mt-2">
                            @foreach ($receiptsType1 as $receipt)
                                <div class="col-12" id="receipt-{{ $receipt->id }}">
                                    <div class="card">
                                        <div class="card-body">
                                            <p>Mã phiếu: {{ $receipt->id }}</p>
                                            <p>Thời gian: {{ $receipt->created_at }}</p>
                                            <p>Tên nhân viên nhập: {{ $receipt->name }}</p>
                                        </div>
                                        <div class="card-footer">
                                            <button data-receipt-id="{{ $receipt->id }}" type="button"
                                                class="btn btn-primary">Xác nhận</button>
                                                <a target="blank" href="/printImportReceiptPdf/{{ $receipt->id }}"
                                                    data-receipt-id="{{ $receipt->id }}" class="btn btn-warning">Xem chi
                                                    tiết & In phiếu</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-import" role="tabpanel" aria-labelledby="nav-import-tab">
                        <div class="container-fluid mt-2">
                            @foreach ($receiptsType2 as $receipt)
                                <div class="col-12" id="receipt-{{ $receipt->id }}">
                                    <div class="card">
                                        <div class="card-body">
                                            <p>Mã phiếu: {{ $receipt->id }}</p>
                                            <p>Thời gian: {{ $receipt->created_at }}</p>
                                            <p>Tên nhân viên nhập: {{ $receipt->name }}</p>
                                        </div>
                                        <div class="card-footer">
                                                <a target="blank" href="/printImportReceiptPdf/{{ $receipt->id }}"
                                                    data-receipt-id="{{ $receipt->id }}" class="btn btn-warning">Xem chi
                                                    tiết & In phiếu</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-total" role="tabpanel" aria-labelledby="nav-total-tab">
                        <div class="container-fluid mt-2">
                            @foreach ($receiptsType4 as $receipt)
                                <div class="col-12" id="receipt-{{ $receipt->id }}">
                                    <div class="card">
                                        <div class="card-body">
                                            <p>Mã phiếu: {{ $receipt->id }}</p>
                                            <p>Thời gian: {{ $receipt->created_at }}</p>
                                            <p>Tên nhân viên nhập: {{ $receipt->name }}</p>
                                        </div>
                                        <div class="card-footer">
                                            <a target="blank" href="/printImportReceiptPdf/{{ $receipt->id }}"
                                                data-receipt-id="{{ $receipt->id }}" class="btn btn-warning">Xem chi
                                                tiết & In phiếu</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addImportReceipt" tabindex="-1" aria-labelledby="addImportReceiptLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="/addImportReceiptSubmit" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addImportReceiptLabel">Tạo phiếu nhập</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-lg-6 mt-2">
                                    <label>Mã phiếu nhập</label>
                                    <input class="form-control" value="Mã tự động" disabled readonly>
                                </div>
                                <div class="col-12 col-lg-6 mt-2">
                                    <label>Nhà cung cấp</label>
                                    <input class="form-control" name="provider_name" required>
                                </div>
                                <div class="col-12 col-lg-6 mt-2">
                                    <label>Người liên hệ</label>
                                    <input class="form-control" name="contact_name" required>
                                </div>
                                <div class="col-12 col-lg-6 mt-2">
                                    <label>Số điện thoại</label>
                                    <input type="tel" class="form-control" name="phone_number" required>
                                </div>
                                <div class="col-12 mt-2">
                                    <label>Trạng thái phiếu nhập</label>
                                    <select id="status_select" class="form-select" name="receipt_status" required>
                                        <option value="temp">Phiếu nhập tạm</option>
                                        <option value="saved">Phiếu nhập lưu</option>
                                    </select>
                                </div>
                                <div class="col-12 mt-2">
                                    <div class="container-fluid m-0 p-0" id="adding-product-holder">
                                        <div class="row border p-1 mt-1" id="product-1">
                                            <div class="col-12 mt-2">
                                                <label>Sản phẩm</label>
                                                <select id="first_details_select" name="details_id[]" class="form-select"
                                                    required>
                                                </select>
                                            </div>
                                            <div class="col-12 col-lg-6 mt-2">
                                                <label>Số lượng</label>
                                                <input type="number" class="form-control" name="import_quantity[]"
                                                    value="1" min="1" required>
                                            </div>
                                            <div class="col-12 col-lg-6 mt-2">
                                                <label>Đơn vị tính</label>
                                                <input class="form-control" name="unit_name[]" required>
                                            </div>
                                            <div class="col-12 col-lg-6 mt-2">
                                                <label>Giá nhập (VNĐ)</label>
                                                <input class="form-control" name="price[]" value="0" min="0"
                                                    required type="number">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-2 text-end">
                                    <button id="new-product-btn" class="btn btn-success" type="button">Thêm sản
                                        phẩm</button>
                                </div>
                                <div class="col-12 mt-2">
                                    <div class="container-fluid m-0 p-0">
                                        <div class="row">
                                            <div class="col-12 col-lg-6 mt-2">
                                                <label>Trạng thái thanh toán: </label>
                                            </div>
                                            <div class="col-12 col-lg-6 mt-2">
                                                <input type="radio" name="payment_status" value="paid" checked>
                                                <label>Đã thanh
                                                    toán</label>
                                                <br>
                                                <input type="radio" name="payment_status" value="in_debt">
                                                <label>Nợ</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Tạo</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('/js/admin/import_management/importReceiptHandler.js') }}"></script>
@endsection
