@extends('templates.appAdmin')
@section('content')
    <div class="container-fluid mt-3 border-top">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0 text-gray-800">Đơn hàng</h1>
            <select class="form-control w-auto" id="orderStatus">
                <option value="delivered">Đã giao</option>
                <option value="pending">Chờ xác nhận</option>
            </select>
        </div>
    </div>

    <div class="container-fluid mt-2">
        <div class="row">
            @for ($i = 0; $i < 10; $i++)
                <div class="col-md-3 mb-4">
                    <div class="card" style="width: 100%;">
                        <img class="card-img-top" src="https://via.placeholder.com/150" alt="Card image cap">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                                the card's content.</p>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>

    <script>
        document.getElementById('orderStatus').addEventListener('change', function() {
            // Add functionality to filter orders based on selected status
            alert('Filter to: ' + this.value);
        });
    </script>
@endsection
