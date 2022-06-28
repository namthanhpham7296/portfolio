$( document ).ready(function() {

    updateGeneralInfo();
    changePassword();
    saveAccessMenu();

    $(document).on("change", "#company_id", function (e) {
        company_id = $(this).val();
        loadStore();
    });

});


function updateGeneralInfo(){
    $("form#form-general").submit(function(e) {

        var formData = new FormData(this);
        e.preventDefault();
        $.loadingStart();
        $.ajax({
            url: APP.ApiUrl('admin/user/saveGeneral'),
            type: 'POST',
            data: formData,
            success: function (data) {
                var response = $.parseJSON(data);
                $.loadingEnd();
                if (response.success) {
                    slideMessage(TRANSLATED_LABELS.lblSuccess, response.message, 'success');
                    setTimeout(function () {
                        window.location.href = APP.ApiUrl('admin/user/profile/general/'+response.id);
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


function changePassword(){
    $("form#form-password").submit(function(e) {

        var formData = new FormData(this);
        e.preventDefault();
        $.loadingStart();
        $.ajax({
            url: APP.ApiUrl('admin/user/changePassword'),
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

function saveAccessMenu(){

    $(document).on("click", ".btn-save-access-menu", function (e) {
        e.preventDefault();
        var listTree = $("#tree-menu");
        var functions_access = [];

        listTree.each(function(index) {
            functions_access = functions_access.concat($(this).jstree("get_bottom_selected"));

        });

        $.loadingStart();
        $.ajax({
            url: APP.ApiUrl('admin/user/saveAccessMenu'),
            type: 'POST',
            data: {
                id: user_id,
                functions_access: functions_access,
            },
            success: function (data) {
                var response = $.parseJSON(data);
                $.loadingEnd();
                if (response.success) {
                    slideMessage(TRANSLATED_LABELS.lblSuccess, response.message, 'success');
                }else{
                    slideMessage(TRANSLATED_LABELS.lblError, response.message, 'danger');
                }
            },
            cache: false
        });
    });
}

function loadStore() {

    $.loadingStart();
    $.ajax({
        url: APP.ApiUrl('admin/user/loadStore'),
        type: 'POST',
        data: {
            _token: _token,
            company_id: company_id,
        },
        success: function (data) {
            var response = $.parseJSON(data);
            $.loadingEnd();

            if (response.success) {
                $("#store-area").html(response.contentHtml);
                $('.combobox-search').selectpicker('refresh');
            }else{
                slideMessage(TRANSLATED_LABELS.lblError, response.message, 'danger');
            }
        },
        cache: false
    });
}