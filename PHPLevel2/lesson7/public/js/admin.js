$(document).ready(function () {
    $('.js-status').change(function () {
        var id = $(this).data('id');
        var status = $(this).val();

        var select = $(this);
        select.attr('disabled', true);
        $.ajax({
            url: '/admin/status?id=' + id + '&status=' + status,
            success: function () {
                select.attr('disabled', false);
            }
        });
    });
});