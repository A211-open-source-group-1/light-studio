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
</head>

<style>

</style>
@php
    $totalPrice = 0;
@endphp
<body>
    <div style="width: 100%">
        <h3>Xin chào quý hành hàng {{ $name }}, hiện tại đơn hàng của bạn đã được xác nhận rồi nhé! Vui lòng chờ từ 15 - 30
            phút để nhân viên cửa hàng gọi điện xác nhận lại với bạn!</h3>
        <p>Chi tiết đơn hàng của bạn: </p>
        <table style="width: 100%">
            <tr>
                <td>
                    Mã sản phẩm
                </td>
                <td>
                    Tên sản phẩm
                </td>
                <td>
                    Giá
                </td>
                <td>
                    Số lượng
                </td>
                <td>
                    Thành tiền
                </td>
            </tr>
            @foreach ($valuesToMailBody as $row)
                <tr>
                    <td>
                        {{ $row->phone_details_id }}
                    </td>
                    <td>
                        {{ $row->phone_name . ' ' . $row->specific_name . ' ' . $row->color_name }}
                    </td>
                    <td>
                        {{ $row->price }} VNĐ
                    </td>
                    <td>
                        {{ $row->order_quantity }}
                    </td>
                    <td>
                        {{ $row->total_price }} VNĐ
                    </td>
                </tr>
                @php
                    $totalPrice += $row->total_price;
                @endphp
            @endforeach
            <tr>
                <td colspan="2">
                    Tổng thành tiền:
                </td>
                <td>
                    {{ $totalPrice }} VNĐ
                </td>
            </tr>
        </table>
        <h3>Một lần nữa, LIGHT-STUDIO rất cảm ơn bạn đã tin tưởng và chọn mua hàng tại cửa hàng. Kính chúng quý khách
            hàng nhiều sức khỏe và niềm vui!</h3>
    </div>
</body>

</html>
