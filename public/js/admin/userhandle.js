// function deleteUser(id)
// {
//     $.ajax({
//         type : "GET",
//         url: '/onActionUser/'+id+'/detele',
//         success: function(response)
//         {
//             $('$data-body').empty()
//             $('$data-body').append(response)
//         }
//     })
// }

$(document).ready(function() {
    $('.delete-btn').click(function() {
        var userId = $(this).data('user-id');
        $('#deleteUserId').val(userId);
    });
});

// $(document).ready(function() {
//     $('.edit-btn').click(function() {
//         var userId = $(this).data('user-id');
//         $('#id').val(userId);
//     });
// });


    $('.edit-btn').click(function() {
        var userId = $(this).data('user-id');
        $.ajax({
            url: '/get-user/' + userId,
            type: 'GET',
            success: function(data) {
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

