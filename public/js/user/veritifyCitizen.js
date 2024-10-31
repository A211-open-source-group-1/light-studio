let api_key = "SYe4cuLbzfvZW4iEBSlZWg51HFTwRrH2";
// UsEA0pVkPG4vUNZTEaopbsjjQdINjwzU
// xtGfasUmgcFqtOxsk2imP9gkkPRyzJyb
// MInu2QYAUyZDHpsJ4wGMj0YjLJtMAEg4

$(document).ready(function(){
    $("#input-file").change(function(e) {
        for (var i = 0; i < e.originalEvent.srcElement.files.length; i++) {
            var file = e.originalEvent.srcElement.files[i]
    
            var img = $('#uploaded-img')
            var reader = new FileReader()
            reader.onloadend = function() {
                 img.attr('src', reader.result)
            }
            reader.readAsDataURL(file);
            
        }
        $("#uploaded-section").removeClass('d-none')
    });

    $('#submit').on("click", function(){
        var formData = new FormData();
        var imageFile = $('#input-file')[0].files[0];
        if (!imageFile) {
            alert('Vui lòng chọn ảnh!')
            return;
        }
        formData.append("image", imageFile);
        formData.append("face", 1);
        $('#loading').removeClass('d-none')
        $.ajax({
            url: "https://api.fpt.ai/vision/idr/vnm",
            type: "POST",
            data: formData,
            processData: false, // Prevent jQuery from processing the data
            contentType: false, // Prevent jQuery from setting the content type
            headers: {
                'api_key': api_key
            },
            success: function(data, status){
                // alert("Data: " + JSON.stringify(data) + "\nStatus: " + status);
                console.log(data)
                var rd = data.data[0]
                $('#info').empty()
                $('#info').append('<p>MÃ CCCD: ' + '<span class="fw-bold" name="citizen_id">' + rd.id + '</span>' + '</p>')
                $('#info').append('<p>HỌ VÀ TÊN: ' + '<span class="fw-bold" name="citizen_name">' + rd.name + '</span>' + '</p>')
                $('#info').append('<p>NGÀY THÁNG NĂM SINH: ' + '<span class="fw-bold" name="citizen_date_of_birth">' + rd.dob + '</br>' + '</p>')
                $('#info').append('<p>GIỚI TÍNH: ' + '<span class="fw-bold" name="sex">' + rd.sex + '</span>' + '</p>')
                $('#info').append('<p>QUỐC TỊCH: ' + '<span class="fw-bold" name="citizen_ship">' + rd.nationality + '</br>' + '</p>')
                $('#info').append('<p>QUÊ QUÁN: ' + '<span class="fw-bold">' + rd.home + '</span>' + '</p>')
                $('#info').append('<p>Đ/C THƯỜNG TRÚ: ' + '<span class="fw-bold">' + rd.address + '</span>' + '</p>')
                $('#info').append('<p>NGÀY HẾT HẠN: ' + '<span class="fw-bold" name="citizen_card_date">' + rd.doe + '</span>' + '</p>')
                $('#info').append('<p>HÌNH ẢNH KHUÔN MẶT: </p>')
                $('#info').append('<img width="155" height="187" alt="" src="data:image/png;base64,' + rd.face_base64 + '"><br>')
                $('#info').append('<a class="btn btn-primary m-3" id="verified" >Xác thực</a><a class="btn btn-danger" href="/">Hủy</a>')
                $('#loading').addClass('d-none')
            },
            error: function(xhr, status, error){
                alert('Ảnh không đủ tiêu chuẩn nhận diện (Mờ, thiếu góc, thiếu thông tin, không phải CCCD Việt Nam,...)')
            }
        });
    });
        $(document).on('click', '#verified', function(){
            var citizen_id = $('[name="citizen_id"]').text()
            var citizen_name = $('[name="citizen_name"]').text()
            var citizen_date_of_birth = $('[name="citizen_date_of_birth"]').text()  
            var citizen_card_date = $('[name="citizen_card_date"]').text()
            var citizen_ship = $('[name="citizen_ship"]').text()
            var citizen_sex= $('[name="sex"]').text()
            alert('hehe');
            $.ajax({
                url: '/verifyCitizenCard',
                data: { citizen_id: citizen_id,
                    citizen_name: citizen_name, 
                    citizen_date_of_birth: citizen_date_of_birth, 
                    citizen_card_date: citizen_card_date, 
                     citizen_citizenship: citizen_ship,
                     citizen_sex : citizen_sex
                    },
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if(response.isVerify)
                    {
                        alert('Thanh cong');
                        setTimeout(function(){ 
                            window.location.href = '/';
                        },2000 );
                    }
                    else{
                        alert(response.message);
                    }
               
                }
            })
        });
        
});
