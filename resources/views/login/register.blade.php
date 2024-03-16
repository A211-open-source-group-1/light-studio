<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Đăng ký</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-2">
              <label class="form-label">Số điện thoại</label>
              <input class="form-control" name="phoneNumber" type="tel">
            </div>
            <div class="mb-2">
              <label class="form-label">Email</label>
              <input class="form-control" name="phoneNumber" type="email">
            </div>
            <div class="mb-2">
              <label class="form-label">Họ và tên</label>
              <input class="form-control" name="fullname" type="text">
            </div>
            <div class="mb-2">
              <label class="form-label">Giới tính</label>
              <div class="container-fluid">
                <div class="row">
                  <div class="col-6 text-center">
                    <input name="gender" type="radio" value="Nam">
                    <label>Nam</label>
                  </div>
                  <div class="col-6 text-center">
                    <input name="gender" type="radio" value="Nữ">
                    <label>Nữ</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="mb-2">
              <label class="form-label">Mật khẩu</label>
              <input class="form-control" name="password" type="password">
            </div>
            <div class="mb-2">
              <label class="form-label">Nhập lại mật khẩu</label>
              <input class="form-control" name="repassword" type="password">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
          <button type="button" class="btn btn-primary">Đăng ký</button>
        </div>
      </div>
    </div>
  </div>