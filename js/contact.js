(function ($) {
    'use strict';

    var form = $('.contact__form'),
        message = $('.contact__msg'),
        form_data;

    // Success function
    function done_func(response) {
        message.fadeIn().removeClass('alert-danger').addClass('alert-success');
        message.text(response);
        setTimeout(function () {
            message.fadeOut();
        }, 2000);
        form.find('input:not([type="submit"]), textarea').val('');
    }

    // fail function
    function fail_func(data) {
        message.fadeIn().removeClass('alert-success').addClass('alert-success');
        message.text(data.responseText);
        setTimeout(function () {
            message.fadeOut();
        }, 2000);
    }
    
    form.submit(function (e) {
        e.preventDefault();
        form_data = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: form_data
        })
        .done(done_func)
        .fail(fail_func);
    });
    
})(jQuery);



    document.addEventListener('DOMContentLoaded', function () {
        var buttons = document.querySelectorAll('[data-toggle="collapse"]');
        buttons.forEach(function (button) {
            button.addEventListener('click', function () {
                var icon = button.querySelector('.icofont-simple-right, .icofont-simple-down');
                if (icon) {
                    icon.classList.toggle('icofont-simple-right');
                    icon.classList.toggle('icofont-simple-down');
                }
            });
        });
    });
