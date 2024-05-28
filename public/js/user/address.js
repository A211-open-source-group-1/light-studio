$(document).ready(function () {
    $('#province').select2({
        dropdownParent: '#registerModal .modal-content',
        placeholder: 'Tìm kiếm tỉnh/thành phố',
        width: '100%'
    });
    $('#district').select2({
        dropdownParent: '#registerModal .modal-content',
        placeholder: 'Tìm kiếm huyện/thành phố/thị xã',
        width: '100%'
    });
    $('#ward').select2({
        dropdownParent: '#registerModal .modal-content',
        placeholder: 'Tìm kiếm phường/xã',
        width: '100%'
    });

    _getProvinces();

    function _getProvinces() {
        $('#province').empty();
        $('#province').append('<option></option>');
        $.ajax({
            url: '/getAllProvinces',
            type: 'GET',
            success: function (response) {
                for (const key in response) {
                    $('#province').append('<option value="' + key + '">' + response[key].name + '</option>');
                }
            }
        })
    }

    function _getDistrict(id) {
        $('#district').empty();
        $('#district').append('<option></option>');
        $.ajax({
            url: '/getDistricts/' + id,
            type: 'GET',
            success: function (response) {
                for (const key in response) {
                    $('#district').append('<option value="' + key + '">' + response[key].name + '</option>');
                }
            }
        })
    }

    function _getWard(id) {
        $('#ward').empty();
        $('#ward').append('<option></option>');
        $('#province').append('<option></option>');
        $.ajax({
            url: '/getWards/' + id,
            type: 'GET',
            success: function (response) {
                for (const key in response) {
                    $('#ward').append('<option value="' + key + '">' + response[key].name + '</option>');
                }
            }
        })
    }

    $(document).on('change', '#province', function () {
        _getDistrict(this.value);
        $('#ward').empty();
    })

    $(document).on('change', '#district', function () {
        _getWard(this.value);
    })

})