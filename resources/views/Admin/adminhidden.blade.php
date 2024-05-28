<script src="{{ asset('/js/admin/employee_management/employeeHandle.js') }}"></script>
<script src="{{ asset('/js/admin/userhandle.js') }}"></script>

@if (session('auth'))
    <script>
        alert("{{ session('auth') }}");
    </script>
@endif

<div class="modal fade" id="logoutAdmin" tabindex="-1" aria-labelledby="logoutAdminLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('logoutAdmin') }}" method="get">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteUserLabel">Thông báo</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="deleteUserId" name="deleteUserId">
                    <p>Bạn có chắc chắn muốn đăng xuất?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-danger">Đăng xuất</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="deleteUser" tabindex="-1" aria-labelledby="deleteUserLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('deleteUser') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteUserLabel">Xóa người dùng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="deleteUserId" name="deleteUserId">
                    <p>Bạn có chắc chắn muốn xóa người dùng này?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editUser" tabindex="-1" aria-labelledby="editUser" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('editUser') }}" method="post">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h5 class="modal-title" id="EditUserLabel">Thông tin khách hàng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col">
                        <div class="form">
                            <div class="form-group">
                                <label>ID tài khoản</label>
                                <input id="id" name="id" class="form-control" readonly />
                            </div>
                            <div class="form-group">
                                <label>Họ và tên</label>
                                <input id="fullname" name="fullname" class="form-control" type="text" required />
                            </div>
                            <div class="form-group">
                                <label>Giới tính</label>
                                <select id="gender" name="gender" class="form-control">
                                    <option value="Nam">Nam</option>
                                    <option value="Nữ">Nữ</option>
                                </select>

                            </div>
                            <div class="form-group">
                                <label>Địa chỉ</label>
                                <input id="user_address" name="address" class="form-control" type="text" />
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại</label>
                                <input id="phonenumber" name="phonenumber" class="form-control" type="tel" readonly
                                    required minlength="10" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input id="email" name="email" class="form-control" type="email" required />
                            </div>
                            <div class="form-group">
                                <label>Điểm tích lũy</label>
                                <input id="user_point" name="text" class="form-control" type="text" readonly />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">Sửa</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editPhone" tabindex="-1" aria-labelledby="editPhone" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="{{ route('editPhoneSubmit') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Chỉnh sửa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="container-fluid m-0 p-0">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="phone_id">Mã</label>
                                                <input type="text" id="phone_id" name="phone_id"
                                                    class="form-control disabled" readonly>
                                            </div>
                                        </div>
                                        <div class="col-9">
                                            <div class="form-group">
                                                <label for="phone_name">Tên điện thoại</label>
                                                <input type="text" id="phone_name" class="form-control"
                                                    name="phone_name">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="brand_name">Hãng</label>
                                                <select class="form-control" id="brand_name" name="brand_id">

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="category_name">Loại</label>
                                                <select class="form-control" id="category_name" name="category_id">

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="os_name">Hệ điều hành</label>
                                                <select class="form-control" id="os_name" name="os_id">

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <div class="form-group">
                                                <label for="youtube_url">Youtube URL</label>
                                                <input type="text" id="youtube_url" class="form-control"
                                                    name="youtube_url">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <label for="description" class="mt-3">Mô tả</label>
                                <textarea id="description" name="description">

                                </textarea>
                                <script>
                                    $(document).ready(function() {
                                        $('#description').summernote({
                                            placeholder: 'Type here...',
                                            tabsize: 2,
                                            height: 350,
                                            toolbar: [
                                                // [groupName, [list of button]]
                                                ['style', ['bold', 'italic', 'underline', 'clear']],
                                                ['font', ['strikethrough', 'superscript', 'subscript']],
                                                ['fontsize', ['fontsize']],
                                                ['color', ['color']],
                                                ['para', ['ul', 'ol', 'paragraph']],
                                                ['height', ['height']]
                                            ]
                                        });
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                    <script>
                        $(document).ready(function() {
                            $('.summernote').summernote();
                            var noteBar = $('.note-toolbar');
                            noteBar.find('[data-toggle]').each(function() {
                                $(this).attr('data-bs-toggle', $(this).attr('data-toggle')).removeAttr('data-toggle');
                            });
                        });
                    </script>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Lưu</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="addPhone" tabindex="-1" aria-labelledby="addPhone" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="{{ route('addPhoneSubmit') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Chỉnh sửa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="container-fluid m-0 p-0" id="addPhoneHolder">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="phone_id">Mã</label>
                                                <input type="text" id="phone_id" name="phone_id"
                                                    class="form-control disabled" readonly disabled>
                                            </div>
                                        </div>
                                        <div class="col-9">
                                            <label for="phone_name">Tên điện thoại</label>
                                            <input type="text" id="phone_name" class="form-control"
                                                name="phone_name">
                                        </div>
                                        <div class="col-12 col-lg-6 col-xl-3">
                                            <label for="new_brand_name">Hãng</label>
                                            <select id="new_brand_name" class="form-select" name="brand_id">

                                            </select>
                                        </div>
                                        <div class="col-12 col-lg-6 col-xl-3">
                                            <label for="new_category_name">Loại</label>
                                            <select id="new_category_name" class="form-select" name="category_id">

                                            </select>
                                        </div>
                                        <div class="col-12 col-lg-6 col-xl-3">
                                            <label for="new_os_name">Hệ điều hành</label>
                                            <select id="new_os_name" class="form-select" name="os_id">

                                            </select>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <div class="form-group">
                                                <label for="new_youtube_url">Youtube URL</label>
                                                <input type="text" id="new_youtube_url" class="form-control"
                                                    name="youtube_url">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <label for="new_description" class="mt-3">Mô tả</label>
                                <textarea id="new_description" name="description">

                                </textarea>
                                <script>
                                    $(document).ready(function() {
                                        $('#new_description').summernote({
                                            placeholder: 'Type here...',
                                            tabsize: 2,
                                            height: 350,
                                            toolbar: [
                                                // [groupName, [list of button]]
                                                ['style', ['bold', 'italic', 'underline', 'clear']],
                                                ['font', ['strikethrough', 'superscript', 'subscript']],
                                                ['fontsize', ['fontsize']],
                                                ['color', ['color']],
                                                ['para', ['ul', 'ol', 'paragraph']],
                                                ['height', ['height']]
                                            ]
                                        });
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                    <script>
                        $(document).ready(function() {
                            $('.summernote').summernote();
                            var noteBar = $('.note-toolbar');
                            noteBar.find('[data-toggle]').each(function() {
                                $(this).attr('data-bs-toggle', $(this).attr('data-toggle')).removeAttr('data-toggle');
                            });
                        });
                    </script>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Thêm</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editPhoneColor" tabindex="-1" aria-labelledby="editPhoneColor" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Chỉnh sửa màu sắc sản phẩm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <label for="ec_phone_id">Mã điện thoại</label>
                            <input readonly id="ec_phone_id" class="form-control" type="text">
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="ec_phone_name">Tên sản phẩm</label>
                            <input readonly id="ec_phone_name" class="form-control" type="text">
                        </div>
                    </div>
                    <form id="edit-color-form" method="POST" class="form border-0 d-none"
                        action="{{ route('editSelectedColorSubmit') }}">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <label for="ec_color_id">Mã màu</label>
                                <input readonly id="ec_color_id" name="current_color_id" class="form-control"
                                    type="text">
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="ec_color_name">Tên màu</label>
                                <input id="ec_color_name" name="current_color_name" class="form-control"
                                    type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">

                            </div>
                            <div class="col-4 text-end">
                                <button id="submit-edit-color-form-btn" class="btn btn-success"
                                    type="submit">Lưu</button>
                                <button id="close-edit-color-form-btn" class="btn btn-dark"
                                    type="button">Hủy</button>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <div id="color_edit_notification"
                                    class="alert alert-success alert-dismissible fade d-none" role="alert">

                                </div>
                                <div id="color_edit_notification_failed"
                                    class="alert alert-warning alert-dismissible fade d-none" role="alert">

                                </div>
                            </div>
                        </div>
                    </form>
                    <button id="add-color-form-btn" class="btn btn-success">Thêm</button>
                    <form id="add-color-form" method="POST" class="form border-0 d-none"
                        action="{{ route('addColorSubmit') }}">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <label for="new_color_id">Tên màu</label>
                                <input id="new_color_id" name="new_color_name" class="form-control" type="text"
                                    required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">

                            </div>
                            <div class="col-4 text-end">
                                <button id="submit-add-color-form-btn" class="btn btn-success"
                                    type="submit">Thêm</button>
                                <button id="close-add-color-form-btn" class="btn btn-dark"
                                    type="button">Hủy</button>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <div id="add_notification" class="alert alert-success alert-dismissible fade d-none"
                                    role="alert">

                                </div>
                                <div id="add_notification_failed"
                                    class="alert alert-warning alert-dismissible fade d-none" role="alert">

                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-12">
                            <div id="delete_notification" class="alert alert-success alert-dismissible fade d-none"
                                role="alert">

                            </div>
                            <div id="delete_notification_failed"
                                class="alert alert-warning alert-dismissible fade d-none" role="alert">

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="container-fluid m-0 p-0">
                                <table class="table table-light">
                                    <thead>
                                        <tr>
                                            <th scope="col">Mã màu</th>
                                            <th scope="col">Tên màu</th>
                                            <th scope="col">Số lượng SP con</th>
                                            <th scope="col">Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody id="color-board">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                {{-- <button type="submit" class="btn btn-success">Lưu</button> --}}
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editPhoneSpecifics" tabindex="-1" aria-labelledby="editPhoneSpecifics"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Chỉnh sửa phiên bản sản phẩm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <label for="es_phone_id">Mã điện thoại</label>
                            <input readonly id="es_phone_id" class="form-control" type="text">
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="es_phone_name">Tên sản phẩm</label>
                            <input readonly id="es_phone_name" class="form-control" type="text">
                        </div>
                    </div>
                    <form id="edit-specs-form" method="POST" class="form border-0 d-none"
                        action="{{ route('editSelectedSpecificSubmit') }}">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <label for="es_specs_id">Mã phiên bản</label>
                                <input readonly id="es_specs_id" name="current_specs_id" class="form-control"
                                    type="text">
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="es_specs_name">Tên phiên bản</label>
                                <input id="es_specs_name" name="current_specs_name" class="form-control"
                                    type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">

                            </div>
                            <div class="col-4 text-end">
                                <button id="submit-edit-specs-form-btn" class="btn btn-success"
                                    type="submit">Lưu</button>
                                <button id="close-edit-specs-form-btn" class="btn btn-dark"
                                    type="button">Hủy</button>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <div id="specs_edit_notification"
                                    class="alert alert-success alert-dismissible fade d-none" role="alert">

                                </div>
                                <div id="specs_edit_notification_failed"
                                    class="alert alert-warning alert-dismissible fade d-none" role="alert">

                                </div>
                            </div>
                        </div>
                    </form>
                    <button id="add-specs-form-btn" class="btn btn-success">Thêm</button>
                    <form id="add-specs-form" method="POST" class="form border-0 d-none"
                        action="{{ route('addSpecificSubmit') }}">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <label for="new_specs_name">Tên phiên bản</label>
                                <input id="new_specs_name" name="new_specs_name" class="form-control" type="text"
                                    required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">

                            </div>
                            <div class="col-4 text-end">
                                <button id="submit-add-specs-form-btn" class="btn btn-success"
                                    type="submit">Thêm</button>
                                <button id="close-add-specs-form-btn" class="btn btn-dark"
                                    type="button">Hủy</button>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <div id="specs_add_notification"
                                    class="alert alert-success alert-dismissible fade d-none" role="alert">

                                </div>
                                <div id="specs_add_notification_failed"
                                    class="alert alert-warning alert-dismissible fade d-none" role="alert">

                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row mt-3">
                        <div class="col-12">
                            <div id="specs_delete_notification"
                                class="alert alert-success alert-dismissible fade d-none" role="alert">

                            </div>
                            <div id="specs_delete_notification_failed"
                                class="alert alert-warning alert-dismissible fade d-none" role="alert">

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="container-fluid m-0 p-0">
                                <table class="table table-light">
                                    <thead>
                                        <tr>
                                            <th scope="col">Mã phiên bản</th>
                                            <th scope="col">Tên phiên bản</th>
                                            <th scope="col">Số lượng SP con</th>
                                            <th scope="col">Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody id="specs-board">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                {{-- <button type="submit" class="btn btn-success">Lưu</button> --}}
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editDetails" tabindex="-1" aria-labelledby="editDetails" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Chỉnh sửa sản phẩm con</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <label for="ed_phone_id">Mã điện thoại</label>
                            <input readonly disabled id="ed_phone_id" class="form-control" type="text">
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="ed_phone_name">Tên điện thoại</label>
                            <input readonly disabled id="ed_phone_name" class="form-control" type="text">
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <div id="details_delete_notification"
                                    class="alert alert-success alert-dismissible fade d-none" role="alert">

                                </div>
                                <div id="details_delete_notification_failed"
                                    class="alert alert-warning alert-dismissible fade d-none" role="alert">

                                </div>
                            </div>
                        </div>
                    </div>
                    <form id="edit-selected-details-form" method="POST" action="/editSelectedDetailsSubmit"
                        class="form border-0 d-none" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <label for="ed_details_id">Mã sản phẩm</label>
                                <input id="ed_details_id" class="form-control" type="text" name="details_id"
                                    readonly>
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="ed_color_select" class="mb-3">Màu sản phẩm</label>
                                <select id="ed_color_select" class="form-select" name="color_id">
                                    <option value="1">vcl</option>
                                    <option value="2">vcl</option>
                                    <option value="3">dcm</option>
                                </select>
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="ed_specs_select" class="mb-3">Phiên bản sản phẩm</label>
                                <select id="ed_specs_select" class="form-select" name="specs_id">
                                    <option value="1">vcl</option>
                                    <option value="2">vcl</option>
                                    <option value="3">dcm</option>
                                </select>
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="ed_details_screen">Màn hình</label>
                                <input id="ed_details_screen" class="form-control" type="text" name="screen">
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="ed_details_ram">Dung lượng RAM</label>
                                <input id="ed_details_ram" class="form-control" type="text" name="ram">
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="ed_details_rom">Dung lượng bộ nhớ trong</label>
                                <input id="ed_details_rom" class="form-control" type="text" name="rom">
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="ed_details_cpu">CPU</label>
                                <input id="ed_details_cpu" class="form-control" type="text" name="cpu">
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="ed_details_frontcam">Camera trước</label>
                                <input id="ed_details_frontcam" class="form-control" type="text"
                                    name="front_cam">
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="ed_details_rearcam">Camera sau</label>
                                <input id="ed_details_rearcam" class="form-control" type="text" name="rear_cam">
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="ed_details_bluetoothver">Bluetooth</label>
                                <input id="ed_details_bluetoothver" class="form-control" type="text"
                                    name="bluetooth_ver">
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="ed_details_wifiver">WiFi</label>
                                <input id="ed_details_wifiver" class="form-control" type="text" name="wifi_ver">
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="ed_details_nfc">NFC</label>
                                <input id="ed_details_nfc" class="form-control" type="text" name="nfc">
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="ed_details_price">Giá (VNĐ)</label>
                                <input id="ed_details_price" class="form-control" type="number" name="price">
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="ed_details_discount">Giảm giá (VNĐ)</label>
                                <input id="ed_details_discount" class="form-control" type="number" name="discount">
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="ed_details_quantity">Số lượng</label>
                                <input id="ed_details_quantity" class="form-control" type="number" name="quantity">
                            </div>
                            <div class="col-12 mt-3">
                                <label>Hình ảnh Thumbnail</label>
                                <div class="container-fluid">
                                    <div id="thumbnail_holder" class="row">

                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <label>Hình ảnh sản phẩm</label>
                                <div class="container-fluid">
                                    <div id="img_holder" class="row">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">

                            </div>
                            <div class="col-4 text-end">
                                <button id="submit-edit-details-form-btn" class="btn btn-success"
                                    type="submit">Lưu</button>
                                <button id="close-edit-details-form-btn" class="btn btn-dark"
                                    type="button">Hủy</button>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <div id="details_edit_notification"
                                    class="alert alert-success alert-dismissible fade d-none" role="alert">

                                </div>
                                <div id="details_edit_notification_failed"
                                    class="alert alert-warning alert-dismissible fade d-none" role="alert">

                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- Add Details Form Section -->
                    <form id="add-details-form" method="POST" action="/addPhoneDetailsSubmit"
                        class="form border-0 d-none" enctype="multipart/form-data">
                        @csrf
                        <input id="new_phone_id" class="d-none" name="phone_id">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <label for="new_details_id">Mã sản phẩm</label>
                                <input id="new_details_id" class="form-control" type="text" name="details_id"
                                    readonly disabled>
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="new_color_select" class="mb-3">Màu sản phẩm</label>
                                <select id="new_color_select" class="form-select" name="color_id">
                                    <option value="1">vcl</option>
                                    <option value="2">vcl</option>
                                    <option value="3">dcm</option>
                                </select>
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="new_specs_select" class="mb-3">Phiên bản sản phẩm</label>
                                <select id="new_specs_select" class="form-select" name="specs_id">
                                    <option value="1">vcl</option>
                                    <option value="2">vcl</option>
                                    <option value="3">dcm</option>
                                </select>
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="new_details_screen">Màn hình</label>
                                <input id="new_details_screen" class="form-control" type="text" name="screen">
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="new_details_ram">Dung lượng RAM</label>
                                <input id="new_details_ram" class="form-control" type="text" name="ram">
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="new_details_rom">Dung lượng bộ nhớ trong</label>
                                <input id="new_details_rom" class="form-control" type="text" name="rom">
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="new_details_cpu">CPU</label>
                                <input id="new_details_cpu" class="form-control" type="text" name="cpu">
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="new_details_frontcam">Camera trước</label>
                                <input id="new_details_frontcam" class="form-control" type="text"
                                    name="front_cam">
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="new_details_frontcam">Camera sau</label>
                                <input id="new_details_frontcam" class="form-control" type="text"
                                    name="rear_cam">
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="new_details_bluetoothver">Bluetooth</label>
                                <input id="new_details_bluetoothver" class="form-control" type="text"
                                    name="bluetooth_ver">
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="new_details_wifiver">WiFi</label>
                                <input id="new_details_wifiver" class="form-control" type="text" name="wifi_ver">
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="new_details_nfc">NFC</label>
                                <input id="new_details_nfc" class="form-control" type="text" name="nfc">
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="new_details_price">Giá (VNĐ)</label>
                                <input id="new_details_price" class="form-control" type="number" name="price">
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="new_details_discount">Giảm giá (VNĐ)</label>
                                <input id="new_details_discount" class="form-control" type="number"
                                    name="discount">
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="new_details_quantity">Số lượng</label>
                                <input id="new_details_quantity" class="form-control" type="number"
                                    name="quantity">
                            </div>
                            <div class="col-12 mt-3">
                                <label>Hình ảnh Thumbnail</label>
                                <div class="container-fluid">
                                    <div id="new_thumbnail_holder" class="row">

                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <label>Hình ảnh sản phẩm</label>
                                <div class="container-fluid">
                                    <div id="new_img_holder" class="row">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-8">

                            </div>
                            <div class="col-4 text-end">
                                <button id="submit-add-details-form-btn" class="btn btn-success"
                                    type="submit">Thêm</button>
                                <button id="close-add-details-form-btn" class="btn btn-dark"
                                    type="button">Hủy</button>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <div id="details_add_notification"
                                    class="alert alert-success alert-dismissible fade d-none" role="alert">

                                </div>
                                <div id="details_add_notification_failed"
                                    class="alert alert-warning alert-dismissible fade d-none" role="alert">

                                </div>
                            </div>
                        </div>
                    </form>
                    </form>
                    <form id="add-details-form-based-on-color" method="POST" action="/addDetailsByCurrentColor"
                        class="form border-0 d-none" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <input id="bo_phone_id" class="d-none" name="phone_id">
                            <div class="col-12 col-lg-6">
                                <label for="bo_new_details_id">Mã sản phẩm</label>
                                <input id="bo_new_details_id" class="form-control" type="text" name="details_id"
                                    readonly disabled>
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="bo_new_color_select" class="mb-3">CHỌN SẢN PHẨM DỰA THEO</label>
                                <select id="bo_new_color_select" class="form-select" name="based_on_details_id">
                                    <option value="1">vcl</option>
                                    <option value="2">vcl</option>
                                    <option value="3">dcm</option>
                                </select>
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="bo_new_specs_select" class="mb-3">Phiên bản sản phẩm</label>
                                <select id="bo_new_specs_select" class="form-select" name="specs_id">
                                    <option value="1">vcl</option>
                                    <option value="2">vcl</option>
                                    <option value="3">dcm</option>
                                </select>
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="bo_new_details_screen">Màn hình</label>
                                <input id="bo_new_details_screen" class="form-control" type="text"
                                    name="screen">
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="bo_new_details_ram">Dung lượng RAM</label>
                                <input id="bo_new_details_ram" class="form-control" type="text" name="ram">
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="bo_new_details_rom">Dung lượng bộ nhớ trong</label>
                                <input id="bo_new_details_rom" class="form-control" type="text" name="rom"
                                    required>
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="bo_new_details_cpu">CPU</label>
                                <input id="bo_new_details_cpu" class="form-control" type="text" name="cpu"
                                    required>
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="bo_new_details_frontcam">Camera trước</label>
                                <input id="bo_new_details_frontcam" class="form-control" type="text"
                                    name="front_cam" required>
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="bo_new_details_frontcam">Camera sau</label>
                                <input id="bo_new_details_frontcam" class="form-control" type="text"
                                    name="rear_cam" required>
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="bo_new_details_bluetoothver">Bluetooth</label>
                                <input id="bo_new_details_bluetoothver" class="form-control" type="text"
                                    name="bluetooth_ver" required>
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="bo_new_details_wifiver">WiFi</label>
                                <input id="bo_new_details_wifiver" class="form-control" type="text"
                                    name="wifi_ver" required>
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="bo_new_details_nfc">NFC</label>
                                <input id="bo_new_details_nfc" class="form-control" type="text" name="nfc"
                                    required>
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="bo_new_details_price">Giá (VNĐ)</label>
                                <input id="bo_new_details_price" class="form-control" type="number" name="price"
                                    required min="0">
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="bo_new_details_discount">Giảm giá (VNĐ)</label>
                                <input id="bo_new_details_discount" class="form-control" type="number"
                                    value="0" name="discount" required min="0">
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="bo_new_details_quantity">Số lượng</label>
                                <input id="bo_new_details_quantity" class="form-control" type="number"
                                    name="quantity" required min="0">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-8">

                            </div>
                            <div class="col-4 text-end">
                                <button id="submit-add-bo-details-form-btn" class="btn btn-success"
                                    type="submit">Thêm</button>
                                <button id="close-add-bo-details-form-btn" class="btn btn-dark"
                                    type="button">Hủy</button>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <div id="details_bo_add_notification"
                                    class="alert alert-success alert-dismissible fade d-none" role="alert">

                                </div>
                                <div id="details_bo_add_notification_failed"
                                    class="alert alert-warning alert-dismissible fade d-none" role="alert">

                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-12">
                            <button id="add-details-form-btn" class="btn btn-success">Thêm</button>
                            <button id="add-bo-details-form-btn" class="btn btn-secondary no-wrap">Thêm dựa trên màu
                                đã có</button>
                            <div class="container-fluid m-0 p-0">
                                <table class="table table-light">
                                    <thead>
                                        <tr>
                                            <th scope="col">Hình ảnh</th>
                                            <th scope="col">Mã sản phẩm</th>
                                            <th scope="col">Điện thoại</th>
                                            <th scope="col">Phiên bản</th>
                                            <th scope="col">Màu sắc</th>
                                            <th scope="col">Giá</th>
                                            <th scope="col">Giảm giá</th>
                                            <th scope="col">Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody id="details-board">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                {{-- <button type="submit" class="btn btn-success">Lưu</button> --}}
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button>
            </div>
        </div>
    </div>
</div>

<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div class="toast bg-toast-alert" id="toastSetFailed">
        <div class="toast-header">
            <strong class="me-auto">Thông báo</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
        </div>
        <div class="toast-body">
            <p>Có lỗi!</p>
        </div>
    </div>
</div>

<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div class="toast bg-toast-success" id="toastSetSucceed">
        <div class="toast-header">
            <strong class="me-auto">Thông báo</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
        </div>
        <div class="toast-body">
            <p>Cập nhật trạng thái đơn hàng thành công!</p>
        </div>
    </div>
</div>

<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div class="toast bg-toast-success" id="toastCancelSucceed">
        <div class="toast-header">
            <strong class="me-auto">Thông báo</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
        </div>
        <div class="toast-body">
            <p>Hủy đơn hàng thành công!</p>
        </div>
    </div>
</div>

<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div class="toast bg-toast-success" id="toastReturnSucceed">
        <div class="toast-header">
            <strong class="me-auto">Thông báo</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
        </div>
        <div class="toast-body">
            <p>Xác nhận trả hàng thành công!</p>
        </div>
    </div>
</div>


<div class="modal fade" id="editEmployee" tabindex="-1" aria-labelledby="editEmployee" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('editEmployee') }}" method="post">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h5 class="modal-title" id="EditEmployeeLabel">Thông tin nhân viên</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col">
                        <div class="form">
                            <div class="form-group">
                                <label>ID tài khoản</label>
                                <input id="employee_id" name="employee_id" class="form-control" readonly />
                            </div>
                            <div class="form-group">
                                <label>Họ và tên</label>
                                <input id="employee_fullname" name="employee_fullname" class="form-control"
                                    type="text" required />
                            </div>
                            <div class="form-group">
                                <label>Giới tính</label>
                                <select id="employee_gender" name="employee_gender" class="form-control">
                                    <option value="Nam">Nam</option>
                                    <option value="Nữ">Nữ</option>
                                </select>

                            </div>
                            <div class="form-group">
                                <label>Địa chỉ</label>
                                <input id="employee_address" name="employee_address" class="form-control"
                                    type="text" />
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại</label>
                                <input id="employee_phonenumber" name="employee_phonenumber" class="form-control"
                                    type="tel" readonly required minlength="10" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input id="employee_email" name="employee_email" class="form-control" type="email"
                                    required />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">Sửa</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="deleteEmployee" tabindex="-1" aria-labelledby="deleteEmployeeLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('deleteEmployee') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteEmployeeLabel">Xóa nhân viên</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="deleteEmployeeId" name="deleteEmployeeId">
                    <p>Bạn có chắc chắn muốn xóa nhân viên này?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </div>
            </form>
        </div>
    </div>
</div>
