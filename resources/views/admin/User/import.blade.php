@extends("Admin.Layouts.default")
@section('title', $title)
@section("content")
    <div class="row">
        <div class="col-md-6 ">
            <!-- BEGIN SAMPLE FORM PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject font-dark sbold uppercase">{{ __("Nhập danh sách người dùng") }}</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default tooltips" target="_blank" title="<?php echo __("Tải mẫu")?>"
                           href="{{ url('samples/Admin/TemplateImportUser.xlsx') }}">
                            <i class="fal fa-file-excel"></i>
                        </a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form class="" role="form" method="post" id="form-data" enctype="multipart/form-data">



                        <div class="form-body">

                            <div class="form-group">
                                <label class="control-label"><?php echo __("Tập tin")?> (<span class="input-require text-danger">*</span>):</label>
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
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn green btn-same-width btn-smooth"><i class="fas fa-upload"></i> {{ __("Tải lên") }}</button>
                                    <button type="button" class="btn default btn-same-width btn-smooth"><i class="fas fa-times"></i> {{ __("Hủy bỏ") }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END SAMPLE FORM PORTLET-->

        </div>

    </div>

    <script>
        $(document).ready(function () {
            $("form#form-data").submit(function(e) {
                var formData = new FormData(this);
                e.preventDefault();
                $.loadingStart();
                $.ajax({
                    url: APP.ApiUrl('admin/user/saveImportData'),
                    type: 'POST',
                    data: formData,
                    success: function (data) {

                        var response = $.parseJSON(data);
                        $.loadingEnd();
                        if (response.success) {
                            slideMessage(TRANSLATED_LABELS.lblSuccess, response.message, 'success');
                            $("form#form-data")[0].reset();
                        }else{
                            slideMessage(TRANSLATED_LABELS.lblError, response.message, 'danger');
                        }
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            });
        });
    </script>

@endsection
