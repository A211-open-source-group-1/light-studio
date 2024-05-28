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
            success: function (response) {
                $('#nav-all').html($(response).find('#nav-all').html());
            }
        })
    }

    function getProcessing(page) {
        $.ajax({
            type: 'GET',
            url: '?processing=' + page,
            success: function (response) {
                $('#nav-processing').html($(response).find('#nav-processing').html());
            }
        })
    }

    function getProceed(page) {
        $.ajax({
            type: 'GET',
            url: '?proceed=' + page,
            success: function (response) {
                $('#nav-proceed').html($(response).find('#nav-proceed').html());
            }
        })
    }

    function getDelivering(page) {
        $.ajax({
            type: 'GET',
            url: '?delivering=' + page,
            success: function (response) {
                $('#nav-delivering').html($(response).find('#nav-delivering').html());
            }
        })
    }

    function getDelivered(page) {
        $.ajax({
            type: 'GET',
            url: '?delivered=' + page,
            success: function (response) {
                $('#nav-delivered').html($(response).find('#nav-delivered').html());
            }
        })
    }

    $(document).on('click', '.btn-processing', function () {
        var order_id = $(this).data('order-id');
        var form = $('#setProcessingOrderForm');
        $.ajax({
            url: '/setProcessingOrder',
            type: 'POST',
            data: form.serialize() + '&order_id=' + order_id,
            success: function (response) {
                const toastLive = document.getElementById('toastSetSucceed')
                const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLive)
                toastBootstrap.show();
                $('#processing-' + order_id).remove();
            },
            error: function (response) {
                const toastLive = document.getElementById('toastSetFailed')
                const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLive)
                toastBootstrap.show()
            }
        })
    })

    $(document).on('click', '.btn-proceed', function () {
        var order_id = $(this).data('order-id');
        var form = $('#setProceedOrderForm');
        $.ajax({
            url: '/setProceedOrder',
            type: 'POST',
            data: form.serialize() + '&order_id=' + order_id,
            success: function (response) {
                const toastLive = document.getElementById('toastSetSucceed')
                const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLive)
                toastBootstrap.show();
                $('#proceed-' + order_id).remove();
            },
            error: function (response) {
                const toastLive = document.getElementById('toastSetFailed')
                const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLive)
                toastBootstrap.show()
            }
        })
    })

    $(document).on('click', '.btn-delivering', function () {
        var order_id = $(this).data('order-id');
        var form = $('#setDeliveringOrderForm');
        $.ajax({
            url: '/setDeliveringOrder',
            type: 'POST',
            data: form.serialize() + '&order_id=' + order_id,
            success: function (response) {
                const toastLive = document.getElementById('toastSetSucceed')
                const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLive)
                toastBootstrap.show();
                $('#delivering-' + order_id).remove();
            },
            error: function (response) {
                const toastLive = document.getElementById('toastSetFailed')
                const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLive)
                toastBootstrap.show()
            }
        })
    })

    $(document).on('click', '.show-ordered-product-btn', function () {
        var order_id = $(this).data('order-id');
        $('#details_show_body').empty();
        $.ajax({
            url: '/showProduct/' + order_id,
            type: 'GET',
            success: function (response) {
                for (let i = 0; i < response.length; ++i) {
                    $('#details_show_body').append('<tr>' +
                        '<td>' +
                        '<img style="width: 12rem" src="image/' + response[i].thumbnail_img + '">' +
                        '</td>' +
                        '<td>' +
                        '<p>' + response[i].phone_details_id + ' </p>' +
                        '</td>' +
                        '<td>' +
                        '<p>' + response[i].price + ' VNĐ</p>' +
                        '</td>' +
                        '<td>' +
                        '<p>' + response[i].discount + ' VNĐ</p>' +
                        '</td>' +
                        '<td>' +
                        '<p>' + response[i].order_quantity + '</p>' +
                        '</td>' +
                        '<td>' +
                        '<p>' + (response[i].price - response[i].discount) * response[i].order_quantity + ' VNĐ </p>' +
                        '</td>' +
                        '</tr>')
                }
            }
        })
    })

    $(document).on('click', '.btn-cancel-order', function () {
        var order_id = $(this).data('order-id');
        var order_type = $(this).data('order-type');
        var form = $('#cancelOrderForm');
        $.ajax({
            url: '/cancelOrder',
            type: 'POST',
            data: form.serialize() + '&order_id=' + order_id,
            success: function (response) {
                const toastLive = document.getElementById('toastCancelSucceed')
                const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLive)
                toastBootstrap.show();
                if (order_type == 'proceed') {
                    $('#proceed-' + order_id).remove();
                } else if (order_type = 'processing') {
                    $('#processing-' + order_id).remove();
                }
            },
            error: function (response) {
                const toastLive = document.getElementById('toastSetFailed')
                const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLive)
                toastBootstrap.show()
            }
        })
    })

    $(document).on('click', '.btn-return-order', function () {
        var order_id = $(this).data('order-id');
        var form = $('#returnOrderForm');
        $.ajax({
            url: '/setReturnOrder',
            type: 'POST',
            data: form.serialize() + '&order_id=' + order_id,
            success: function (response) {
                const toastLive = document.getElementById('toastReturnSucceed')
                const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLive)
                toastBootstrap.show();
                $('#delivering-' + order_id).remove();
            },
            error: function (response) {
                const toastLive = document.getElementById('toastSetFailed')
                const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLive)
                toastBootstrap.show()
            }
        })
    })

    $(document).on('click', '.btn-cancel-order', function () {
        $('#cancel-order-submit-btn').data('order-id', $(this).data('order-id'));
    })

    $(document).on('click', '#cancel-order-submit-btn', function () {
        var order_id = $(this).data('order-id');
        $.ajax({
            url: '/cancelOrder/' + order_id,
            type: 'GET',
            success: function () {
                location.reload();
            }
        })
    })
})