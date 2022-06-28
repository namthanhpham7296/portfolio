<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEdit"  aria-modal="true" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">New User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>


                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form id="form-data" method="post" enctype="multipart/form-data">
                                <input type="text" class="form-control " name="id" hidden>
                                <div class="form-group">
                                    <label>{{ __("Subject") }}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="subject" placeholder="{{ __("Enter company name") }}">
                                </div>

                                <div class="form-group">
                                    <label>{{ __("Logo") }}</label>
                                    @include("Elements.file_input_upload", [
                                        'domId'         => 'logo',
                                        'nameHtml'      => 'logo',
                                        'multiple'      => 1,
                                        'browseOnZone'  => 1,
                                        'maxFile'       => 1,
                                    ])
                                </div>

                                <div class="form-group">
                                    <label>{{ __("Phone") }}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="phone_number" placeholder="{{ __("Enter phone") }}">
                                </div>

                                <div class="form-group">
                                    <label>{{ __("Email") }}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="email" placeholder="{{ __("Enter email") }}">
                                </div>

                                <div class="form-group">
                                    <label>{{ __("Address") }}</label>
                                    <textarea type="text" class="form-control" name="address" placeholder="{{ __("Address") }}"></textarea>
                                </div>

                                <div class="form-group">
                                    <label>{{ __("More options") }}</label>
                                    <div class="checkbox-list">

                                        <label class="checkbox">
                                            <input type="checkbox" checked="checked" name="status">
                                            <span></span> {{ __("Active") }}
                                        </label>

                                        <label class="checkbox">
                                            <input type="checkbox" name="continue">
                                            <span></span> {{ __("Continue add") }}
                                        </label>

                                    </div>
                                </div>
                                <div class="card-footer text-center">
                                    <button type="submit" class="btn btn-primary font-weight-bold btn-act-lg"><i class="fas fa-save"></i> {{ __("Save") }}</button>
                                    <button type="button" class="btn btn-default font-weight-bold btn-act-lg" data-dismiss="modal"><i class="fas fa-times"></i> {{ __("Close") }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>



        </div>
    </div>
</div>

