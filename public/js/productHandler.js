function defaultSubmit() {
    $('#filterForm').submit(function (e) {
        e.preventDefault();
    })
    $('#product-section').append('<div class="loading"></div>');
    setTimeout(() =>
        $.ajax({
            type: 'get',
            url: '/filter',
            async: false,
            data: $('#filterForm').serialize(),
            success: function (response) {
                // var newDoc = document.open("text/html", "replace");
                // newDoc.write(response);
                // newDoc.close();
                $('#product-section').html($(response).find('#product-section').html());
            },
            complete: function () {

            }
        }), 250
    )
}