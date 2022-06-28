<?php
    $modalId    = $modalId ?? "modal-confirm-delete";
    $btnIdDel   = $btnIdDel ?? "btn-delete-object";
    $headerId   = $headerId ?? "header-confirm";
    $contentId  = $contentId ?? "content-confirm";
?>

<div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="modalEdit"  aria-modal="true" role="dialog" data-backdrop="static" style="z-index: 9999 !important;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $headerId }}">Delete User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>


            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="t-left" id="{{ $contentId }}"></div>
                    </div>
                </div>
            </div>

            <div class="modal-footer text-center">
                <button type="button" id="{{ $btnIdDel }}" data-id="-1" class="btn btn-danger btn-delete-record btn-act-lg"><i  class="far fa-trash-alt"></i> <span >{{ __('Delete') }}</span></button>
                <button type="button" class="btn btn-secondary btn-act-lg" data-dismiss="modal"><i  class="fas fa-times " aria-hidden="true"></i> <span >{{ __('Cancel') }}</span></button>

            </div>

        </div>
    </div>
</div>