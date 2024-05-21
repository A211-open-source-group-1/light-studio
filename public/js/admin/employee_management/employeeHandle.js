
$(document).on('click', '.edit-employee-btn', function () {
    var customerID = $(this).data('user-id');
    console.log(customerID);
    $.ajax({
        url: '/get-employee/' + customerID,
        type: 'GET',
        success: function (data) {
            $('#employee_id').val(data.id);
            $('#employee_fullname').val(data.name);
            $('#employee_gender').val(data.gender);
            $('#employee_address').val(data.address);
            $('#employee_phonenumber').val(data.phone_number);
            $('#employee_email').val(data.email);
        }
    });
});
$('#searchEmployee').on('input', function () {
    var searchTerm = $(this).val().trim();
    $.ajax({
        url: '/searchEmployee/' + searchTerm,
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
                    '<td>' +
                    '<a class="col btn btn-primary edit-employee-btn" data-bs-toggle="modal" data-bs-target="#editEmployee" data-user-id="' + user.id + '">Sửa</a>' +
                    '<a class="col btn btn-danger delete-employee-btn" data-bs-toggle="modal" data-bs-target="#editEmployee" data-user-id="' + user.id + '">Xóa</a>' +
                    '</td>' +
                    '</tr>';
                $('#data-body').append(row);
            });
        }
    });
});

$(document).on('click', '.delete-employee-btn', function () {
    var userId = $(this).data('user-id');
    $('#deleteEmployeeId').val(userId);
});