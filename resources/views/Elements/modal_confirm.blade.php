<?php
    $modalId        = isset($modalId) ? $modalId : "modalConfirm";
    $btnId          = isset($btnId) ? $btnId : "btn-confirm";
    $labelConfirm   = isset($labelConfirm) ? $labelConfirm : "Confirm";
    $clsButton      = isset($clsButton) ? $clsButton : "btn-primary";
    $clsIcon        = isset($clsIcon) ? $clsIcon : "fas fa-check";

?>

<div class="modal  fade" id="{{ $modalId }}" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="header-confirm">XXXXXXXXXXXXXX</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="t-left" id="content-confirm"></div>
            </div>
            <div class="modal-footer text-center">
                <button type="button" id="{{ $btnId }}" data-id="-1" class="btn btn-danger btn-act-lg"><i  class="{{ $clsIcon }}"></i> <span >{{ __('Confirm') }}</span></button>
                <button type="button" class="btn btn-secondary btn-act-lg" data-dismiss="modal"><i  class="fas fa-times " aria-hidden="true"></i> <span >{{ __('Cancel') }}</span></button>

            </div>
        </div>
    </div>
</div>


