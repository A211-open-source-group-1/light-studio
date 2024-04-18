$(document).ready(function(){
    $(document).on('click', '.listCategory-btn', function () {
        var id = $(this).data('category-id');
        $('#idCategory').val(id);
    });
    


    $(document).on('click', '.phone-edit-btn', function () {
        var id = $(this).data('phone-id');
        $.ajax({
            url: '/editPhone/' + id,
            type: 'GET',
            success: function (response) {
                $('#phone_id').val(response[0].phone_id);
                $('#phone_name').val(response[0].phone_name);
                $('#description').summernote('code', response[0].description);
                $('#brand_name').empty();
                $('#category_name').empty();
                $('#os_name').empty();
                for (let i = 0; i < response[1].length; ++i) {
                    $('#brand_name').append(
                        '<option value="' + response[1][i].brand_id + '" ' + (response[0].brand_id == response[1][i].brand_id ? ' selected ' : '') + ' >' + response[1][i].brand_name + '</option>'
                    );
                }

                for (let i = 0; i < response[2].length; ++i) {
                    $('#category_name').append(
                        '<option value="' + response[2][i].category_id + '" ' + (response[0].category_id == response[2][i].category_id ? ' selected ' : '') + '>' + response[2][i].category_name + '</option>'
                    );
                }

                for (let i = 0; i < response[3].length; ++i) {
                    $('#os_name').append(
                        '<option value="' + response[3][i].os_id + '" ' + (response[0].os_id == response[3][i].os_id ? ' selected ' : '') + ' >' + response[3][i].os_name + '</option>'
                    );
                }
            }
        });
    });

    $(document).on('click', '.edit-phone-color-btn', function () {
        var id = $(this).data('phone-id');
        ajaxGetColors(id);
    });  

    function ajaxGetColors(phone_id) {
        $.ajax({
            url: '/editColors/' + phone_id,
            type: 'GET',
            success: function (response) {
                $('#ec_phone_name').val(response[1].phone_name);
                $('#ec_phone_id').val(response[1].phone_id);
                $('#color-board').empty();
                for (let i = 0; i < response[0].length; ++i) {
                    $('#color-board').append(
                        '<tr>' +
                        '<td scope="row">' +
                        response[0][i].color_id +
                        '</td>' +
                        '<td>' +
                        response[0][i].color_name +
                        '</td>' +
                        '<td>' +
                        response[0][i].phone_details_count +
                        '</td>' +
                        '<td>' +
                        '<button data-color-id="' + response[0][i].color_id + '" class="btn btn-primary edit-selected-color-btn">Sửa</button>' +
                        '<button data-color-id="' + response[0][i].color_id + '" class="ms-1 btn btn-danger delete-selected-color-btn">Xóa</button>' +
                        '</td>' +
                        '</tr>'
                    )
                }
            }
        })
    }

    $(document).on('click', '.listCategory-btn', function () {
        var id = $(this).data('category-id');
        $.ajax({
            url: '/listPhoneCategory/' + id,
            type: 'get',
            success: function (data) {
                $('#data-body-list').empty();
                for (let i = 0; i < data[0].length; ++i) {
                    var row = '<tr>' +
                        '<th scope="row">' + data[0][i].phone_id + '</th>' +
                        '<td>' + data[0][i].phone_name + '</td>' +
                        '<td>' + data[0][i].brand_name + '</td>' +
                        '<td>' + data[0][i].category_description + '</td>' +
                        '<td>' + data[0][i].os_name + '</td>' +                                          
                        '<td>'+  data[0][i].colors_count +' <button type="button"  class="btn btn-sm btn-warning edit-phone-color-btn" data-bs-toggle="modal"  data-bs-target="#editPhoneColor" data-phone-id="'+data[0][i].phone_id+'">Chi tiết</button>'+'</td>' +
                        '<td>' + data[0][i].specifics_count+ '<button type="button" class="btn btn-sm btn-warning">Chi tiết</button> '+ '</td>' +
                        '<td>' + data[0][i].phone_details_count +'<button type="button" class="btn btn-sm btn-warning">Chi tiết</button> '+ '</td>' +
                        '<td>'+' <a class="col btn btn-primary phone-edit-btn" data-bs-toggle="modal" data-bs-target="#editPhone" data-phone-id="'+data[0][i].phone_id+'">Sửa</a>   <a class="col btn btn-danger phone-edit-btn" data-bs-toggle="modal" data-bs-target="#" data-phone-id="{{ $row->phone_id }}">Xóa</a></td>'+
                        '</tr>';
                    $('#data-body-list').append(row);
                }   
            }
        });
    });
    
})