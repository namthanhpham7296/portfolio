var searchTable;

$(document).ready(function () {

    var column = [{
        class: "text-center",
        name: "id",
        orderable: false,
        data: function (row, type, set, meta) {
            return searchTable.page.info().page * searchTable.page.info().length + 1 + meta.row;
        }
    },
        {
            class: "td-no-wrap text-center",
            orderable: true,
            name: "logo",
            defaultContent: "",
            data: function (row, type, set, meta) {
                return renderLogo(row);
            }
        },
        {
            class: "td-no-wrap",
            orderable: true,
            name: "subject",
            defaultContent: "",
            data: "subject"
        },{
            class: "td-no-wrap",
            orderable: true,
            name: "phone_number",
            defaultContent: "",
            data: "phone_number"
        },{
            class: "td-no-wrap",
            orderable: true,
            name: "email",
            defaultContent: "",
            data: "email"
        },
        {
            class: "td-no-wrap",
            orderable: true,
            name: "address",
            defaultContent: "",
            data: "address"
        },
        {
            class: "text-center td-no-wrap",
            orderable: true,
            name: "status",
            defaultContent: "",
            data: function (row, type, set, meta) {
                return renderStatus(row.status);
            }
        },
        {
            class: "text-center td-no-wrap",
            orderable: false,
            name: "action",
            defaultContent: "",
            data: function (row, type, set, meta) {
                var html = '';
                var detail_url = APP.ApiUrl('admin/company/profile/general/'+row.id);
                html += '<a href="'+detail_url+'" class="btn btn-sm btn-round btn-primary btn-detail tooltips mr-1" title="' + TRANSLATED_LABELS.lblProfile + '"><i class="fas fa-list"></i></a>';

                if(row.id == 1){
                    return html;
                }

                html += '<a class="btn btn-sm btn-round btn-danger btn-delete tooltips" title="' + TRANSLATED_LABELS.lblDelete + '"><i class="far fa-trash-alt"></i></a>';

                return html;
            }
        }
    ];

    searchTable = $("#searchTable").createDataTable({
        paging: true,
        searching: false,
        order: [
            [0, "desc"]
        ],
        ajax: {
            url: APP.ApiUrl('admin/company/search'),
            type: "post"
        },
        columns: column
    }, true);


    $(document).on("click", ".btn-add", function (e) {
        $(".continue-add").removeClass("hide");
        $("form#form-data")[0].reset();
        $("#modalEdit").find("h5").text(titleAdd);


        $(".chk-continue").removeClass("hide");
        showModal('#modalEdit');
    });

    $(document).on("click", ".btn-edit", function(e){
        e.preventDefault();
        $(".continue-add").addClass("hide");
        $("#modalEdit").find("h5").text(titleEdit);
        $("input[name='status']").prop("checked", false);

        var data = getRowDataMaster(this,searchTable);

        $("input[name='id']").val(data.id);
        $("input[name='is_admin']").val(data.is_admin);
        $("input[name='name']").val(data.name);

        $("textarea[name='description']").val(data.description);

        if(data.status){
            $("input[name='status']").prop("checked", true);
        }

        $("input[name='continue']").prop("checked", false);
        $(".chk-continue").addClass("hide");
        showModal('#modalEdit');
    });

    $(document).on("click", ".btn-delete", function(e){
        e.preventDefault();
        $("#header-confirm").text(TRANSLATED_LABELS.lblHeaderDelete);
        $("#content-confirm").text(TRANSLATED_LABELS.lblConfirmDelete+'?');
        $("#modal-confirm-delete").modal("show");
        var data = getRowDataMaster(this, searchTable);
        if(data) {
            $("#btn-delete-object").attr("data-id", data.id);
        }
    });

    $(document).on("click", "#btn-delete-object", function (e) {
        var id = $(this).attr("data-id");
        deleteData(id);
    });

    saveData();
    savePrivacyPolicy();
    saveReturnPolicy();
    saveTerms();
});

function renderLogo(data) {

    var id = data.id;
    var logo = data.logo;
    var imgPath = "";

    if (logo == '' || logo == null) {
        imgPath = PUBLIC_PATH+'/images/no_img.png?t='+DEFAULT_TIME;
    }else{
        imgPath = PUBLIC_PATH+'/uploads/'+id+'/logo/'+logo+'?t='+DEFAULT_TIME;
    }

    return '<img class="gird-company-logo" src="'+imgPath+'">';
}

function renderStatus(status) {
    if (status == 0) {

        return '<span class="badge badge-danger">' + TRANSLATED_LABELS.lblLock + '</span>';

    }

    return '<span class="badge badge-success">' + TRANSLATED_LABELS.lblActive + '</span>';
}

function saveData() {

    $("form#form-data").submit(function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.loadingStart();
        $.ajax({
            url: APP.ApiUrl('admin/company/saveData'),
            type: 'POST',
            data: formData,
            success: function (data) {
                var response = $.parseJSON(data);
                $.loadingEnd();
                if (response.success) {
                    slideMessage(TRANSLATED_LABELS.lblSuccess, response.message, 'success');
                    // Reset form
                    $("form#form-data")[0].reset();
                    searchTable.ajax.reload();
                    if(response.is_continue == 0) {
                        hideModal('#modalEdit');
                    } else {
                        $("input[name='continue']").prop("checked", true);
                    }
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

function savePrivacyPolicy() {

    $("form#form-privacy-policy").submit(function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.loadingStart();
        $.ajax({
            url: APP.ApiUrl('admin/company/savePrivacyPolicy'),
            type: 'POST',
            data: formData,
            success: function (data) {
                var response = $.parseJSON(data);
                $.loadingEnd();
                if (response.success) {
                    slideMessage(TRANSLATED_LABELS.lblSuccess, response.message, 'success');
                    // Reset form

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

function saveReturnPolicy() {

    $("form#form-return-policy").submit(function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.loadingStart();
        $.ajax({
            url: APP.ApiUrl('admin/company/saveReturnPolicy'),
            type: 'POST',
            data: formData,
            success: function (data) {
                var response = $.parseJSON(data);
                $.loadingEnd();
                if (response.success) {
                    slideMessage(TRANSLATED_LABELS.lblSuccess, response.message, 'success');
                    // Reset form

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

function saveTerms() {

    $("form#form-terms").submit(function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.loadingStart();
        $.ajax({
            url: APP.ApiUrl('admin/company/saveTerms'),
            type: 'POST',
            data: formData,
            success: function (data) {
                var response = $.parseJSON(data);
                $.loadingEnd();
                if (response.success) {
                    slideMessage(TRANSLATED_LABELS.lblSuccess, response.message, 'success');
                    // Reset form

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

function deleteData(id) {
    ajax({
        url: APP.ApiUrl("admin/company/delete"),
        type: "POST",
        data: {
            id: id
        },
        success: function(resp){
            var type = "success",
                title = TRANSLATED_LABELS.lblDeleteSuccess;
            if(!resp.success) {
                type = "danger";
                title = TRANSLATED_LABELS.lblDeleteError;
            }
            slideMessage(title, resp.message, type);
            hideModal("#modal-confirm-delete");
            searchTable.ajax.reload();
        }
    }, true, false);
}

