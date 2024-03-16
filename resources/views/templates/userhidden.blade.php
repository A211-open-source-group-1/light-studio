<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div class="toast bg-toast-success">
      <div class="toast-header">
        <strong class="me-auto">Thông báo</strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
      </div>
      <div class="toast-body">
        <p>Bạn đã thêm một sản phẩm mới vào giỏ hàng</p>
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