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
            success: function (response) {
                $('#edit-color-form').removeClass('d-none');
                $('#ec_color_id').val(response.color_id)
                $('#ec_color_name').val(response.color_name)
                $('#edit_notification').addClass('d-none');
            }
        })
    });

    $(document).on('click', '#close-edit-color-form-btn', function () {
        $('#edit-color-form').addClass('d-none');
        $('#ec_color_id').val('')
        $('#ec_color_name').val('')
        $('#notification').addClass('d-none');
    })

    $(document).on('submit', '#edit-color-form', function (e) {
        var phone_id = $('#ec_phone_id').val()
        e.preventDefault()
        var form = $(this)
        $.ajax({
            type: 'POST',
            url: '/editSelectedColorSubmit',
            data: form.serialize(),
            success: function (response) {
                ajaxGetColors(phone_id)
                $('#edit_notification').removeClass('d-none');
            },
            error: function () {
                alert('Loi r')
            }
        })
    })

    $(document).on('click', '#close-add-color-form-btn', function () {
        $('#add-color-form').addClass('d-none');
        $('#add_notification').addClass('d-none');
        $('#add-color-form-btn').removeClass('d-none');
        $('#delete_notification').addClass('d-none')
    })

    $(document).on('click', '#add-color-form-btn', function () {
        $('#add-color-form').removeClass('d-none');
        $('#add_notification').addClass('d-none');
        $('#add-color-form-btn').addClass('d-none');
        $('#delete_notification').addClass('d-none')
        $('#new_color_id').val('');
    })

    $(document).on('submit', '#add-color-form', function (e) {
        var phone_id = $('#ec_phone_id').val()
        e.preventDefault();
        var form = $(this);
        $.ajax({
            type: 'POST',
            url: '/addColorSubmit',
            data: form.serialize() + '&' + 'phone_id=' + phone_id,
            success: function (response) {
                ajaxGetColors(phone_id)
                $('#add_notification').removeClass('d-none')
            },
            error: function () {
                alert('Loi r')
            }
        })
    })

    $(document).on('click', '.delete-selected-color-btn', function () {
        var phone_id = $('#ec_phone_id').val()
        var color_id = $(this).data('color-id');
        $.ajax({
            type: 'GET',
            url: '/deleteColor/' + color_id,
            success: function (response) {
                ajaxGetColors(phone_id)
                $('#delete_notification').removeClass('d-none')
            },
            error: function () {
                alert('Loi r')
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
                    console.log(user);

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


    $(document).on('click', '.list-brand-btn', function () {
        var brand_id = $(this).data('brand-id');
        $.ajax({
            url: '/listItemBrand/' + brand_id,
            type: 'GET',
            success: function (data) {
                $('#data-body-list-brand-item').empty();
                console.log(data);
                for (let i = 0; i < data[0].length; ++i) {
                    var row = '<tr>' +
                        '<th scope="row">' + data[0][i].phone_id + '</th>' +
                        '<td>' + data[0][i].phone_name + '</td>' +
                        '<td>' + data[0][i].brand_name + '</td>' +
                        '<td>' + data[0][i].category_description + '</td>' +
                        '<td>' + data[0][i].os_name + '</td>' +
                        '<td>' + data[0][i].colors_count + ' <button type="button"  class="btn btn-sm btn-warning edit-phone-color-btn" data-bs-toggle="modal"  data-bs-target="#editPhoneColor" data-phone-id="' + data[0][i].phone_id + '">Chi tiết</button>' + '</td>' +
                        '<td>' + data[0][i].specifics_count + '<button type="button" class="btn btn-sm btn-warning">Chi tiết</button> ' + '</td>' +
                        '<td>' + data[0][i].phone_details_count + '<button type="button" class="btn btn-sm btn-warning">Chi tiết</button> ' + '</td>' +
                        '<td>' + ' <a class="col btn btn-primary phone-edit-btn" data-bs-toggle="modal" data-bs-target="#editPhone" data-phone-id="' + data[0][i].phone_id + '">Sửa</a>   <a class="col btn btn-danger phone-edit-btn" data-bs-toggle="modal" data-bs-target="#" data-phone-id="{{ $row->phone_id }}">Xóa</a></td>' +
                        '</tr>';
                    $('#data-body-list-brand-item').append(row);
                }
            }
        })
    })


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
                console.log(data);
                $('#data-body-list').empty();
                for (let i = 0; i < data[0].length; ++i) {
                    var row = '<tr>' +
                        '<th scope="row">' + data[0][i].phone_id + '</th>' +
                        '<td>' + data[0][i].phone_name + '</td>' +
                        '<td>' + data[0][i].brand_name + '</td>' +
                        '<td>' + data[0][i].category_description + '</td>' +
                        '<td>' + data[0][i].os_name + '</td>' +
                        '<td>' + data[0][i].colors_count + ' <button type="button"  class="btn btn-sm btn-warning edit-phone-color-btn" data-bs-toggle="modal"  data-bs-target="#editPhoneColor" data-phone-id="' + data[0][i].phone_id + '">Chi tiết</button>' + '</td>' +
                        '<td>' + data[0][i].specifics_count + '<button type="button" class="btn btn-sm btn-warning">Chi tiết</button> ' + '</td>' +
                        '<td>' + data[0][i].phone_details_count + '<button type="button" class="btn btn-sm btn-warning">Chi tiết</button> ' + '</td>' +
                        '<td>' + ' <a class="col btn btn-primary phone-edit-btn" data-bs-toggle="modal" data-bs-target="#editPhone" data-phone-id="' + data[0][i].phone_id + '">Sửa</a>   <a class="col btn btn-danger phone-edit-btn" data-bs-toggle="modal" data-bs-target="#" data-phone-id="{{ $row->phone_id }}">Xóa</a></td>' +
                        '</tr>';
                    $('#data-body-list').append(row);
                }
            }
        });
    });


    $('#searchBrand').on('input', function () {
        var searchTerm = $(this).val().trim();
        $.ajax({
            url: '/searchBrand/' + searchTerm,
            type: 'GET',
            success: function (data) {
                $('#data-body').empty();
                $.each(data, function (index, brand) {
                    console.log(brand);
                    var imageSrc = '/image/' + brand.brand_img; // Assuming the images are stored in a directory named 'image'
                    var row = '<tr>' +
                        '<th scope="row">' + brand.brand_id + '</th>' +
                        '<td scope="row" class="align-middle"><img class="img-brand" src="' + imageSrc + '"></td>' +
                        '<td scope="row" class="align-middle">' + brand.brand_name + '</td>' +
                        '<td scope="row" class="align-middle">' + brand.brand_description + '</td>' +
                        '<td scope="row" class="align-middle"><a class="col btn btn-primary list-brand-btn" data-bs-toggle="modal" data-bs-target="#listBrand" data-brand-id="' + brand.brand_id + '">Xem danh sách</a>' +
                        '</tr>';
                    $('#data-body').append(row);
                });
            }
        });
    });



});

