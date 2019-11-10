$(function () {
    // datepicker
    $('.datepicker').datetimepicker({
        timepicker: false,
        format: 'Y-m-d'
    });
    // datetimepicker
    $('.datetimepicker').datetimepicker({
        format: 'Y-m-d H:i:s'
    });

    // tooltip
    $('[data-toggle="tooltip"]').tooltip();

    // image preview
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('.preview').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    $("[type='file']").change(function() {
        readURL(this);
    });

    // confirm
    $('.confirm').on('click', function (e) {
        if (!confirm('Are You Sure?')) {
            e.preventDefault();
        }
    })
    // form-confirm
    $('.form-confirm').on('submit', function (e) {
        if (!confirm('Are You Sure?')) {
            e.preventDefault();
        }
    })
});