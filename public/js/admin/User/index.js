var searchTable;

$(document).ready(function () {

    var column = [{
        class: "text-center w-100px",
        name: "id",
        orderable: false,
        data: function (row, type, set, meta) {
            return searchTable.page.info().page * searchTable.page.info().length + 1 + meta.row;
        }
    },
        {
            class: "td-no-wrap text-center",
            orderable: true,
            name: "code",
            defaultContent: "",
            data: "code"
        },
        {
            class: "td-no-wrap",
            orderable: true,
            name: "name",
            defaultContent: "",
            data: "name"
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
            name: "phone",
            defaultContent: "",
            data: "phone"
        },{
            class: "td-no-wrap",
            orderable: true,
            name: "contact_email",
            defaultContent: "",
            data: "contact_email"
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
                var profileUrl = APP.ApiUrl('admin/user/profile/general/'+row.id);
                var html = '';
                html += '<a href="'+profileUrl+'" class="btn btn-sm btn-round btn-primary  tooltips mr-1" title="' + TRANSLATED_LABELS.lblProfile + '"><i class="fas fa-address-card"></i></a>';
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
            url: APP.ApiUrl('admin/user/search'),
            type: "post",
            data: function (d) {
                d._token = _token;
                d.is_admin = is_admin;
                return d;
            }
        },
        columns: column
    }, true);


    $(document).on("click", ".btn-add", function (e) {
        $(".continue-add").removeClass("hide");
        $("form#form-data")[0].reset();
        $("#modalEdit").find("h5").text(titleAdd);

        $("select[name='company_id']").val(0);
        $('.combobox-search').selectpicker('refresh');



        $(".chk-continue").removeClass("hide");
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

    $(document).on("change", "#company_id", function (e) {
        company_id = $(this).val();
        loadStore();
    });

    $(document).on("click", ".user-type-selected", function (e) {
        is_admin = $(this).attr("data-type");
        searchTable.ajax.reload();
    });

    $(document).on('click', '.btn-export', function(e) {
        e.preventDefault();
        var buttonDownload = $("#btn-download-file");
        $('#header-waiting').text("Xử Lý Dữ Liệu Báo Cáo");
        $('#content-waiting').text("Vui lòng đợi trong khi hệ thống xuất báo cáo...");
        $('#modal-waiting').modal('show');
        buttonDownload.addClass('hide');

        var valueSearch = $("form#searchBox").find('input.form-control').val();
        $.ajax({
            url: APP.ApiUrl('admin/user/export'),
            type: 'POST',
            data: {q: valueSearch},
            success: function (data) {
                var response = $.parseJSON(data);
                $.loadingEnd();
                if (response.success) {
                    slideMessage("Thành công", response.alert, 'success');
                    buttonDownload.removeClass('hide');
                    buttonDownload.attr('href', response.file);
                    buttonDownload.attr('download', response.filename);
                    $('#content-waiting').text("Xử lý dữ liệu hoàn tất, nhấn nút Tải xuống để tải file báo cáo.");
                }else{
                    slideMessage("Lỗi", response.alert, 'danger');
                }
            },
            cache: false,
            //contentType: false,
            //processData: false
        });
    });

    showPassword();
    saveData();
});

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
            url: APP.ApiUrl('admin/user/saveData'),
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

function showPassword(){
    $(document).on('click', '.show-password', function() {
        var isShow = $(this).attr('data-show');
        var input = $(this).siblings('input');

        if(parseInt(isShow)){
            $(this).attr('data-show', 0);
            $(this).find('i').addClass('fa-eye-slash').removeClass('fa-eye');
            input.attr('type', 'password');
        }else{
            $(this).attr('data-show', 1);
            $(this).find('i').addClass('fa-eye').removeClass('fa-eye-slash');
            input.attr('type', 'text');
        }
    });
}

function deleteData(id) {
    ajax({
        url: APP.ApiUrl("admin/user/delete"),
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