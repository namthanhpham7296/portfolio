<?php
    $functionsAccess    = isset($data['functions_access']) ? $data['functions_access'] : '';
    $moduleId           = isset($data['id']) ? $data['id'] : '';
    $roleAccessId       = isset($data['role_access_id']) ? $data['role_access_id'] : '';
    $functions          = isset($data['functions']) ? $data['functions'] : [];
    $arrFunctionsAccess = explode(',', $functionsAccess);
?>

<div class="form-body">
    <div id="tree-role-<?php echo $moduleId?>"></div>
    <input name="functions_access[{{ $moduleId }}]" id="function-list-<?php echo $moduleId?>" class="hidden">
</div>



<script>
    var tree_date = <?php echo json_encode($functions)?>;
    $(document).ready(function(){
        $('#tree-role-<?php echo $moduleId?>').jstree({
            plugins: ["checkbox"],
            core: {
                data: <?php echo json_encode($functions)?>,
                themes: {
                    icons: false
                }
            },
            checkbox: {
                "keep_selected_style": false
            }
        }).on('ready.jstree', function() {
            $('#tree-role-<?php echo $moduleId?>').jstree("open_all");
            $("#tree-role-<?php echo $moduleId?>").jstree().select_node(<?php echo json_encode($arrFunctionsAccess)?>);
        }).bind('changed.jstree', function (event, data) {
            $("#function-list-<?php echo $moduleId?>").val($('#tree-role-<?php echo $moduleId?>').jstree("get_bottom_selected").toString());
        });
    });
</script>
