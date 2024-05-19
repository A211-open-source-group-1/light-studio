$(document).ready(function() {
    $('#nad-province').select2({
        placeholder: 'Tìm kiếm tỉnh/thành phố',
        width: '100%'
    });
    $('#nad-district').select2({
        placeholder: 'Tìm kiếm huyện/thành phố/thị xã',
        width: '100%'
    });
    $('#nad-ward').select2({
        placeholder: 'Tìm kiếm phường/xã',
        width: '100%'
    });

    _getProvinces();

    function _getProvinces() {
        $('#nad-province').empty();
        $('#nad-province').append('<option></option>');
        $.ajax({
            url: '/getAllProvinces',
            type: 'GET',
            success: function(response) {
                for (const key in response) {
                    $('#nad-province').append('<option value="' + key + '">' + response[key].name + '</option>');
                }
            }
        })
    }
    
    function _getDistrict(id) {
        $('#nad-district').empty();
        $('#nad-district').append('<option></option>');
        $.ajax({
            url: '/getDistricts/' + id,
            type: 'GET',
            success: function(response) {
                for (const key in response) {
                    $('#nad-district').append('<option value="' + key + '">' + response[key].name + '</option>');
                }
            }
        })
    }

    function _getWard(id) {
        $('#nad-ward').empty();
        $('#nad-ward').append('<option></option>');
        $('#nad-province').append('<option></option>');
        $.ajax({
            url: '/getWards/' + id,
            type: 'GET',
            success: function(response) {
                for (const key in response) {
                    $('#nad-ward').append('<option value="' + key + '">' + response[key].name + '</option>');
                }
            }
        })
    }

    $(document).on('change', '#nad-province', function() {
        _getDistrict(this.value);
        $('#nad-ward').empty();
    })

    $(document).on('change', '#nad-district', function() {
        _getWard(this.value);
    })

})