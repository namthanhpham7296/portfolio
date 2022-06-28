<?php
$modalId        = $modalId ?? "modal-waiting";
$headerWaiting  = $headerConfirm ?? "header-waiting";
$contentWaiting = $contentConfirm ?? "content-waiting";
$displayBottom  = isset($displayBottom) && !$displayBottom  ? "hide" : "";
?>
<div class="modal fade" id="<?php echo $modalId;?>" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title text-normal text-bold t-left" id="<?php echo $headerWaiting?>"><?php echo '';?></h4>
            </div>
            <div class="modal-body text-normal">
                <div class="t-left" id="<?php echo $contentWaiting;?>">
                    <?php  echo ''; ?>
                </div>
            </div>
            <div class="modal-footer {{ $displayBottom }}" style="text-align: center !important;">
                <a role="button"  id="btn-download-file"
                   class="btn btn-primary hide btn-act-gird btn-same-width btn-smooth " >
                    <i class="far fa-arrow-to-bottom"></i> <span ><?php echo __('Tải Xuống');?></span></a>
                <button type="button" id="btn-delete-no" class="btn default btn-same-width btn-act-gird btn-smooth" data-dismiss="modal">
                    <i  class="fas fa-times" aria-hidden="true"></i> <span ><?php echo __('Đóng');?></span></button>
            </div>
        </div>

    </div>
    <!-- /.modal-dialog -->
</div>

