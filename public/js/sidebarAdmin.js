document.addEventListener('DOMContentLoaded', function() {
    // Lấy id của phần tử content
    var contentElement = document.querySelector('.content');
    var contentId = contentElement.querySelector('[id]').id;
    // Lấy tất cả các liên kết trong thanh bên
    var sidebarLinks = document.querySelectorAll('.sidebar a');
    // Lặp qua từng liên kết
    sidebarLinks.forEach(function(link) {
        // Lấy id của liên kết
        var linkId = link.getAttribute('id');
        // Kiểm tra xem id của phần tử content có trùng với id của liên kết không
        if (contentId === linkId) {
            // Thêm lớp "active" vào liên kết
            link.classList.add('active');
        }
    });
});
