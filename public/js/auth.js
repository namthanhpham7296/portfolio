$( document ).ready(function() {
    registerAccount();
    doLogin();
});


function registerAccount(){
    $("form#form-registration").submit(function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.loadingStart();
        $.ajax({
            url: APP.ApiUrl('saveRegistration'),
            type: 'POST',
            data: formData,
            success: function (data) {
                var response = $.parseJSON(data);
                $.loadingEnd();
                grecaptcha.reset();
                if (response.success) {
                    slideMessage(TRANSLATED_LABELS.lblSuccess, response.message, 'success');
                    setTimeout(function () {
                        window.location.href = response.url;
                    }, 300);

                }else{
                    slideMessage(TRANSLATED_LABELS.lblError, response.message, 'danger');
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
}


function doLogin(){
    $("form#form-login").submit(function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.loadingStart();
        $.ajax({
            url: APP.ApiUrl('doLogin'),
            type: 'POST',
            data: formData,
            success: function (data) {
                var response = $.parseJSON(data);
                $.loadingEnd();

                if(!response.turn_off_recaptcha){
                    grecaptcha.reset();
                }

                if (response.success) {
                    slideMessage(TRANSLATED_LABELS.lblSuccess, response.message, 'success');
                    $("form#form-login")[0].reset();
                    setTimeout(function () {
                        window.location.href = response.url;
                    }, 300);

                }else{
                    slideMessage(TRANSLATED_LABELS.lblError, response.message, 'danger');
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
}