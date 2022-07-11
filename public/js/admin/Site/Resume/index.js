
$(document).ready(function(){
    var columns = [
        {
            class: "td-no-wrap reorder text-center", orderable: true, name: "ordinal", defaultContent: "",
            data: function (row, type, set, meta) {
                return '<i class="fas fa-bars"></i>';
            }
        },
        {
            class: " text-center", orderable: true, name: "ordinal", defaultContent: "",
            data: "ordinal"
        },
        {
            class: "td-no-wrap", orderable: true, name: "title", defaultContent: "",
            data: "title"
        },
        {
            class: "td-no-wrap", orderable: true, name: "subtitle", defaultContent: "",
            data: "subtitle"
        },
        {
            class: "td-no-wrap", orderable: true, name: "photo", defaultContent: "",
            data: function(row, type, set, meta){
                var photoPath = APP.ApiUrl("public/uploads/"+SYSTEM_CONSTANT.COMPANY_ID+"/Resumes/" + row.id + "/Photo/" + row.photo);
                if(row.photo != "" && row.photo != null){
                    return '<img class="thumbnail-site" src="'+photoPath+'">';
                }
                return '';
            }
        },
        {
            class: "td-wrap", orderable: true, name: "content", defaultContent: "",
            data: "content"
        },
        {
            class: "td-no-wrap", orderable: true, name: "from", defaultContent: "",
            data: "from"
        },
        {
            class: "td-no-wrap", orderable: true, name: "to", defaultContent: "",
            data: "to"
        },
        {
            class: "td-no-wrap text-center", orderable: false, name: "show_page", defaultContent: "",
            data: function(row){
                var is_checked = row.show_homepage == "1" ? "checked" : "";
                return "<input type='checkbox' class='chk-public-resume' "+is_checked+">";
            }
        },
        {
            class: "td-no-wrap text-center", orderable: false, name: "status", defaultContent: "",
            data: function(row){
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
                html += '<a href="#" class="btn btn-sm btn-round btn-primary btn-edit-resume  tooltips mr-1" title="' + TRANSLATED_LABELS.lblEdit + '"><i class="fas fa-pencil"></i></a>';
                html += '<a class="btn btn-sm btn-round btn-danger btn-delete-resume tooltips" title="' + TRANSLATED_LABELS.lblDelete + '"><i class="far fa-trash-alt"></i></a>';

                return html;
            }
        }
    ];
    searchTableResume = $('#searchTableResume').createDataTable({
        paging: true,
        searching: false,
        processing: false,
        deferLoading: 0,
        serverSide: true,
        rowReorder:{
            dataSrc: "ordinal"
        },
        order:[
            [0, 'desc']
        ],
        ajax: {
            url: APP.ApiUrl('admin/siteResume/search'),
            type: "POST",
            data: function(d){
                d._token = _token;
                return d;
            }
        },
        columns: columns
    }, true);

    $(document).on("click", ".btn-refresh", function (e) {
        searchTableResume.ajax.reload();
    });

    searchTableResume.on('row-reordered', function ( e, diff, edit) {
        var postData = [], rowData = '', i;
        for ( i = 0; i < diff.length; i++) {
            rowData = searchTableResume.row( diff[i].node ).data();
            postData.push({
                'id': rowData['id'],
                'new_seq': diff[i].newData
            });
        }
        postOrderResume(postData);
    });

    $(document).on('click', '.btn-add-resume', function(e){
        $("#modalEditResume").find('h5').text(titleAdd);
        formatDataResume();
        reInitFileInput($("#photo"), [], []);
        $('.chk-continue').removeClass('hide');
        $(".selectpicker").selectpicker("refresh");
        $("#modalEditResume").modal('show');
    });


    $(document).on('click', '.btn-edit-resume', function(e){
        $("#modalEditResume").find('h5').text(titleEdit);
        var data = getRowDataMaster(this, searchTableResume);
        $("input[name='id']").val(data.id);
        $("input[name='title']").val(data.title);
        $("input[name='subtitle']").val(data.subtitle);
        $("input[name='links']").val(data.links);
        $("input[name='from']").val(formatDate2Type(data.from, "DMY"));
        $("input[name='to']").val(data.to);
        $("textarea[name='content']").val(data.content);
        $("select[name='position']").val(data.position);
        if(data.show_homepage == parseInt("1")){
            $("input[name='show_homepage']").prop('checked', true);
        }else{
            $("input[name='show_homepage']").prop('checked', false);
        }
        if(data.status == parseInt("1")){
            $("input[name='status']").prop('checked', true);
        }else{
            $("input[name='status']").prop('checked', false);
        }
        if(data.photo != "" && data.photo != null) {
            var pathFile = APP.ApiUrl("public/uploads/"+SYSTEM_CONSTANT.COMPANY_ID+"/Resumes/" + data.id + "/Photo/" + data.photo);
            var listPathFile = [pathFile];

            var initialPreviewConfig = [
                {"caption": data.icon, "downloadUrl": pathFile, "key": 0}
            ];

            reInitFileInput($("#photo"), listPathFile, initialPreviewConfig);
        } else {
            reInitFileInput($("#photo"));
        }

        $("input[name='continue']").prop('checked', false);
        $('.chk-continue').addClass('hide');
        $(".selectpicker").selectpicker("refresh");
        showModal("#modalEditResume");
    });

    $(document).on("change", ".chk-public-resume", function () {
        var data = getRowDataMaster(this, searchTableResume);
        $.loadingStart();
        $.ajax({
            url: APP.ApiUrl("admin/siteResume/changePublic"),
            dataType: "json",
            type: "POST",
            data: {
                id: data.id,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (resp) {
                var type_danger = "danger",
                    lbl_title = TRANSLATED_LABELS.lblError;
                if(resp.success) {
                    type_danger = "success";
                    lbl_title = TRANSLATED_LABELS.lblSuccess;
                }
                slideMessage(lbl_title, resp.message, type_danger);
                $.loadingEnd();
                searchTableResume.ajax.reload();
            }
        });
    });

    $(document).on('click', '.btn-delete', function(e){
        e.preventDefault();
        $("#modalDeleteResumeId").find("h5").text(TRANSLATED_LABELS.lblHeaderDelete);
        $("#modalDeleteResumeId").find("#content-confirm").text(TRANSLATED_LABELS.lblConfirmDelete);
        var data = getRowDataMaster(this, searchTableResume);
        if(data){
            $("#btnDeleteResumeId").attr('data-id', data.id);
        }
        $("#modalDeleteResumeId").modal('show');
    });

    $(document).on('click', "#btnDeleteResumeId", function (e){
        var id = $(this).attr('data-id');
        deleteData(id);
    });
    saveDataResume();
});

function renderStatus(status){
    if(status == '1'){
        return '<span class="badge badge-success">'+TRANSLATED_LABELS.lblActive+'</span>';
    }else{
        return '<span class="badge badge-danger">'+TRANSLATED_LABELS.lblActive+'</span>';
    }
}


function saveDataResume(){
    $("form#form-data-resume").submit(function(e){
        e.preventDefault();
        var formData = new FormData(this);
        formData.append('_token', $("meta[name='csrf-token']").attr('content'));
        $.loadingStart();
        $.ajax({
            url: APP.ApiUrl('admin/siteResume/saveData'),
            type: "POST",
            data: formData,
            success: function(resp){
                var responseData = $.parseJSON(resp);
                $.loadingEnd();
                if(responseData.success){
                    if(responseData.is_continue){
                        formatDataResume();
                        reInitFileInput($("#photo"), [], []);
                        $("input[name='continue']").prop("checked", true);
                    }else{
                        $("#modalEditResume").modal('hide');
                    }
                    $(".selectpicker").selectpicker("refresh");
                    searchTableResume.ajax.reload();
                    slideMessage(TRANSLATED_LABELS.lblSuccess, responseData.message, 'success');
                }else{
                    slideMessage(TRANSLATED_LABELS.lblError, responseData.message, 'danger');
                }
            },
            cache: false,
            contentType: false,
            processData: false
        },false);
    })
}

function postOrderResume(postData) {
    $.loadingStart();
    ajax({
        url: APP.ApiUrl('admin/siteResume/rowReorder'),
        type:"POST",
        dataType: "json",
        data:
            {
                seqs: JSON.stringify(postData)
            },
        success: function(resp) {
            $.loadingEnd();
            if(resp.success) {
                slideMessage(TRANSLATED_LABELS.lblSuccess,resp.message,"success");
                searchTableResume.ajax.reload();
            } else {
                slideMessage(TRANSLATED_LABELS.lblError,resp.message,"danger");
            }
        }
    }, true, false)
}

function deleteData(id) {
    $.loadingStart();
    ajax({
        url: APP.ApiUrl('admin/siteResume/delete'),
        type:"POST",
        dataType: "json",
        data:
            {
                id: id,
                token: _token
            },
        success: function(resp) {
            $.loadingEnd();
            var type = "success",
                title = TRANSLATED_LABELS.lblDeleteSuccess;
            if(!resp.success) {
                type = "danger";
                title = TRANSLATED_LABELS.lblDeleteError;
            }
            slideMessage(title, resp.message, type);
            hideModal("#modalDeleteResumeId");
            searchTableResume.ajax.reload();
        }
    }, true, false)
}
function formatDataResume(){
    $("form#form-data-resume")[0].reset();
    $("input[name='show_homepage']").prop('checked', false);
    $("input[name='continue']").prop('checked', false);
    $("input[name='status']").prop('checked', true);
}
