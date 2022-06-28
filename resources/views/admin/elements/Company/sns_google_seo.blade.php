<?php

$id = isset($setting->id) ? $setting->id : -1;
$seo_page_title             = isset($setting->seo_page_title) ? $setting->seo_page_title : '';
$seo_page_description       = isset($setting->seo_page_description) ? $setting->seo_page_description : '';
$seo_page_keywords          = isset($setting->seo_page_keywords) ? $setting->seo_page_keywords : '';
$google_analytics_key       = isset($setting->google_analytics_key) ? $setting->google_analytics_key : '';
$api_jwt_secret             = isset($setting->api_jwt_secret) ? $setting->api_jwt_secret : '';
$google_map_api_key         = isset($setting->google_map_api_key) ? $setting->google_map_api_key : '';
$google_recaptcha_api_key   = isset($setting->google_recaptcha_api_key) ? $setting->google_recaptcha_api_key : '';
$google_recaptcha_api_secret_key = isset($setting->google_recaptcha_api_secret_key) ? $setting->google_recaptcha_api_secret_key : '';
$google_api_url             = isset($setting->google_api_url) ? $setting->google_api_url : '';
$firebase_api_key           = isset($setting->firebase_api_key) ? $setting->firebase_api_key : '';
$firebase_auth_domain       = isset($setting->firebase_auth_domain) ? $setting->firebase_auth_domain : '';
$firebase_db_url            = isset($setting->firebase_db_url) ? $setting->firebase_db_url : '';
$firebase_project_id        = isset($setting->firebase_project_id) ? $setting->firebase_project_id : '';
$firebase_store_bucket      = isset($setting->firebase_store_bucket) ? $setting->firebase_store_bucket : '';
$firebase_sender_id         = isset($setting->firebase_sender_id) ? $setting->firebase_sender_id : '';
$firebase_app_id            = isset($setting->firebase_app_id) ? $setting->firebase_app_id : '';
$firebase_measurement_id    = isset($setting->firebase_measurement_id) ? $setting->firebase_measurement_id : '';
$mobile_sdk_app_id          = isset($setting->mobile_sdk_app_id) ? $setting->mobile_sdk_app_id : '';
$server_key                 = isset($setting->server_key) ? $setting->server_key : '';

