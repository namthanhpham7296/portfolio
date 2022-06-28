<div class="modal fade" id="modalImport" tabindex="-1" aria-labelledby="modalEdit"  aria-modal="true" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">{{ __("Import Data") }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form id="form-data-import" method="post" enctype="multipart/form-data">
                            <input class="hide" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label class="control-label"><?php echo __("File")?> (<span class="input-require text-danger">*</span>):</label>
                                @include('Elements.file_input_upload', [
                                    'showUpload'    => false,
                                    'accept'      => \App\Constant::ACCEPTED_EXCEL,
                                    'domId'         => 'file',
                                    'browseLabel'   => __("Browse"),
                                    'multiple'      => 0,
                                    'browseOnZone'  => 1,
                                    'maxFile'       => 1,
                                    'caption'       => '',
                                    'deletePath'    => ''
                                ])

                            </div>


                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-primary font-weight-bold btn-act-lg"><i class="fas fa-upload"></i> {{ __("Import") }}</button>
                                <button type="button" class="btn btn-default font-weight-bold btn-act-lg" data-dismiss="modal"><i class="fas fa-times"></i> {{ __("Close") }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>

<script>

</script>