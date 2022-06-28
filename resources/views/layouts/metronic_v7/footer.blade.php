<?php
$copyright              = $company['copyright'] ?? "";
$copyright              = str_replace('#YYYY#', date("Y"), $copyright);

?>
<div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
    <!--begin::Container-->
    <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
        <!--begin::Copyright-->
        <div class="text-dark text-center full-width">
            {{ $copyright }}
        </div>
        <!--end::Copyright-->

    </div>
    <!--end::Container-->
</div>
