<script>
    $(document).ready(function() {
        $('.delete-btn').click(function() {
            var userId = $(this).data('user-id');
            $('#deleteUserId').val(userId);
        });
    });
</script>

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