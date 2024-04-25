<script src="{{ asset('/js/admin/userhandle.js') }}"></script>

@if (session('auth'))
    <script>
        alert("{{ session('auth') }}");
    </script>
@endif


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
                    <input type="text" id="deleteUserId" name="deleteUserId">
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
                                <input id="user_point" name="text" class="form-control" type="text"
                                    readonly />
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

<div class="modal fade" id="editPhone" tabindex="-1" aria-labelledby="editPhone" aria-hidden="true" >
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
                                            height: 350
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
                    <form id="edit-color-form" method="POST" class="form border-0 d-none" action="{{route('editSelectedColorSubmit')}}">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <label for="ec_color_id">Mã màu</label>
                                <input readonly id="ec_color_id" name="current_color_id" class="form-control" type="text">
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="ec_color_name">Tên màu</label>
                                <input id="ec_color_name" name="current_color_name" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">

                            </div>
                            <div class="col-4 text-end">
                                <button id="submit-edit-color-form-btn" class="btn btn-success" type="submit">Lưu</button>
                                <button id="close-edit-color-form-btn" class="btn btn-dark" type="button">Hủy</button>
                            </div>
                        </div>
                        <div class="row" id="edit_notification" class="d-none">
                            <p class="text-success text-end mt-3">Sửa thành công!</p>
                        </div>
                    </form>
                    <form id="add-color-form" method="POST" class="form border-0 d-none" action="{{route('addColorSubmit')}}">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <label for="new_color_id">Tên màu</label>
                                <input id="new_color_id" name="new_color_name" class="form-control" type="text" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">

                            </div>
                            <div class="col-4 text-end">
                                <button id="submit-add-color-form-btn" class="btn btn-success" type="submit">Thêm</button>
                                <button id="close-add-color-form-btn" class="btn btn-dark" type="button">Hủy</button>
                            </div>
                        </div>
                        <div class="row" id="add_notification" class="d-none">
                            <p class="text-success text-end mt-3">Thêm thành công!</p>
                        </div>
                    </form>
                    <div class="row" id="delete_notification" class="d-none">
                        <p class="text-success text-end mt-3">Xóa thành công!</p>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button id="add-color-form-btn" class="btn btn-success">Thêm</button>
                            <div class="container-fluid m-0 p-0">
                                <table class="table table-light">
                                    <thead>
                                        <tr>
                                            <th scope="col">Mã màu</th>
                                            <th scope="col">Tên màu</th>
                                            <th scope="col">Số lượng PB</th>
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
