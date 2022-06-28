<div class="modal fade" id="modalEditResume" tabindex="-1" aria-labelledby="modalEditResume"  aria-modal="true" role="dialog" data-backdrop="static">
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
                        <form id="form-data-resume" method="post" enctype="multipart/form-data">
                            <input type="text" class="form-control hide" name="id">
                            <div class="form-group">
                                <label class="required-cls">{{ __("Title") }}</label>
                                <input type="text" class="form-control" name="title" placeholder="{{ __("Enter title") }}" required>
                            </div>

                            <div class="form-group">
                                <label class="required-cls">{{ __("Subtitle") }}</label>
                                <input type="text" class="form-control" name="subtitle" placeholder="{{ __("Enter subtitle") }}" required>
                            </div>

                            <div class="form-group">
                                <label>{{ __("Links") }}</label>
                                <input type="text" class="form-control" name="links" placeholder="{{ __("Enter links") }}" >
                            </div>
                            <div class="form-group">
                                <label>{{ __("Position") }}</label>
                                <select name="position" id="position" class="form-control selectpicker">
                                    @foreach(\App\Constant::LIST_POSITION_FOR_RESUMES as $position)
                                        <option value="{{$position['id']}}">{{$position['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>{{ __("Photo") }}</label>
                                @include("Elements.file_input_upload", [
                                    'domId'         => 'photo',
                                    'nameHtml'      => 'photo',
                                    'multiple'      => 0,
                                    'browseOnZone'  => 1,
                                    'maxFile'       => 1,
                                ])
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="required-cls">{{ __("From") }}</label>
                                        <div class="input-group">
                                            <input type="text" id="from" class="form-control txt-datepicker border-no-radius-right"  placeholder="{{ date("d/m/Y") }}"  name="from" value="{{  date("d/m/Y") }}">
                                            <div class="input-group-append" data-input="#from">
                                <span class="input-group-text">
                                           <i class="fas fa-calendar-alt"></i>
                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="required-cls">{{ __("To") }}</label>
                                        <div class="input-group">
                                            <input type="text" id="to" class="form-control txt-datepicker border-no-radius-right"  placeholder="{{ date("d/m/Y") }}"  name="to" value="{{  date("d/m/Y") }}">
                                            <div class="input-group-append" data-input="#to">
                                <span class="input-group-text">
                                           <i class="fas fa-calendar-alt"></i>
                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="required-cls">{{ __("Content") }}</label>
                                <textarea type="text" class="form-control" name="content" placeholder="{{ __("Enter content") }}" required></textarea>
                            </div>

                            <div class="form-group">
                                <label>{{ __("More options") }}</label>
                                <div class="checkbox-list">

                                    <label class="checkbox">
                                        <input type="checkbox" checked="checked" name="show_homepage">
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
