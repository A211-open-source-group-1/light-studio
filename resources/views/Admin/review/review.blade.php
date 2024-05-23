@extends('templates.appAdmin')
@section('content')
    <title>Nhận xét sản phẩm</title>
    <div class="container-fluid mt-3 border-top" id="review">
        <div class="row">
            <div class="col-12 mt-3 text-center border-bottom">
                <h3>Nhận xét sản phẩm</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-3">
                <table class="table table-striped w-100">
                    <thead>
                        <th scope="col">
                            ID
                        </th>
                        <th>
                            ID Sản phẩm
                        </th>
                        <th scope="col">
                            ID Người dùng
                        </th>
                        <th scope="col">
                            Thời gian
                        </th>
                        <th scope="col">
                            Nội dung
                        </th>
                        <th scope="col">
                            Hành động
                        </th>
                    </thead>
                    <tbody>
                        @foreach ($reviews as $review)
                            <tr>
                                <td>
                                    {{ $review->review_id }}
                                </td>
                                <td>
                                    {{ $review->phone_details_id }}
                                </td>
                                <td>
                                    {{ $review->user_id }}
                                </td>
                                <td>
                                    {{ $review->time }}
                                </td>
                                <td>
                                    {{ $review->content }}
                                </td>
                                <td>
                                    <button class="btn btn-primary accept-review-btn" data-bs-target="#acceptReviewModal"
                                        data-bs-toggle="modal" data-review-id="{{ $review->review_id }}">ACCEPT</button>
                                    <button class="btn btn-danger decline-review-btn" data-bs-target="#declineReviewModal"
                                        data-bs-toggle="modal" data-review-id="{{ $review->review_id }}">DECLINE</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $reviews->links() !!}
            </div>
        </div>
    </div>

    <div class="modal fade hide" id="acceptReviewModal" tabindex="-1" aria-labelledby="acceptReviewModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="post" action="{{ route('management_accept_review') }}" id="acceptReviewForm">
                    @csrf
                    <input class="d-none" id="a_review_id" name="review_id">
                    <div class="modal-header">
                        <h5 class="modal-title">Xác nhận duyệt</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid m-0 p-0">
                            Chấp nhận review này?
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Đồng ý</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade hide" id="declineReviewModal" tabindex="-1" aria-labelledby="declineReviewModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="post" action="{{ route('management_decline_review') }}" id="declineReviewForm">
                    @csrf
                    <input class="d-none" id="review_id" name="review_id">
                    <div class="modal-header">
                        <h5 class="modal-title">Xác nhận xóa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid m-0 p-0">
                            Bạn có chắc muốn xóa review này?
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Xóa</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('/js/admin/review_management/reviewHandler.js') }}"></script>
@endsection
