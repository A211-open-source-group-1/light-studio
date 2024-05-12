<!DOCTYPE html>
<html lang="en">
<style>
    * {
        font-family: DejaVu Sans !important;
    }

    p {
        font-size: 14px;
        padding: 0;
        margin: 0;
    }

    h4 {
        padding: 0;
        margin: 0;
    }

    table {
        border-collapse: collapse;
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHIẾU NHẬP HÀNG</title>
</head>

<style>

</style>

<body>
    <div style="display: inline-block">
        <div style="width: 200px; float: left">
            <img src="{{ asset('/image/logo-banner.png') }}" style="width: 100%; margin-top: 30px">
        </div>
        <div style="width: 460px; margin-left: 230px; float: right">
            <h4>CÔNG TY TNHH LIGHT-STUDIO</h4>
            <p><span style="font-weight: bold">Địa chỉ</span>: 36/13 Đường 160, Phường Tăng Nhơn Phú A, TP. Thủ Đức, TP.
                Hồ Chí Minh</p>
            <p><span style="font-weight: bold">Website</span>: Đang làm nè :D
            <p>
            <p><span style="font-weight: bold">Mã số thuế</span>: 123456789
            <p>
            <p><span style="font-weight: bold">Số tài khoản</span>: (Techcombank) 123456789
            <p>
        </div>
    </div>
    <div style="margin-top: 10px; padding: 10px">
        <div style="margin-left: 12cm">
            <p>Mã phiếu nhập: {{ $receipt->id }}</p>
            <p>Trạng thái phiếu: 
                @if ($receipt->receipt_status == 'temp')
                Phiếu tạm
                @elseif ($receipt->receipt_status == 'saved')
                Phiếu lưu
                @else
                Hoàn thành
                @endif
            </p>
            <p>
                Thanh toán: 
                @if ($receipt->payment_status == 'paid')
                Trả trước
                @else
                Nợ
                @endif
            </p>
        </div>
    </div>
    <div style="margin-top: 5px">
        <div align="center" style="margin-top: 0">
            <h1 style="margin-bottom: 10px; margin-top: 0">PHIẾU NHẬP KHO</h1>
            <p>Ngày {{ $day }} tháng {{ $month }} năm 20{{ $year }}</p>
        </div>
        <div style="padding: 10px;">
            @php
                $index = 1;
                $totalPrice = 0;
            @endphp

            <p>Đơn vị giao: {{ $receipt->provider_name }}</p>
            <p>Nhập tại kho: Tổng kho công ty TNHH Light-Studio</p>
            <table border="1px" style="margin-top: 10px">
                <thead>
                    <tr>
                        <th scope="col">
                            <p>STT</p>
                        </th>
                        <th scope="col">
                            <p>
                                Tên, nhãn hiệu, quy cách, phẩm chất vật tư, dụng cụ sản phẩm, hàng hóa
                            </p>
                        </th>
                        <th scope="col">
                            <p>Mã sản phẩm</p>
                        </th>
                        <th scope="col">
                            <p>Số lượng</p>
                        </th>
                        <th scope="col">
                            <p>Đơn vị</p>
                        </th>
                        <th scope="col">
                            <p>Đơn giá</p>
                        </th>
                        <th scope="col">
                            <p>Thành tiền</p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($details as $detail)
                        <tr>
                            <td align="center">
                                <p>{{ $index++ }}</p>
                            </td>
                            <td>
                                <p>{{ $detail->phone_name . ' ' . $detail->specific_name . ' ' . $detail->color_name }}
                                </p>
                            </td>
                            <td align="center">
                                <p>{{ $detail->phone_details_id }}</p>
                            </td>
                            <td align="center">
                                <p>{{ $detail->import_quantity }}</p>
                            </td>
                            <td align="center">
                                <p>{{ $detail->unit_name }}</p>
                            </td>
                            <td align="center">
                                <p>{{ $detail->import_price }} VNĐ</p>
                            </td>
                            <td align="center">
                                <p>{{ $detail->import_quantity * $detail->import_price }} VNĐ</p>
                                @php
                                    $totalPrice = $totalPrice + $detail->import_quantity * $detail->import_price;
                                @endphp
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="6" align="left">
                            <p>Tổng:</p>
                        </td>
                        <td align="center">
                            <p>{{$totalPrice}} VNĐ</p>
                        </td>
                    </tr>
                </tbody>
            </table>
            <p style="margin-top: 10px">Số chứng từ gốc kèm theo:
                ..................................................................................</p>
        </div>
        <div style="width: 660px">
            <table width="100%">
                <tr>
                    <td colspan="4" align="right">
                        <p>Ngày {{ $day }} tháng {{ $month }} năm 20{{ $year }}</p>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <p style="font-weight: bold">Người lập phiếu</p>
                        <p style="font-style: italic">(Ký, họ tên)</p>
                        
                    </td>
                    <td align="center">
                        <p style="font-weight: bold">Người giao hàng</p>
                        <p style="font-style: italic">(Ký, họ tên)</p>
                    </td>
                    <td align="center">
                        <p style="font-weight: bold">Thủ kho</p>
                        <p style="font-style: italic">(Ký, họ tên)</p>
                    </td>
                    <td align="center">
                        <p style="font-weight: bold">Kế toán trưởng</p>
                        <p style="font-style: italic">(Ký, họ tên)</p>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <p>{{$receipt->name}}</p>
                    </td>
                    <td>

                    </td>
                    <td>

                    </td>
                    <td>

                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>
