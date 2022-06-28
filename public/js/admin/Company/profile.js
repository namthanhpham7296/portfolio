$( document ).ready(function() {

    updateGeneralInfo();
    updateSocial();
    updateMailerSetting();
    updateSNSSetting("#form-sns-google-seo");
    updateSNSSetting("#form-sns-facebook");
    showPassword();
    sendTestMail();


});


/**
 * Tab General Info
 */
function updateGeneralInfo(){
    $("form#form-general").submit(function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.loadingStart();
        $.ajax({
            url: APP.ApiUrl('admin/company/saveGeneral'),
            type: 'POST',
            data: formData,
            success: function (data) {
                var response = $.parseJSON(data);
                $.loadingEnd();
                if (response.success) {
                    slideMessage(TRANSLATED_LABELS.lblSuccess, response.message, 'success');
                    setTimeout(function () {
                        window.location.href = APP.ApiUrl('admin/company/profile');
                    }, 1000);

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

/**
 * SNS Setting
 */
function updateSNSSetting(formId){
    $(formId).submit(function(e) {

        var formData = new FormData(this);
        e.preventDefault();
        $.loadingStart();
        $.ajax({
            url: APP.ApiUrl('admin/company/updateSNSSetting'),
            type: 'POST',
            data: formData,
            success: function (data) {
                var response = $.parseJSON(data);
                $.loadingEnd();
                if (response.success) {
                    slideMessage(TRANSLATED_LABELS.lblSuccess, response.message, 'success');

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

function updateSocial(){
    $("form#form-social").submit(function(e) {

        var formData = new FormData(this);
        e.preventDefault();
        $.loadingStart();
        $.ajax({
            url: APP.ApiUrl('admin/company/updateSocial'),
            type: 'POST',
            data: formData,
            success: function (data) {
                var response = $.parseJSON(data);
                $.loadingEnd();
                if (response.success) {
                    slideMessage(TRANSLATED_LABELS.lblSuccess, response.message, 'success');
                    
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

function updateMailerSetting(){
    $("form#form-mailer-setting").submit(function(e) {

        var formData = new FormData(this);
        e.preventDefault();
        $.loadingStart();
        $.ajax({
            url: APP.ApiUrl('admin/company/updateMailerSetting'),
            type: 'POST',
            data: formData,
            success: function (data) {
                var response = $.parseJSON(data);
                $.loadingEnd();
                if (response.success) {
                    slideMessage(TRANSLATED_LABELS.lblSuccess, response.message, 'success');
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

function updatePaymentSetting(paymentForm){
    $(paymentForm).submit(function(e) {

        var formData = new FormData(this);
        e.preventDefault();
        $.loadingStart();
        $.ajax({
            url: APP.ApiUrl('admin/company/updatePaymentSetting'),
            type: 'POST',
            data: formData,
            success: function (data) {
                var response = $.parseJSON(data);
                $.loadingEnd();
                if (response.success) {
                    slideMessage(TRANSLATED_LABELS.lblSuccess, response.message, 'success');
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

function showPassword(){
    $(document).on('click', '#mailer-show-password', function() {
        var input = $(this).attr('data-input');
        var isShow = $(this).attr('data-show');
        var type = parseInt(isShow) == 1 ? 'password' : 'text';
        $('#'+input).attr('type', type);
        var newShow = parseInt(isShow) == 1 ? 0 : 1;
        var clsIcon = newShow == 1 ? iconEye : iconEyeSlash;
        $(this).attr('data-show', newShow);

        $(this).html(clsIcon);



    });
}

function sendTestMail(){

    $(document).on('click', '#send-test-mail', function() {
        var email = $('#test-mail').val(),
            url = APP.ApiUrl('admin/company/sendTestMail'),
            dataPost = {email: email}
            ;
        $.loadingStart();
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: dataPost,
            success: function(response) {
                $.loadingEnd();
                if (response.success) {
                    slideMessage(TRANSLATED_LABELS.lblSuccess, response.message, 'success');
                }else{
                    slideMessage(TRANSLATED_LABELS.lblError, response.message, 'danger');
                }
            }
        });
    });
}

