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
            <form action="{{ '' }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Chỉnh sửa màu sắc sản phẩm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <label for="ec_phone_name">Tên sản phẩm</label>
                                <input readonly id="ec_phone_name" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="container-fluid m-0 p-0" id="color-board">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-success">Lưu</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
        </div>
        </form>
    </div>
</div>
