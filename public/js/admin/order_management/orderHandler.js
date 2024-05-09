$(document).ready(function () {
    $(document).unbind('click', '.pagination a')
    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        if ($(this).attr('href').indexOf('all=') >= 0) {
            var page = $(this).attr('href').split('all=')[1];
            getAll(page); 
        } else if ($(this).attr('href').indexOf('processing=') >= 0) {
            var page = $(this).attr('href').split('processing=')[1];
            getProcessing(page);
        } else if ($(this).attr('href').indexOf('proceed=') >= 0) {
            var page = $(this).attr('href').split('proceed=')[1];
            getProceed(page);
        } else if ($(this).attr('href').indexOf('delivering=') >= 0) {
            var page = $(this).attr('href').split('delivering=')[1];
            getDelivering(page);
        } else if ($(this).attr('href').indexOf('delivered=') >= 0) {
            var page = $(this).attr('href').split('delivered=')[1];
            getDelivered(page);
        } else {

        }
    });

    function getAll(page) {
        $.ajax({
            type: 'GET',
            url: '?all=' + page,
            success: function(response) {
                $('#nav-all').html($(response).find('#nav-all').html());
            }
        })
    }
    
    function getProcessing(page) {
        $.ajax({
            type: 'GET',
            url: '?processing=' + page,
            success: function(response) {
                $('#nav-processing').html($(response).find('#nav-processing').html());
            }
        })
    }

    function getProceed(page) {
        $.ajax({
            type: 'GET',
            url: '?proceed=' + page,
            success: function(response) {
                $('#nav-proceed').html($(response).find('#nav-proceed').html());
            }
        })
    }

    function getDelivering(page) {
        $.ajax({
            type: 'GET',
            url: '?delivering=' + page,
            success: function(response) {
                $('#nav-delivering').html($(response).find('#nav-delivering').html());
            }
        })
    }

    function getDelivered(page) {
        $.ajax({
            type: 'GET',
            url: '?delivered=' + page,
            success: function(response) {
                $('#nav-delivered').html($(response).find('#nav-delivered').html());
            }
        })
    }
})