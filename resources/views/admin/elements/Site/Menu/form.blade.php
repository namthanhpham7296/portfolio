<div class="modal fade" id="modalEditMenu" tabindex="-1" aria-labelledby="modalEditMenu"  aria-modal="true" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>


            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form id="form-data" method="post" enctype="multipart/form-data">
                            <input type="text" class="form-control hide" name="id">
                            <div class="form-group">
                                <label class="required-cls">{{ __("Name") }}</label>
                                <input type="text" class="form-control" name="name" placeholder="{{ __("Enter name") }}" required>
                            </div>

                            <div class="form-group">
                                <label class="required-cls">{{ __("Url") }}</label>
                                <input type="text" class="form-control" name="url" placeholder="{{ __("Enter url") }}" required>
                            </div>

                            <div class="form-group">
                                <label>{{ __("More options") }}</label>
                                <div class="checkbox-list">

                                    <label class="checkbox">
                                        <input type="checkbox" checked="checked" name="is_redirect">
                                        <span></span> {{ __("Redirect") }}
                                    </label>

                                    <label class="checkbox">
                                        <input type="checkbox" checked="checked" name="is_public">
                                        <span></span> {{ __("Public") }}
                                    </label>

                                    <label class="checkbox">
                                        <input type="checkbox" checked="checked" name="status">
                                        <span></span> {{ __("Active") }}
                                    </label>

                                    <label class="checkbox chk-continue">
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
