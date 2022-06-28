<?php
use Illuminate\Support\Facades\Auth;

$authUser           = Auth::user();
$id                 = isset($userInfo['id']) ? $userInfo['id'] : -1;
$email              = isset($userInfo['email']) ? $userInfo['email'] : '';
$functions_access   = isset($userInfo['functions_access']) ? $userInfo['functions_access'] : '';
$functions_menus    = $functions_menus ?? '';

?>

<div class="row">

    <div class="col-md-12">
        <div class="card card-custom">
            <!--begin::Header-->
            <div class="card-header py-3">
                <div class="card-title align-items-start flex-column">
                    <h3 class="card-label font-weight-bolder text-dark"><i class="fab fa-keycdn"></i> {{ __("Admin Portal") }}</h3>
                </div>
                <div class="card-toolbar">

                </div>
            </div>
            <!--end::Header-->
            <!--begin::Form-->
            <form class="form form-access-menu" method="post" id="form-access-menu">

                <div class="card-body">
                    <div id="tree-menu" class="tree-menu"></div>
                    <script>

                        $(function (e) {
                            initTreeMenu(<?php echo json_encode($functions_menus)?>, [<?php echo $functions_access;?>]);
                        });
                    </script>
                </div>
                <div class="card-footer text-center">
                    <a  role="button"
                        class="btn btn-primary mr-2 btn-act-lg btn-save-access-menu"

                    ><i class="fas fa-save"></i> {{ __("Save Changes") }}</a>
                    <button type="reset" class="btn btn-secondary btn-act-lg"><i class="fas fa-sync"></i> {{ __("Refresh") }}</button>
                </div>
            </form>
            <!--end::Form-->
        </div>
    </div>

</div>

<script>

    console.log(<?php echo json_encode($functions_menus);?>);

    function initTreeMenu(data, data_selected) {

        var domeId = "#tree-menu";
        var form = "#form-access-menu";

        $(domeId).jstree({
            plugins: ["types", "dnd", "checkbox"],
            core: {
                data: data,
                themes: {
                    "responsive": true
                }
            },
            checkbox: {
                "keep_selected_style": false
            },
            types : {
                "default" : {
                    "icon" : false
                }

            }
        }).on('ready.jstree', function() {

            $(domeId).jstree().select_node(data_selected);
            $(domeId).jstree("open_all");
        }).bind("select_node.jstree", function(event, data) {

        });
    }
</script>

