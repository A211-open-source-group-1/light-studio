function check_numberPhone() {
    // Head number phone Viettel 
    var viettel = ['086', '096', '097', '039', '038', '037', '036', '035', '034', '033', '032'];

    // Head number phone Vinaphone
    var vinaphone = ['091', '094', '088', '083', '084', '085', '081', '082'];

    // Header number phone Mobifone
    var mobifone = ['070', '079', '077', '076', '078', '089', '090', '093'];

    //Head number phone Vietnamobile
    var vietnamobile = ['092', '052', '056', '058'];

    // Head number phone Gmobile
    var gmobile = ['099', '059'];

    // Head number Itelecom
    var itelecom = ['087'];

    // Concatenate all arrays into one
    var allPhoneNumbers = [].concat(viettel, vinaphone, mobifone, vietnamobile, gmobile, itelecom);
    document.getElementById("errorPhoneNumber").innerHTML = "";
    var phone_number = document.getElementById('phoneNumber').value;

    if (phone_number === "") {
        document.getElementById("errorPhoneNumber").innerHTML = "Không được bỏ trống số điện thoại";
        return false;
    }

    if (phone_number.length === 10) {
        var phonePrefix = phone_number.substring(0, 3);
        if (allPhoneNumbers.includes(phonePrefix)) {
            document.getElementById("errorPhoneNumber").innerHTML = "";

            return true;
        } else {

            // Invalid phone number
            document.getElementById("errorPhoneNumber").innerHTML = "Số điện thoại không hợp lệ";
            return false;
        }
    } else {

        // Invalid phone number length
        document.getElementById("errorPhoneNumber").innerHTML = "Yêu cầu nhập đúng 10 số";
        return false;

    }
}


function check_email() {
    var email = document.getElementById("email").value;
    document.getElementById("errorEmail").innerHTML = "";

    if (email === "") {
        document.getElementById("errorEmail").innerHTML = "Không được bỏ trống email";
        return false;
    }
    else {
        let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            document.getElementById("errorEmail").innerHTML = "Email của bạn không hợp lệ";
            return false;
        }
        else {
            return true;
        }
    }
}

function check_fullname() {
    let nameRegex = /^[^\W\d_]+$/;
    var fullname = document.getElementById('fullname').value;
    document.getElementById('errorFullname').innerHTML = "";
    if (fullname === "") {
        document.getElementById('errorFullname').innerHTML = "Không được bỏ trống tên";

        return false;
    }
    if (!nameRegex.test(fullname)) {
        document.getElementById('errorFullname').innerHTML = "Tên của bạn không đúng";

        return false;
    }
    else {

        return true;
    }

}
function check_password() {
    let passwordRegex = /^(?=.*[!@#$%^&*()])[A-Z].{9,}$/;

    var password = document.getElementById("password1").value;
    var repassword = document.getElementById('repassword').value;
    if (password === "") {
        document.getElementById('errorPassword').innerHTML = "Không được bỏ trống mật khẩu";
        return false;
    }

    if (!passwordRegex.test(password)) {
        document.getElementById('errorPassword').innerHTML = "Mật khẩu phải bắt đầu bằng một chữ cái viết hoa, có ít nhất 10 ký tự, và chứa ít nhất một trong các ký tự đặc biệt !@#$%^&*()";
        return false;
    }

    if (password !== repassword) {
        document.getElementById('errorPassword').innerHTML = "";
        document.getElementById('errorRepassword').innerHTML = "Mật khẩu xác thực không trùng khớp";
        return false;
    }

    document.getElementById('errorPassword').innerHTML = "";
    document.getElementById('errorRepassword').innerHTML = "";
    return true;
}


function handle_validate() {
    var isFormValid = true; // Biến này sẽ chỉ đến xem tất cả các điều kiện kiểm tra đã qua hay không

    if (!check_password()) {
        isFormValid = false;
    }

    // Kiểm tra số điện thoại
    if (!check_numberPhone()) {
        isFormValid = false;
    }

    // Kiểm tra email
    if (!check_email()) {
        isFormValid = false;
    }

    // Kiểm tra họ tên
    if (!check_fullname()) {
        isFormValid = false;
    }



    // Nếu tất cả các điều kiện kiểm tra đều đã qua, gửi biểu mẫu đi
    if (isFormValid) {
        document.getElementById('registerForm').submit();
    }
}


function check_Login() {
    var phone_number = document.getElementById('phone_number').value;
    var password = document.getElementById('password').value;
    var flag = true;
    if (phone_number.length == 0) {
        document.getElementById('errorPhoneNumberLogin').innerHTML = "Vui lòng nhập thông tin đăng nhập";
        flag = false;
    }
    if (password.length == 0) {
        document.getElementById('errorPasswordLogin').innerHTML = "Vui lòng nhập mật khẩu";
        flag = false;
    }

    if (flag === true) {
        document.getElementById('loginForm').submit();
    }

}