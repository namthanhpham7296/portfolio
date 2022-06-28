<div class="modal fade" id="modalEditSkill" tabindex="-1" aria-labelledby="modalEditSkill"  aria-modal="true" role="dialog" data-backdrop="static">
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
                        <form id="form-data-skill" method="post" enctype="multipart/form-data">
                            <input type="text" class="form-control hide" name="id">
                            <div class="form-group">
                                <label class="required-cls">{{ __("Name") }}</label>
                                <input type="text" class="form-control" name="name" placeholder="{{ __("Enter name") }}" required>
                            </div>
                            <div class="form-group">
                                <label>{{ __("Rate") }}</label>
                                <div class="input-group">
                                    <input type="number" class="form-control input-number border-radius-input-before" min="0" max="100"  step="0.01" name="rate" placeholder="{{ __("Enter rate") }}" value="0">
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary" type="button">{{ __("%") }}</button>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>{{ __("More options") }}</label>
                                <div class="checkbox-list">

                                    <label class="checkbox">
                                        <input type="checkbox" checked="checked" name="is_public">
                                        <span></span> {{ __("Show Homepage") }}
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
