@extends('templates.app')
@section('content')
    <div class="container-fluid p-0 m-0">
        <div class="row">
            <div class="col-0 col-lg-1 col-xl-1">
            </div>
            <div class="col-12 col-lg-10 col-xl-10" id="data-body">
                <form  id="formCart">
                    <h5 class="border-bottom mb-2 pb-2">Giỏ hàng của bạn</h5>
                    <div class="container-fluid mb-2">
                        <div class="row">
                            <div class="col-12 col-xl-8">
                                <div class="container-fluid p-0">
                                    <div class="row border-top">
                                        <?php
                                        $sumQuantity = 0;
                                        $sumMoney = 0;
                                        ?>
                                        <script src="{{ asset('/js/cartHandler.js') }}"></script>
                                        @foreach ($prodsInCart as $row)
                                            <div class="col-2 border-bottom d-flex align-items-center">

                                            <p class="mt-3"> <img class="w-75" src="{{ asset('/image/' . $row->GetImg()) }}">
                                                                                    </div>
                                            <div class="col-5 border-bottom d-flex align-items-center">
                                                <p class="mt-3">{{ $row->GetName() }}</p>
                                            </div>
                                            <div class="col-3 border-bottom d-flex align-items-center">
                                                <?php
                                                $currentQuantity = $row->GetQuantity();
                                                $sumQuantity = $sumQuantity + $currentQuantity;
                                                ?>
                                                <button class="btn btn-outline-light align-middle border-0"
                                                    onclick="DecreaseFromCart({{ $row->GetId() }})"><span
                                                        class="text-dark">-</span></button>
                                                <input type="number" class="form-control align-middle" min="0"
                                                    value="{{ $currentQuantity }}">
                                                <button class="btn btn-outline-light align-middle border-0"
                                                    onclick="IncreaseFromCart({{ $row->GetId() }})"><span
                                                        class="text-dark">+</span></button>
                                                <button class="btn btn-outline-light align-middle border-0"
                                                    onclick="DeleteFromCart({{ $row->GetId() }})"><span class="text-dark"><i
                                                            class="fa-solid fa-trash"></i></span></button>
                                            </div>
                                            <div class="col-2 border-bottom d-flex align-items-center">
                                                <?php
                                                $currentMoney = $row->GetFinalPrice();
                                                $sumMoney = $sumMoney + $currentMoney;
                                                ?>
                                                <p class="mt-3">{{ number_format($currentMoney, 0, ',', '.') }} VNĐ</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-xl-4 bg-little-dark p-0 m-0 rounded-end-3">
                                <div class="container-fluid text-light">
                                    <div class="row">
                                        <div class="col-12">
                                            <p class="lead m-0 p-0">Thanh toán</p>
                                        </div>
                                        <div class="col-12">
                                            <p>Tổng số lượng sản phẩm: {{ $sumQuantity }}</p>
                                            <p>Tổng tiền phải trả: {{ number_format($sumMoney, 0, ',', '.') }} VNĐ</p>
                                        </div>
                                        <div class="col-12">
                                            <p class="lead m-0 p-0 text-start">Phương thức thanh toán: </p>
                                            <input id="r1" type="radio" name="paymentMethod"
                                                class="form-check-input me-2" value="visa">
                                            <label for="r1"><span><i class="fa-brands fa-cc-visa"></i>
                                                </span>VISA</label>
                                            <br>
                                            <input id="r2" type="radio" name="paymentMethod"
                                                class="form-check-input me-2" value="cod">
                                            <label for="r2"><span><i class="fa-solid fa-truck"></i> </span>COD</label>
                                            <br>
                                            <input id="r4" type="radio" name="paymentMethod"
                                                class="form-check-input me-2" value="paypal">
                                            <label for="r4"><span><i class="fa-brands fa-cc-paypal"></i>
                                                </span>PayPal</label>
                                            <br>
                                            <input id="r3" type="radio" name="paymentMethod"
                                                class="form-check-input me-2" value="vnpay">
                                            <label for="r3"><span><i class="fa-solid fa-qrcode"></i> </span>VNPAY
                                                QR</label>
                                        </div>
                                        <div class="col-12 text-center">
                                            <input type="button" class="btn btn-light mb-2 mt-2"
                                             id="proccedOrder" value="TIẾN HÀNH THANH TOÁN" >
                                        </div>  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-0 col-lg-1 col-xl-1">
            </div>
        </div>
    </div>
@endsection
