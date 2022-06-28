$( document ).ready(function() {

    saveCustomerRequest();


});


function saveCustomerRequest(){
    $("form#form-customer-request").submit(function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.loadingStart();
        $.ajax({
            url: APP.ApiUrl('home/saveCustomerRequest'),
            type: 'POST',
            data: formData,
            success: function (data) {
                var response = $.parseJSON(data);
                $.loadingEnd();
                if (response.success) {
                    slideMessage(TRANSLATED_LABELS.lblSuccess, response.message, 'success');
                    setTimeout(function () {
                        $("form#form-customer-request")[0].reset();
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