$(document).ready(function() {
    $('#login-btn').click(function() {
        $.ajax({
            url: 'login',
            success: function(data) {
                $('body').append(data);
                $('#loginModal').modal('toggle');
            },
            dataType: 'html'
        })
    })
    
    $('#register-btn').click(function() {
        $.ajax({
            url: 'register',
            success: function(data) {
                $('body').append(data);
                $('#registerModal').modal('toggle');
            }
        })
    })
})