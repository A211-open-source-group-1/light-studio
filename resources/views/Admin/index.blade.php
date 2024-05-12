@extends('templates.appAdmin')
<title>Home</title>

@section('content')
    <div class="container-fluid mt-3 border-top " id="home">
        <div class="row">
            <div class="col-12 mt-3 text-center border-bottom">
                <h3>Trang chủ</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-2">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active position-relative" id="nav-1-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-1" type="button" role="tab" aria-controls="nav-1"
                            aria-selected="false">Thống kê doanh số</button>
                        <button class="nav-link position-relative" id="nav-2-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-2" type="button" role="tab" aria-controls="nav-2"
                            aria-selected="false">Thống kê khách hàng</button>
                        <button class="nav-link position-relative" id="nav-3-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-3" type="button" role="tab" aria-controls="nav-3"
                            aria-selected="true">Thống kê đơn hàng</button>
                        <button class="nav-link position-relative" id="nav-4-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-4" type="button" role="tab" aria-controls="nav-4"
                            aria-selected="true">Tỷ lệ trả hàng</button>
                        <button class="nav-link position-relative" id="nav-5-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-5" type="button" role="tab" aria-controls="nav-5"
                            aria-selected="true">Thống kê chi phí & công nợ</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-import-tab">
                    <div class="tab-pane fade show active" id="nav-1" role="tabpanel" aria-labelledby="nav-1-tab">
                        <div class="container-fluid mt-2">
                            <canvas id="chart1"></canvas>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-2" role="tabpanel" aria-labelledby="nav-2-tab">
                        <div class="container-fluid mt-2">
                            <canvas id="chart2"></canvas>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-3" role="tabpanel" aria-labelledby="nav-3-tab">
                        <div class="container-fluid mt-2">
                            <canvas id="chart3"></canvas>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-4" role="tabpanel" aria-labelledby="nav-4-tab">
                        <div class="container-fluid mt-2">
                            <canvas id="chart4"></canvas>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-5" role="tabpanel" aria-labelledby="nav-5-tab">
                        <div class="container-fluid mt-2">
                            <div class="row">
                                <div class="col-12">
                                    ĐANG HOÀN THIỆN DẦN!
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('/js/admin/chart_management/chartHandler.js')}}"></script>
@endsection
