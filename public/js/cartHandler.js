$(document).ready(function () {
    var formSubmissionAllowed = false;

    $('#formCart').submit(function (e) {  
            e.preventDefault(); 
    });

    $('#proccedOrder').click(function (){
        var selectedPaymentMethod = getSelectedPaymentMethod();
        $.ajax({
            type: "get",
            url: '/proccedOrder/'+selectedPaymentMethod,
            success: function(response)
            {
                $('#data-body').empty()
                $('#data-body').append(response)            }

        })
    });
    
});

function getSelectedPaymentMethod() {
    var paymentMethods = document.getElementsByName('paymentMethod');
    for (var i = 0; i < paymentMethods.length; i++) {
        if (paymentMethods[i].checked) {
            return paymentMethods[i].value;
        }
    }
}

function backCart()
{
    $.ajax({
        type:"get",
        url:'/cart',
        success: function(response)
        {
            $('#data-body').empty()
            $('#data-body').append(response)            
        }
    })
}

function AddToCart(id) {
    $.ajax({
        type: "GET",
        url: '/addToCart/' + id,
        success: function (response) {
            const toastLive = document.getElementById('toastAddToCartSuccess')
            const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLive)
            toastBootstrap.show()
        },
        error: function (response) {
            const toastLive = document.getElementById('toastAddToCartFailed')
            const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLive)
            toastBootstrap.show()
        }
    })
}

function DeleteFromCart(id) {
    $.ajax({
        type: "GET",
        url: '/onActionProduct/' + id + '/delete',
        success: function (response) {
            $('#data-body').empty()
            $('#data-body').append(response)
        }
    })
}

function IncreaseFromCart(id) {
    $.ajax({
        type: "GET",
        url: '/onActionProduct/' + id + '/increase',
        success: function (response) {
            $('#data-body').empty()
            $('#data-body').append(response)
        }
    })
}

function DecreaseFromCart(id) {
    $.ajax({
        type: "GET",
        url: '/onActionProduct/' + id + '/decrease',
        success: function (response) {
            $('#data-body').empty()
            $('#data-body').append(response)
        }
    })
}