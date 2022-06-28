<div id="modalImport" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{__("Nhập dữ liệu")}}</h4>
            </div>
            <form class="" role="form" method="post" id="formImport" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-body">
                        <div class="form-group">
                            <input type="hidden" name="id" value="">
                            <label class="control-label"><?php echo __("Tập tin")?> (<span
                                    class="input-require text-danger">*</span>):</label>
                            @include('Elements.file_input_upload', [
                            'showUpload'    => false,
                            'accept'      => \App\Constant::ACCEPTED_EXCEL,
                            'domId'         => 'file',
                            'browseLabel'   => __("Duyệt"),
                            'multiple'      => 0,
                            'browseOnZone'  => 1,
                            'maxFile'       => 1,
                            'caption'       => '',
                            'deletePath'    => ''
                            ])
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <button type="submit" class="btn green btn-same-width btn-smooth"><i
                            class="fas fa-upload"></i> {{ __("Tải lên") }}</button>
                    <button type="button" data-dismiss="modal" class="btn default btn-same-width btn-smooth"><i
                            class="fas fa-times"></i> {{ __("Hủy bỏ") }}</button>
                </div>
            </form>
        </div>

    </div>
</div>
