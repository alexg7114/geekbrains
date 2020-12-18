$(document).ready(function () {
    $('.js-status').change(function () {
        var id = $(this).data('id');
        var status = $(this).val();

        $(this).attr('disabled', true);
        var pthis = this;
        $.ajax({
            url: '/admin/status?id='+id+'&status='+status,
            success: function () {
                $(pthis).attr('disabled', false);
            },
        });
    });
});