?>
<form method="post" id="form-sns-google-seo" enctype="multipart/form-data">

    <input type="text" class="form-control" placeholder="" name="id" value="{{ $id }}" hidden>

    <div class="card-body">

        <div class="form-group row">
            <label for="example-search-input" class="col-2 col-form-label ">{{ __("SEO page title") }}</label>
            <div class="col-10">
                <textarea type="text" class="form-control " placeholder="" name="seo_page_title">{{ $seo_page_title }}</textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="example-search-input" class="col-2 col-form-label ">{{ __("SEO Page Description") }}</label>
            <div class="col-10">
                <textarea type="text" class="form-control " placeholder="" name="seo_page_description">{{ $seo_page_description }}</textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="example-search-input" class="col-2 col-form-label ">{{ __("SEO Page Keywords") }}</label>
            <div class="col-10">
                <input type="text" class="form-control " placeholder="" name="seo_page_keywords" value="{{ $seo_page_keywords }}" />
            </div>
        </div>

        <div class="form-group row">
            <label for="example-search-input" class="col-2 col-form-label ">{{ __("Google Analytics Key") }}</label>
            <div class="col-10">
                <input type="text" class="form-control " placeholder="" name="google_analytics_key" value="{{ $google_analytics_key }}" />
            </div>
        </div>

        <div class="form-group row">
            <label for="example-search-input" class="col-2 col-form-label ">{{ __("Api JWT Secret") }}</label>
            <div class="col-10">
                <input type="text" class="form-control " placeholder="" name="" value="{{ $api_jwt_secret }}" />
            </div>
        </div>

        <div class="form-group row">
            <label for="example-search-input" class="col-2 col-form-label ">{{ __("Google Map Api Key") }}</label>
            <div class="col-10">
                <input type="text" class="form-control " placeholder="" name="google_map_api_key" value="{{ $google_map_api_key }}" />
            </div>
        </div>

        <div class="form-group row">
            <label for="example-search-input" class="col-2 col-form-label ">{{ __("Google reCaptcha Api Key") }}</label>
            <div class="col-10">
                <input type="text" class="form-control " placeholder="" name="google_recaptcha_api_key" value="{{ $google_recaptcha_api_key }}" />
            </div>
        </div>

        <div class="form-group row">
            <label for="example-search-input" class="col-2 col-form-label ">{{ __("Google reCaptcha Api Secret Key") }}</label>
            <div class="col-10">
                <input type="text" class="form-control " placeholder="" name="google_recaptcha_api_secret_key" value="{{ $google_recaptcha_api_secret_key }}" />
            </div>
        </div>

        <div class="form-group row">
            <label for="example-search-input" class="col-2 col-form-label ">{{ __("Google Api Url") }}</label>
            <div class="col-10">
                <input type="text" class="form-control " placeholder="" name="google_api_url" value="{{ $google_api_url }}" />
            </div>
        </div>

        <div class="form-group row">
            <label for="example-search-input" class="col-2 col-form-label ">{{ __("Firebase Api Key") }}</label>
            <div class="col-10">
                <input type="text" class="form-control " placeholder="" name="firebase_api_key" value="{{ $firebase_api_key }}" />
            </div>
        </div>

        <div class="form-group row">
            <label for="example-search-input" class="col-2 col-form-label ">{{ __("Firebase Auth Domain") }}</label>
            <div class="col-10">
                <input type="text" class="form-control " placeholder="" name="firebase_auth_domain" value="{{ $firebase_auth_domain }}" />
            </div>
        </div>

        <div class="form-group row">
            <label for="example-search-input" class="col-2 col-form-label ">{{ __("Firebase Db Url") }}</label>
            <div class="col-10">
                <input type="text" class="form-control " placeholder="" name="firebase_db_url" value="{{ $firebase_db_url }}" />
            </div>
        </div>

        <div class="form-group row">
            <label for="example-search-input" class="col-2 col-form-label ">{{ __("Firebase project ID") }}</label>
            <div class="col-10">
                <input type="text" class="form-control " placeholder="" name="firebase_project_id" value="{{ $firebase_project_id }}" />
            </div>
        </div>

        <div class="form-group row">
            <label for="example-search-input" class="col-2 col-form-label ">{{ __("Firebase Store Bucket") }}</label>
            <div class="col-10">
                <input type="text" class="form-control " placeholder="" name="firebase_store_bucket" value="{{ $firebase_store_bucket }}" />
            </div>
        </div>

        <div class="form-group row">
            <label for="example-search-input" class="col-2 col-form-label ">{{ __("Firebase Sender ID") }}</label>
            <div class="col-10">
                <input type="text" class="form-control " placeholder="" name="firebase_sender_id" value="{{ $firebase_sender_id }}" />
            </div>
        </div>

        <div class="form-group row">
            <label for="example-search-input" class="col-2 col-form-label ">{{ __("Firebase App ID") }}</label>
            <div class="col-10">
                <input type="text" class="form-control " placeholder="" name="firebase_app_id" value="{{ $firebase_app_id }}" />
            </div>
        </div>

        <div class="form-group row">
            <label for="example-search-input" class="col-2 col-form-label ">{{ __("Firebase Measurement Id") }}</label>
            <div class="col-10">
                <input type="text" class="form-control " placeholder="" name="firebase_measurement_id" value="{{ $firebase_measurement_id }}" />
            </div>
        </div>


        <div class="form-group row">
            <label for="example-search-input" class="col-2 col-form-label ">{{ __("Mobile SDK App ID") }}</label>
            <div class="col-10">
                <input type="text" class="form-control " placeholder="" name="mobile_sdk_app_id" value="{{ $mobile_sdk_app_id }}" />
            </div>
        </div>

        <div class="form-group row">
            <label for="example-search-input" class="col-2 col-form-label ">{{ __("Server Key") }}</label>
            <div class="col-10">
                <input type="text" class="form-control " placeholder="" name="server_key" value="{{ $server_key }}" />
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
