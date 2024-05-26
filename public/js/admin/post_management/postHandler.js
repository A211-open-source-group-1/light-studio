$(document).ready(function () {
    $(document).on('click', '#newPostBtn', function () {
        $('#content').summernote({
            placeholder: 'Type here...',
            tabsize: 2,
            height: 350,
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
            ]
        });

        $('#thumbnail_holder').empty();

        $('#thumbnail_holder').append('<div class="col-3 p-1 position-relative">' +
            '<img id="thumbnail_img" src="/image/' + 'no_image.png' + '" class="h-100 w-100 border rounded" style="z-index: 1001">' +
            '<label for="thumbnail">' +
            '<button class="btn position-absolute top-0 end-0 rounded-circle bg-dark mb-3 change-thumbnail-btn" style="z-index: 998" type="button"><i class="fa-solid fa-rotate text-light"></i></button>' +
            '<input type="file" class="form-control d-none" id="thumbnail" name="thumbnail">' +
            '</label>' +
            '</div>'
        )
    })

    $(document).on('change', '#thumbnail', function () {
        if ($(this).prop('files') && $(this).prop('files')[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#thumbnail_img').attr('src', e.target.result);
            };
            reader.readAsDataURL($(this).prop('files')[0]);
        }
    })

    $(document).on('change', '#new_thumbnail', function () {
        if ($(this).prop('files') && $(this).prop('files')[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#new_thumbnail_img').attr('src', e.target.result);
            };
            reader.readAsDataURL($(this).prop('files')[0]);
        }
    })

    $(document).on('click', '.delete-post-btn', function() {
        var post_id = $(this).data('post-id');
        $('#post_id').val(post_id);
    })

    $(document).on('click', '#confirmDelete', function() {
        $.ajax({
            url: '/management/deletepost',
            type: 'POST',
            data: $('#deletePostForm').serialize(),
            success: function() {
                location.reload();
            }
        })
    })

    $(document).on('click', '.edit-post-btn', function () {
        var post_id = $(this).data('post-id');
        $('#title').val('');
        $('#edit_content').val('');
        $('#id').val('');
        $('#edit_thumbnail_holder').empty();
        $('#edit_content').summernote({
            placeholder: 'Type here...',
            tabsize: 2,
            height: 350,
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
            ]
        });

        $.ajax({
            url: '/management/getpost/' + post_id,
            type: 'GET',
            success: function (response) {
                $('#edit_thumbnail_holder').append('<div class="col-3 p-1 position-relative">' +
                    '<img id="new_thumbnail_img" src="/image/' + response.thumbnail + '" class="h-100 w-100 border rounded" style="z-index: 1001">' +
                    '<label for="new_thumbnail">' +
                    '<button class="btn position-absolute top-0 end-0 rounded-circle bg-dark mb-3 change-thumbnail-btn" style="z-index: 998" type="button" data-thumbnail-type="insert"><i class="fa-solid fa-rotate text-light"></i></button>' +
                    '<input type="file" class="form-control d-none" id="new_thumbnail" name="thumbnail">' +
                    '</label>' +
                    '</div>'
                )
                $('#id').val(response.id);
                $('#title').val(response.title);
                $('#edit_content').summernote('code', response.content);
            }
        })
    })
})