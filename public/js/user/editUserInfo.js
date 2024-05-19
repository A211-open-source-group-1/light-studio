$(document).ready(function() {
    $('#user_province').select2({
        placeholder: 'Tìm kiếm tỉnh/thành phố',
        width: '100%'
    });
    $('#user_district').select2({
        placeholder: 'Tìm kiếm huyện/thành phố/thị xã',
        width: '100%'
    });
    $('#user_ward').select2({
        placeholder: 'Tìm kiếm phường/xã',
        width: '100%'
    });

    _getProvinces();
    _getDistrict($('#user_province').data('current-id'));
    _getWard($('#user_district').data('current-id'));

    function _getProvinces() {
        $('#user_province').empty();
        var current_id = $('#user_province').data('current-id');
        $.ajax({
            url: '/getAllProvinces',
            type: 'GET',
            success: function(response) {
                for (const key in response) {
                    $('#user_province').append('<option value="' + key + '" ' + (key == current_id ? 'selected' : '') + ' >' + response[key].name + '</option>');
                }
            }
        })
    }
    
    function _getDistrict(id) {
        $('#user_district').empty();
        var current_id = $('#user_district').data('current-id');
        $.ajax({
            url: '/getDistricts/' + id,
            type: 'GET',
            success: function(response) {
                for (const key in response) {
                    $('#user_district').append('<option value="' + key + '" ' + (key == current_id ? ' selected' : '') + ' >' + response[key].name + '</option>');
                }
            }
        })
    }

    function _getWard(id) {
        $('#user_ward').empty();
        var current_id = $('#user_ward').data('current-id');
        $.ajax({
            url: '/getWards/' + id,
            type: 'GET',
            success: function(response) {
                for (const key in response) {
                    $('#user_ward').append('<option value="' + key + '" ' + (key == current_id ? 'selected' : '') + ' >' + response[key].name + '</option>');
                }
            }
        })
    }

    $(document).on('change', '#user_province', function() {
        _getDistrict(this.value);
        $('#ward').empty();
    })

    $(document).on('change', '#user_district', function() {
        _getWard(this.value);
    })
})