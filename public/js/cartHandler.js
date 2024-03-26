function AddToCart(id) {
    $.ajax({
        type: "POST",
        url: "{{route('addToCart')}}",
        data: {details_id: id},
        success: function() {
            alert('hehe');
        }
    })
}