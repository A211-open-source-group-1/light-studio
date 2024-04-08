$(document).ready(function () {
    $(document).on('click', '.edit-btn', function() {
        var userId = $(this).data('user-id');
        $('#deleteUserId').val(userId);
    });

    $(document).on('click', '.edit-btn', function() {
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
                $('#phone_id').val(response.phone_id);
                $('#phone_name').val(response.phone_name);
                $('#description').summernote('code', response.description);
            }
        });
    });

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
            },
        });
    });
});

