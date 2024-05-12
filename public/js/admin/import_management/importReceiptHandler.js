$(document).ready(function () {
    $('#first_details_select').select2({
        dropdownParent: $('#addImportReceipt .modal-content'),
        placeholder: 'Tìm kiếm sản phẩm con theo tên hoặc mã',
        width: '100%'
    })

    ajaxGetDetailsList('first_details_select');

    function ajaxGetDetailsList(selectToAppend) {
        $.ajax({
            url: '/getAllDetailsList',
            type: 'GET',
            success: function (response) {
                for (let i = 0; i < response.length; ++i) {
                    $('#' + selectToAppend).append('<option value="' + response[i].phone_details_id + '">' +
                        '[' + response[i].phone_details_id + '] ' + response[i].phone_name + ' ' + response[i].specific_name + ' ' + response[i].color_name +
                        '</option>')
                }
            }
        })
    }

    $(document).on('click', '#new-product-btn', function () {
        var uniqueId = Math.floor(Date.now() * Math.random());
        $('#adding-product-holder').append(
            '<div class="row border p-1 mt-1" id="product-' + uniqueId + '">' +
            '<div class="col-12 mt-2">' +
            '<label>Sản phẩm</label>' +
            '<select id="select-' + uniqueId + '" name="details_id[]" class="form-select" required>' +
            '</select>' +
            '</div>' +
            '<div class="col-12 col-lg-6 mt-2">' +
            '<label>Số lượng</label>' +
            '<input type="number" class="form-control" name="import_quantity[]" value="1" min="1" required>' +
            '</div>' +
            '<div class="col-12 col-lg-6 mt-2">' +
            '<label>Đơn vị tính</label>' +
            '<input class="form-control" name="unit_name[]" required>' +
            '</div>' +
            '<div class="col-12 col-lg-6 mt-2">' +
            '<label>Giá nhập (VNĐ)</label>' +
            '<input class="form-control" name="price[]" value="0" min="0" required>' +
            '</div>' +
            '<div class="col-12 col-lg-6 mt-2 text-end">' +
            '<button class="btn btn-danger mt-4 delete-product-btn" type="button" data-product-id="product-' + uniqueId + '"><i class="fa-solid fa-xmark"></i></button>' +
            '</div>' +
            '</div>'
        )
        $('#select-' + uniqueId).select2({
            dropdownParent: $('#addImportReceipt .modal-content'),
            placeholder: 'Tìm kiếm sản phẩm con theo tên hoặc mã',
            width: '100%'
        })

        ajaxGetDetailsList('select-' + uniqueId);
    })

    $(document).on('click', '.delete-product-btn', function () {
        var id = $(this).data('product-id');
        $('#' + id).remove();
    })
})