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
        <h3>Xin chào quý khách hàng {{ $name }}, Hãy click vào đường link dưới đây để xác nhận Email của bạn và hoàn tất đăng ký!</h3>
        <div style="width: 100%" align="center">
            <a href="light-studio.test/user_verify/{{$token}}"><span style="font-size: 20px">ẤN VÀO ĐƯỜNG LINK NÀY</span></a>
        </div>
        <h3>LIGHT-STUDIO rất cảm ơn bạn vì trở thành một khách hàng của cửa hàng chúng tôi. Kính chúng quý khách
            hàng nhiều sức khỏe và niềm vui!</h3>
    </div>
</body>

</html>
