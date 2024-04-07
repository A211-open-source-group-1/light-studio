<script src="{{asset('/js/admin/userhandle.js')}}"></script>

<div class="modal fade" id="deleteUser" tabindex="-1" aria-labelledby="deleteUserLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('deleteUser')}}" method="post">
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
            <form action="{{route('deleteUser')}}" method="post">
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
            <form action="{{route('editUser')}}" method="post">
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
                                <input id="phonenumber" name="phonenumber" class="form-control" type="tel" readonly required minlength="10" />
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