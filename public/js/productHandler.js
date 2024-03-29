function defaultSubmit() {
    $('#filterForm').submit(function (e) {
        e.preventDefault();
    })
    $.ajax({
        type: 'get',
        url: '/filter',
        data: $('#filterForm').serialize(),
        success: function (response) {
            var newDoc = document.open("text/html", "replace");
            newDoc.write(response);
            newDoc.close();
        }
    })
}