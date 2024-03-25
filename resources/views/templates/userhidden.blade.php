
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div class="toast bg-toast-success" id="toastAddToCartSuccess">
      <div class="toast-header">
        <strong class="me-auto">Thông báo</strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
      </div>
      <div class="toast-body">
        <p>Bạn đã thêm một sản phẩm mới vào giỏ hàng!</p>
      </div>
    </div>
</div>

<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
  <div class="toast bg-toast-success" id="toastAddToCartFailed">
    <div class="toast-header">
      <strong class="me-auto">Thông báo</strong>
      <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
    </div>
    <div class="toast-body">
      <p>Có lỗi xảy ra! Xin vui lòng thử lại sau!</p>
    </div>
  </div>
</div>

<div class="modal fade hide" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form method="post" action="{{route('login')}}" id="loginForm">
      <div class="modal-header">
        <h5 class="modal-title">Đăng nhập</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
      </div>
      <div class="modal-body">
          {{ csrf_field() }}
          <div class="mb-2">
            <label class="form-label">Số điện thoại</label>
            <input class="form-control" id="phone_number" name="phone_number" type="tel">
            <label class="text-danger" id="errorPhoneNumberLogin"></label>

          </div>
          <div class="mb-2">
            <label class="form-label">Mật khẩu</label>
            <input class="form-control" id="password" name="password" type="password">
            <label class="text-danger" id="errorPasswordLogin"></label>
          </div>
          <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input">
            <label class="form-check-label">Ghi nhớ đăng nhập</label>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
          <button type="button" class="btn btn-primary" onclick="check_Login()">Đăng nhập</button>
          <a type="button" class="btn btn-warning" href="/identify">Quên mật khẩu</a>
        </div>
      </form>
      @foreach ($errors->all() as $error)
    <script>
        alert("{{ $error }}");
    </script>
    @endforeach

  
    </div>
  </div>
</div>

<div class="modal fade hide" id="registerModal" tabindex="-1" aria-labelledby="registerModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">

        <h5 class="modal-title">Đăng ký</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
      </div>
      <div class="modal-body">
        <form action="{{route('register')}}" method="post" id="registerForm">
        {{ csrf_field() }}
          <div class="mb-2">
            <label class="form-label">Số điện thoại</label>
            <input class="form-control" name="phoneNumber" id="phoneNumber" type="tel">
            <label class="text-danger" id="errorPhoneNumber"></label>
          </div>
          <div class="mb-2">
            <label class="form-label">Email</label>
            <input class="form-control" name="email" id="email" type="email">
            <label class="text-danger" id="errorEmail"></label>
          </div>
          <div class="mb-2">
            <label class="form-label">Họ và tên</label>
            <input class="form-control" name="fullname" id="fullname" type="text">
            <label class="text-danger" id="errorFullname"></label>
          </div>
          <div class="mb-2">
            <label class="form-label">Giới tính</label>
            <div class="container-fluid">
              <div class="row">
                <div class="col-6 text-center">
                  <input name="gender" type="radio" value="Nam" checked>
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
            <input class="form-control" name="password" type="password" id="password1" >
            <label id="errorPassword" class="text-danger"></label>
          </div>
          <div class="mb-2">
            <label class="form-label">Nhập lại mật khẩu</label>
            <input class="form-control" id="repassword" name="repassword" type="password">
            <label id="errorRepassword" class="text-danger"></label>

          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary" onclick="handle_validate()">Đăng ký</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script>
    function showToast() {
        var toastElList = [].slice.call(document.querySelectorAll('.toast'))
        var toastList = toastElList.map(function(toastEl) {
            return new bootstrap.Toast(toastEl)
        })
        toastList.forEach(toast => toast.show()) 
    }
</script>