@extends('templates.appAdmin')
@section('content')
    <title>Bài viết</title>
    <div class="container-fluid mt-3 border-top" id="post">
        <div class="row">
            <div class="col-12 mt-3 text-center border-bottom">
                <h3>Bài viết</h3>
            </div>
            <div class="col-12 mt-3">
                <button id="newPostBtn" class="btn btn-success" data-bs-target="#newPostModal" data-bs-toggle="modal">Viết bài
                    mới</button>
            </div>
            <div class="col-12 mt-3 border-top">
                <table class="w-100 table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">
                                ID
                            </th>
                            <th scope="col">
                                Title
                            </th>
                            <th scope="col">
                                Thumbnail
                            </th>
                            <th scope="col">
                                Thao tác
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td>
                                    {{ $post->id }}
                                </td>
                                <td>
                                    {{ $post->title }}
                                </td>
                                <td>
                                    <img src="/image/{{ $post->thumbnail }}" style="width: 50px; height: 80px">
                                </td>
                                <td>
                                    <button class="btn btn-primary edit-post-btn" data-bs-target="#editPostModal" data-bs-toggle="modal"
                                        data-post-id="{{ $post->id }}">Sửa</button>
                                    <button class="btn btn-danger delete-post-btn" data-bs-target="#deletePostModal" data-bs-toggle="modal"
                                        data-post-id="{{ $post->id }}">Xóa</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade hide" id="newPostModal" tabindex="-1" aria-labelledby="newPostModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <form method="post" action="{{ route('management_add_new_post') }}" id="newPostForm"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Bài viết mới</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid m-0 p-0">
                            <div class="row">
                                <div class="col-12 col-lg-6 mt-2">
                                    <label>Tiêu đề bài viết</label>
                                    <input class="form-control" name="title" required>
                                </div>
                                <div class="col-12 col-lg-6 mt-2">
                                    <label>Tags</label>
                                    <input class="form-control" name="tag" disabled>
                                </div>
                                <div class="col-12 mt-2">
                                    <label>Thumbnail</label>
                                    <div id="thumbnail_holder">

                                    </div>
                                </div>
                                <div class="col-12 mt-2">
                                    <label>Nội dung bài viết</label>
                                    <textarea id="content" name="content" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Đăng bài</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade hide" id="editPostModal" tabindex="-1" aria-labelledby="editPostModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <form method="post" action="{{ route('management_edit_post') }}" id="editPostForm"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Bài viết mới</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid m-0 p-0">
                            <div class="row">
                                <div class="col-12 col-lg-6 mt-2">
                                    <label>Mã bài viết</label>
                                    <input id="id" class="form-control" name="post_id" readonly>
                                </div>
                                <div class="col-12 col-lg-6 mt-2">
                                    
                                </div>
                                <div class="col-12 col-lg-6 mt-2">
                                    <label>Tiêu đề bài viết</label>
                                    <input id="title" class="form-control" name="title" required>
                                </div>
                                <div class="col-12 col-lg-6 mt-2">
                                    <label>Tags</label>
                                    <input id="tag" class="form-control" name="tag" disabled>
                                </div>
                                <div class="col-12 mt-2">
                                    <label>Thumbnail</label>
                                    <div id="edit_thumbnail_holder">

                                    </div>
                                </div>
                                <div class="col-12 mt-2">
                                    <label>Nội dung bài viết</label>
                                    <textarea id="edit_content" name="content" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Lưu</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade hide" id="deletePostModal" tabindex="-1" aria-labelledby="deletePostModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="post" action="{{ route('management_delete_post') }}" id="deletePostForm">
                    @csrf
                    <input class="d-none" id="post_id" name="post_id">
                    <div class="modal-header">
                        <h5 class="modal-title">Xác nhận xóa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid m-0 p-0">
                            Bạn có chắc muốn xóa bài viết này?
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="confirmDelete">Xóa</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('/js/admin/post_management/postHandler.js') }}"></script>
@endsection