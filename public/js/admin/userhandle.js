$(document).ready(function () {
    $(document).on('click', '.edit-btn', function () {
        var userId = $(this).data('user-id');
        $('#deleteUserId').val(userId);
    });

    $(document).on('click', '.edit-btn', function () {
        var userId = $(this).data('user-id');
        console.log(userId);
        $.ajax({
            url: '/get-user/' + userId,
            type: 'GET',
            success: function (data) {
                $('#id').val(data.id);
                $('#fullname').val(data.name);
                $('#gender').val(data.gender);
                $('#user_address').val(data.address);
                $('#phonenumber').val(data.phone_number);
                $('#email').val(data.email);
                $('#user_point').val(data.user_point);
            }
        });
    });

    $('.phone-edit-btn').click(function () {
        var phoneId = $(this).data('phone-id');
        $.ajax({
            url: '/editPhone/' + phoneId,
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

    $('.edit-phone-color-btn').click(function () {
        var phone_id = $(this).data('phone-id');
        ajaxGetColors(phone_id);
    });

    $(document).on('click', '.edit-selected-color-btn', function () {
        var color_id = $(this).data('color-id');
        $.ajax({
            url: '/editSelectedColor/' + color_id,
            type: 'GET',
            success: function(response) {
                $('#edit-color-form').removeClass('d-none');
                $('#ec_color_id').val(response.color_id)
                $('#ec_color_name').val(response.color_name)
                $('#notification').addClass('d-none');
            }
        })
    });

    $(document).on('click', '#close-edit-color-form-btn', function() {
        $('#edit-color-form').addClass('d-none');
        $('#ec_color_id').val('')
        $('#ec_color_name').val('')
        $('#notification').addClass('d-none');
    })

    $(document).on('submit', '#edit-color-form', function(e) {
        var phone_id = $('#ec_phone_id').val()
        e.preventDefault()
        var form = $(this)
        $.ajax({
            type: 'POST',
            url: '/editSelectedColorSubmit',
            data: form.serialize(),
            success: function(response) {
                ajaxGetColors(phone_id)
                $('#notification').removeClass('d-none');
            },
            error: function() {
                alert('dcmm')
            }
        })
    })

    $('#search').on('input', function () {
        var searchTerm = $(this).val().trim();
        $.ajax({
            url: '/searchUser/' + searchTerm,
            type: 'GET',
            success: function (data) {
                $('#data-body').empty();
                $.each(data, function (index, user) {
                    var row = '<tr>' +
                        '<th scope="row">' + user.id + '</th>' +
                        '<td>' + user.name + '</td>' +
                        '<td>' + user.phone_number + '</td>' +
                        '<td>' + user.gender + '</td>' +
                        '<td>' + user.address + '</td>' +
                        '<td>' + user.email + '</td>' +
                        '<td>' + user.user_point + '</td>' +
                        '<td>' +
                        '<a class="col btn btn-primary edit-btn" data-bs-toggle="modal" data-bs-target="#editUser" data-user-id="' + user.id + '">Sửa</a>' +
                        '<a class="col btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#deleteUser" data-user-id="' + user.id + '">Xóa</a>' +
                        '</td>' +
                        '</tr>';
                    $('#data-body').append(row);
                });
            }
        });
    });
});

