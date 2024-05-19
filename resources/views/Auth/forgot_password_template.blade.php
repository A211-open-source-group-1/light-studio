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
<body>
    <div style="width: 100%">
        <h3>Xin chào quý khách hàng {{ $name }}, Hãy click vào đường link dưới đây để tiến hành reset mật khẩu!</h3>
        <div style="width: 100%" align="center">
            <a href="light-studio.test/user_reset_password/{{$token}}"><span style="font-size: 20px">ẤN VÀO ĐƯỜNG LINK NÀY</span></a>
        </div>
    </div>
</body>

</html>
