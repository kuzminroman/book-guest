$(document).ready(function () {
    $('#nameGuest').keyup(function () {
        $('#addRecord').prop('disabled', false);
    });

    $("#addRecord").click(function () {
            if ($('#nameGuest').val() === '') {
                alert('Введите имя');
                $('#addRecord').prop('disabled', true);
            } else {
                addRecord('result', 'form-book');
            }

            return false;
        }
    );

    function addRecord(result_form, ajax_form) {
        var form = $("." + ajax_form);
        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            dataType: "html",
            data: form.serialize(),

            success: function (response) {
                var emptyBlock = $('.center-block');

                if (emptyBlock.is(':visible')) {
                    emptyBlock.remove();
                }

                $(".result").load("/Main/Show .result > *");
                form[0].reset();
            },
        });
    }
});