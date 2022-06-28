
$(document).ready(function(){
    var columns = [
        {
            class: "td-no-wrap reorder text-center", orderable: true, name: "ordinal", defaultContent: "",
            data: function (row, type, set, meta) {
                return '<i class="fas fa-bars"></i>';
            }
        },
        {
            class: "text-left", orderable: true, name: "ordinal", defaultContent: "",
            data: "ordinal"
        },
        {
            class: "td-no-wrap", orderable: true, name: "name", defaultContent: "",
            data: "name"
        },
        {
            class: "td-no-wrap", orderable: true, name: "url", defaultContent: "",
            data: "url"
        },
        {
            class: "td-no-wrap text-center", orderable: false, name: "is_redirect", defaultContent: "",
            data: function(row){
                var is_checked = row.is_redirect == "1" ? "checked" : "";
                return "<input type='checkbox' class='chk-redirect' "+is_checked+">";
            }
        },
        {
            class: "td-no-wrap text-center", orderable: false, name: "is_public", defaultContent: "",
            data: function(row){
                var is_checked = row.is_public == "1" ? "checked" : "";
                return "<input type='checkbox' class='chk-public' "+is_checked+">";
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
                html += '<a href="#" class="btn btn-sm btn-round btn-primary btn-edit  tooltips mr-1" title="' + TRANSLATED_LABELS.lblEdit + '"><i class="fas fa-pencil"></i></a>';
                html += '<a class="btn btn-sm btn-round btn-danger btn-delete tooltips" title="' + TRANSLATED_LABELS.lblDelete + '"><i class="far fa-trash-alt"></i></a>';

                return html;
            }
        }
    ];
    searchTableMenu = $('#searchTableMenu').createDataTable({
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
            url: APP.ApiUrl('admin/siteMenu/search'),
            type: "POST",
            data: function(d){
                d._token = _token;
                return d;
            }
        },
        columns: columns
    }, true);

    $(document).on("click", ".btn-refresh", function (e) {
        searchTableMenu.ajax.reload();
    });

    searchTableMenu.on('row-reordered', function ( e, diff, edit) {
        var postData = [], rowData = '', i;
        for ( i = 0; i < diff.length; i++) {
            rowData = searchTableMenu.row( diff[i].node ).data();
            postData.push({
                'id': rowData['id'],
                'new_seq': diff[i].newData
            });
        }
        postOrder(postData);
    });

    $(document).on('click', '.btn-add', function(e){
        $("#modalEditMenu").find('h5').text(titleAdd);
        formatData();
        $('.chk-continue').removeClass('hide');
        $("#modalEditMenu").modal('show');
    });


    $(document).on('click', '.btn-edit', function(e){
        $("#modalEditMenu").find('h5').text(titleEdit);
        var data = getRowDataMaster(this, searchTableMenu);
        $("input[name='id']").val(data.id);
        $("input[name='name']").val(data.name);
        $("input[name='url']").val(data.url);
        if(data.is_redirect == parseInt("1")){
            $("input[name='is_redirect']").prop('checked', true);
        }else{
            $("input[name='is_redirect']").prop('checked', false);
        }
        if(data.is_public == parseInt("1")){
            $("input[name='is_public']").prop('checked', true);
        }else{
            $("input[name='is_public']").prop('checked', false);
        }
        if(data.status == parseInt("1")){
            $("input[name='status']").prop('checked', true);
        }else{
            $("input[name='status']").prop('checked', false);
        }
        $("input[name='continue']").prop('checked', false);
        $('.chk-continue').addClass('hide');
        $("#modalEditMenu").modal('show');
    });

    $(document).on("change", ".chk-redirect", function () {
        var data = getRowDataMaster(this, searchTableMenu);
        $.loadingStart();
        $.ajax({
            url: APP.ApiUrl("admin/siteMenu/changeRedirect"),
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
                searchTableMenu.ajax.reload();
            }
        });
    });

    $(document).on("change", ".chk-public", function () {
        var data = getRowDataMaster(this, searchTableMenu);
        $.loadingStart();
        $.ajax({
            url: APP.ApiUrl("admin/siteMenu/changePublic"),
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
                searchTableMenu.ajax.reload();
            }
        });
    });

    $(document).on('click', '.btn-delete', function(e){
        e.preventDefault();
        $("#modal-confirm-delete").find("h5").text(TRANSLATED_LABELS.lblHeaderDelete);
        $("#modal-confirm-delete").find("#content-confirm").text(TRANSLATED_LABELS.lblConfirmDelete);
        var data = getRowDataMaster(this, searchTableMenu);
        if(data){
            $("#btn-delete-object").attr('data-id', data.id);
        }
        $("#modal-confirm-delete").modal('show');
    });

    $(document).on('click', "#btn-delete-object", function (e){
        var id = $(this).attr('data-id');
        deleteData(id);
    });
    saveData();
});

function renderStatus(status){
    if(status == '1'){
        return '<span class="badge badge-success">'+TRANSLATED_LABELS.lblActive+'</span>';
    }else{
        return '<span class="badge badge-danger">'+TRANSLATED_LABELS.lblActive+'</span>';
    }
}


function saveData(){
    $("form#form-data").submit(function(e){
        e.preventDefault();
        var formData = new FormData(this);
        formData.append('_token', $("meta[name='csrf-token']").attr('content'));
        $.loadingStart();
        $.ajax({
            url: APP.ApiUrl('admin/siteMenu/saveData'),
            type: "POST",
            data: formData,
            success: function(resp){
                var responseData = $.parseJSON(resp);
                $.loadingEnd();
                if(responseData.success){
                    if(responseData.is_continue){
                        formatData();
                        $("input[name='continue']").prop("checked", true);
                    }else{
                        $("#modalEditMenu").modal('hide');
                    }
                    searchTableMenu.ajax.reload();
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

function postOrder(postData) {
    $.loadingStart();
    ajax({
        url: APP.ApiUrl('admin/siteMenu/rowReorder'),
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
                searchTableMenu.ajax.reload();
            } else {
                slideMessage(TRANSLATED_LABELS.lblError,resp.message,"danger");
            }
        }
    }, true, false)
}

function deleteData(id) {
    $.loadingStart();
    ajax({
        url: APP.ApiUrl('admin/siteMenu/delete'),
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
            hideModal("#modal-confirm-delete");
            searchTableMenu.ajax.reload();
        }
    }, true, false)
}
function formatData(){
    $("form#form-data")[0].reset();
    $("input[name='is_redirect']").prop('checked', false);
    $("input[name='is_public']").prop('checked', false);
    $("input[name='continue']").prop('checked', false);
    $("input[name='status']").prop('checked', true);
}
