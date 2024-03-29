function AddToCart(id) {
    $.ajax({
        type: "GET",
        url: '/addToCart/' + id,
        success: function (response) {
            const toastLive = document.getElementById('toastAddToCartSuccess')
            const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLive)
            toastBootstrap.show()
        },
        error: function(response) {
            const toastLive = document.getElementById('toastAddToCartFailed')
            const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLive)
            toastBootstrap.show()
        }
    })
}

function DeleteFromCart(id) {

}

function IncreaseFromCart(id) {

}

function DecreaseFromCart(id) {
    
}