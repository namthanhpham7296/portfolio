<?php
$search_id      = $search_id ?? "searchBox";
$search_table   = $search_table ?? "#searchTable";
$placeholder    = $placeholder ?? trans('Từ khóa...');
?>

<form role="form" method="POST" data-table="{{$search_table}}" id="{{$search_id}}">
    <div class="form-body">
        <div class="form-group">
            <div class="input-group">
                <input type="text" class="form-control search-input border-no-radius-right" placeholder="{{ $placeholder }}">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-primary border-radius-right btn-search" type="button"><i class="far fa-search"></i> {{ __("Search") }}</button>
                        </span>
            </div>
            <!-- /input-group -->
        </div>
    </div>
</form>

<script>
    $("#" + "{{$search_id}}" + " .btn-search").on("click", function(e){
        e.preventDefault();
        var selector = $("#" + "{{$search_id}}").attr("data-table");
        var table = $(selector).DataTable();
        var value = $("#" + "{{$search_id}}").find(".search-input").val();
        table.search(value);
        table.ajax.reload();
    });

</script>
