<?php
use App\Constant;
$id                     = $company['id'] ?? -1;
$fullName               = $company['full_name'] ?? '';
$birthday               = \App\Helpers\BaseService::formatDate($company['birthday'], Constant::DMY) ?? '';
$name                   = $company['name'] ?? '';
$phone_number           = $company['phone_number'] ?? '';
$introduction           = $company['introduction'] ?? '';
$email                  = $company['email'] ?? '';
$address                = $company['address'] ?? '';
$logo                   = $company['logo'] ?? '';
$photo                  = $company['photo'] ?? '';
$favicon                = $company['favicon'] ?? '';
$whatsapp_phone_number  = $company['whatsapp_phone_number'] ?? '';
$zalo_phone_number      = $company['zalo_phone_number'] ?? '';
$copyright              = $company['copyright'] ?? '';
$description            = $company['description'] ?? '';
$working_hour           = $company['working_hour'] ?? '';
$keywords               = $company['keywords'] ?? '';
$logo_path              = empty($logo) ? $current_domain.'/images/no_img.jpg' :
    $current_domain.'/uploads/'.$id.'/Logo/'.$logo.'?t='.Constant::SYSTEM_CACHE;

$favicon_path      = empty($favicon) ? $current_domain.'/images/no_img.jpg' :
    $current_domain.'/uploads/'.$id.'/Favicon/'.$favicon.'?t='.Constant::SYSTEM_CACHE;

$status         = isset($company['status']) && $company['status'] ? 'checked' : '';

$photo_path              = empty($photo) ? $current_domain.'/images/no_img.jpg' :
    $current_domain.'/uploads/'.$id.'/Photo/'.$photo.'?t='.Constant::SYSTEM_CACHE;
?>

<div class="card card-custom">
    <div class="card-header">
        <h3 class="card-title">
            {{__("General Information")}}
        </h3>
        <div class="card-toolbar">

        </div>
    </div>
    <!--begin::Form-->
    <form id="form-general" method="post" enctype="multipart/form-data">
        <div class="card-body">

            <input type="text" class="form-control " name="id" hidden>
            <div class="form-group">
                <label>{{ __("Name") }}<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name" value="{{ $name }}" placeholder="{{ __("Enter company name") }}">
            </div>
            <div class="form-group">
                <label>{{ __("Photo") }}</label>
                @include("Elements.file_input_upload", [
                    'domId'         => 'photo',
                    'nameHtml'      => 'photo',
                    'multiple'      => 1,
                    'browseOnZone'  => 1,
                    'maxFile'       => 1,
                    'filePath'      => $photo_path,
                ])
            </div>
            <div class="form-group">
                <label>{{ __("Full Name") }}<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="full_name" value="{{ $fullName }}" placeholder="{{ __("Enter full name") }}">
            </div>

            <div class="row">
                <div class="col-md-6 pr-5px">
                    <div class="form-group">
                        <label>{{ __("Logo") }}</label>
                        @include("Elements.file_input_upload", [
                            'domId'         => 'logo',
                            'nameHtml'      => 'logo',
                            'multiple'      => 1,
                            'browseOnZone'  => 1,
                            'maxFile'       => 1,
                            'filePath'      => $logo_path,
                        ])
                    </div>
                </div>
                <div class="col-md-6 pl-5px">
                    <div class="form-group">
                        <label>{{ __("Favicon") }}</label>
                        @include("Elements.file_input_upload", [
                            'domId'         => 'favicon',
                            'nameHtml'      => 'favicon',
                            'multiple'      => 1,
                            'browseOnZone'  => 1,
                            'maxFile'       => 1,
                            'filePath'      => $favicon_path,
                        ])
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>{{ __("Phone") }}<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="phone_number" value="{{ $phone_number }}" placeholder="{{ __("Enter phone") }}">
            </div>
            <div class="input-group">
                <input type="text" id="birthday" class="form-control txt-datepicker border-no-radius-right"  placeholder="{{ date("d/m/Y") }}"  name="birthday" value="{{  $birthday }}">
                <div class="input-group-append" data-input="#birthday">
                                <span class="input-group-text">
                                           <i class="fas fa-calendar-alt"></i>
                                </span>
                </div>
            </div>
            <div class="form-group">
                <label>{{ __("Email") }}<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="email" value="{{ $email }}" placeholder="{{ __("Enter email") }}">
            </div>
            <div class="form-group">
                <label>{{ __("Description") }}</label>
                <textarea type="text" class="form-control" name="description" placeholder="{{ __("Description") }}">{{ $description }}</textarea>
            </div>
            <div class="form-group">
                <label>{{ __("Introduction") }}</label>
                <textarea type="text" class="form-control" name="introduction" cols="5" rows="4" placeholder="{{ __("Introduction") }}">{{ $introduction }}</textarea>
            </div>
            <div class="form-group">
                <label>{{ __("Address") }}</label>
                <textarea type="text" class="form-control" name="address" placeholder="{{ __("Address") }}">{{ $address }}</textarea>
            </div>


            <div class="form-group">
                <label>{{ __("Zalo phone number") }}</label>
                <input type="text" class="form-control" name="zalo_phone_number" value="{{ $zalo_phone_number }}" placeholder="{{ __("Enter zalo phone number") }}">
            </div>

            <div class="form-group">
                <label>{{ __("What's app phone number") }}</label>
                <input type="text" class="form-control" name="whatsapp_phone_number" value="{{ $whatsapp_phone_number }}" placeholder="{{ __("Enter whatsapp phone number") }}">
            </div>

            <div class="form-group">
                <label>{{ __("Working hour") }}</label>
                <input type="text" class="form-control" name="working_hour" value="{{ $working_hour }}" placeholder="{{ __("Enter working hour") }}">
            </div>

            <div class="form-group">
                <label>{{ __("Keywords") }}</label>
                <textarea type="text" id="keywords" class="form-control tagify-editor" rows="4" name="keywords"  placeholder="{{ __("Enter keywords") }}">{{ $keywords }}</textarea>
            </div>

            <div class="form-group">
                <label>{{ __("Copyright") }}</label>
                <input type="text" class="form-control" name="copyright" value="{{ $copyright }}" placeholder="{{ __("Enter copyright") }}">
            </div>
        </div>
        <div class="card-footer text-center">
            <button type="submit" class="btn btn-primary mr-2 btn-act-lg"><i class="fa fa-save"></i> {{ __("Save changes") }}</button>
            <button type="reset" class="btn btn-secondary  btn-act-lg"><i class="fa fa-sync"></i> {{ __("Refresh") }}</button>
        </div>
    </form>
    <!--end::Form-->
</div>


<script>
    $(document).ready(function (e){
        var input = document.querySelector('textarea[id="keywords"]'),
            // init Tagify script on the above inputs
            tagify = new Tagify(input, {
                whitelist: [
                    "VNYC",
                    "Yacht",
                    "yacht Vietnam",
                ],
                maxTags: 40,
                dropdown: {
                    maxItems: 20,           // <- mixumum allowed rendered suggestions
                    classname: "tagify-editor", // <- custom classname for this dropdown, so it could be targeted
                    enabled: 0,             // <- show suggestions on focus
                    closeOnSelect: false    // <- do not hide the suggestions dropdown once an item has been selected
                }
            })
    });
</script>
