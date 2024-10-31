@extends('templates.app')

@section('content')
<div class="container-fluid">

<div id="content">
            <div class="text-center">
                <h1>Xác thực CCCD</h1>
            </div>
            <div class="row mx-2">
                <div class="mx-auto border-end border-start" style="max-width: 1200px; min-height: 580px;">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-6">
                                <div class="mt-3 mb-3 border-bottom">
                                    <label for="input-file" class="form-label fw-bold">Tải ảnh</label>
                                </div>
                                <div class="mb-3">
                                    <input class="form-control mb-3" type="file" id="input-file" name="input" accept=".jpg, .jpeg, .png" >    
                                </div>
                                <div class="mb-3">
                                    <input class="btn btn-primary" type="button" id="submit" value="GỬI">
                                </div>
                                <div class="mb-3">
                                    <div id="uploaded-section" class="d-none">
                                        <p>Ảnh đã tải lên:</p>
                                        <img id="uploaded-img" width="200" height="200">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mt-3 mb-3 border-bottom">
                                    <label class="form-label fw-bold">Thông tin</label>
                                </div>
                                <div class="mb-3">
                                    <div id="loading" class="d-none">
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                        <p>Vui lòng chờ...</p>
                                    </div>
                                    <meta name="csrf-token" content="{{ csrf_token() }}">
                                    <div id="info">
                          
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<script src="{{ asset('/js/user/veritifyCitizen.js') }}"></script>
@endsection