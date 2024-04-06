function deleteUser(id)
{
    $.ajax({
        type : "GET",
        url: '/onActionUser/'+id+'/detele',
        success: function(response)
        {
            $('$data-body').empty()
            $('$data-body').append(response)
        }
    })
}