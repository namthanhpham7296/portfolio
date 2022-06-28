<?php
    $ele_page = $page;
    if($page == "accessMenu"){$ele_page = "access_menu";}

?>

<div class="flex-row-fluid ml-lg-8">
    <!--begin::Row-->
    <div class="row">
        <div class="col-lg-12">
            @include("Admin.Elements.User.Profile.".$ele_page)
        </div>
    </div>
    <!--end::Row-->

</div>
