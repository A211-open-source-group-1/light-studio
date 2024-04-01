function defaultSubmit() {
    $('#filterForm').submit(function (e) {
        e.preventDefault();
    })
    $('#product-section').append('<div class="loading"></div>');
    setTimeout(() =>
        $.ajax({
            type: 'post',
            url: '/filter',
            async: false,
            data: $('#filterForm').serialize(),
            success: function (response) {
                $('#product-section').html($(response).find('#product-section').html());
            },
            complete: function () {

            }
        }), 250
    )
}