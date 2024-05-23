$(document).ready(function () {
    $(document).on('click', '.accept-review-btn', function () {
        var review_id = $(this).data('review-id');
        $('#a_review_id').val(review_id);
        alert(('#a_review_id').val());
    })

    $(document).on('click', '.decline-review-btn', function () {
        var review_id = $(this).data('review-id');
        $('#review_id').val(review_id);
        alert(('#review_id').val());
    })
})