<?php
$id = isset($setting->id) ? $setting->id : -1;
$facebook_pixel_code    = isset($setting->facebook_pixel_code) ? $setting->facebook_pixel_code : '';
$facebook_body_code     = isset($setting->facebook_body_code) ? $setting->facebook_body_code : '';
$facebook_title         = isset($setting->facebook_title) ? $setting->facebook_title : '';
$facebook_description   = isset($setting->facebook_description) ? $setting->facebook_description : '';
$facebook_thumbnail     = isset($setting->facebook_thumbnail) ? $setting->facebook_thumbnail : '';
?>
<form method="post" id="form-sns-facebook" enctype="multipart/form-data">

    <input type="text" class="form-control" placeholder="" name="id" value="{{ $id }}" hidden>

    <div class="card-body">

        <div class="form-group row">
            <label for="example-search-input" class="col-2 col-form-label required_label">{{ __("Pixel code") }}</label>
            <div class="col-10">
                <textarea type="text" class="form-control " placeholder="" name="facebook_pixel_code">{{ $facebook_pixel_code }}</textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="example-search-input" class="col-2 col-form-label required_label">{{ __("Body code") }}</label>
            <div class="col-10">
                <textarea type="text" class="form-control " placeholder="" name="facebook_body_code">{{ $facebook_body_code }}</textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="example-search-input" class="col-2 col-form-label required_label">{{ __("Title") }}</label>
            <div class="col-10">
                <input type="text" class="form-control " placeholder="" name="facebook_title" value="{{ $facebook_title }}" />
            </div>
        </div>

        <div class="form-group row">
            <label for="example-search-input" class="col-2 col-form-label required_label">{{ __("Description") }}</label>
            <div class="col-10">
                <textarea type="text" class="form-control " placeholder="" name="facebook_description">{{ $facebook_description }}</textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="example-search-input" class="col-2 col-form-label required_label">{{ __("Thumbnail url") }}</label>
            <div class="col-10">
                <input type="text" class="form-control " placeholder="" name="facebook_thumbnail" value="{{ $facebook_thumbnail }}" />
            </div>
        </div>

    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-2">
            </div>
            <div class="col-10 text-center">
                <button type="submit" class="btn btn-primary mr-2 btn-act-lg"><i class="far fa-save"></i> {{__("Save changes")}}</button>
                <button type="reset" class="btn btn-secondary btn-act-lg"><i class="far fa-sync"></i> {{__("Refresh")}}</button>
            </div>
        </div>
    </div>
</form>
