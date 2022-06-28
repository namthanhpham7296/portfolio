<?php

use App\Helpers\BaseService;
use Illuminate\Support\Facades\Auth;
use App\Constant;

$authUser = Auth::user();
$lang_key = $authUser->lang_key;
$date_format = $lang_key == 'vi' ? 'd/m/Y' : 'm/d/Y';

$id             = $userInfo['id'] ?? -1;
$code           = $userInfo['code'] ?? '';
$company_id     = $userInfo['company_id'] ?? -1;
$name           = $userInfo['name'] ?? '';
$phone          = $userInfo['phone'] ?? '';
$birthday       = isset($userInfo['birthday']) ? BaseService::formatDate( $userInfo['birthday'], $date_format) : '';
$lang_key       = $userInfo['lang_key'] ?? '';
$contact_email  = $userInfo['contact_email'] ?? '';
$position_id    = $userInfo['position_id'] ?? '';
$address        = $userInfo['address'] ?? '';
$avatar         = $userInfo['avatar'] ?? '';
$is_admin       = $userInfo['is_admin'] ?? '';
$lasted_login   = $userInfo['lasted_login'] ?? '';
$created_at     = $userInfo['created_at'] ?? '';

$avatar_path = empty($avatar) ? $current_domain.'/img/no_img.jpg' :
    $current_domain.'/uploads/'.$company_id.'/User/'.$id.'/Avatar/'.$avatar;

$status         = isset($userInfo['status']) && $userInfo['status'] ? 'checked' : '';

?>

<div class="card card-custom">
    <div class="card-header">
        <h3 class="card-title">
            {{__("General information")}}
        </h3>
        <div class="card-toolbar">

        </div>
    </div>
    <!--begin::Form-->
    <form id="form-general" method="post" enctype="multipart/form-data">
        <div class="card-body">

            <input type="text" class="form-control " name="id" value="{{ $id }}" hidden>


            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label>{{ __("Name") }}<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" value="{{ $name }}" placeholder="{{ __("Enter name") }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>{{ __("Code") }}<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="code" value="{{ $code }}" placeholder="{{ __("Enter code") }}" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>{{ __("Avatar") }}</label>
                @include("Elements.file_input_upload", [
                    'domId'         => 'avatar',
                    'nameHtml'      => 'avatar',
                    'multiple'      => 1,
                    'browseOnZone'  => 1,
                    'maxFile'       => 1,
                    'filePath'      => $avatar_path,
                ])
            </div>

            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label required-cls">{{ __("Company") }}</label>
                        @include("Elements.cbb", [
                            'domeHtml' 		=> 'company_id',
                            'nameHtml' 		=> 'company_id',
                            'displayField'  => 'name',
                            'valueField'  	=> 'id',
                            'isNone'  	    => Constant::STATUS_ACTIVE,
                            'id'  	        => $company_id,
                            'listData' 		=> $listCompany,
                        ])
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>{{ __("User Role") }}</label>
                        @include("Elements.cbb", [
                                'domeHtml' 		=> 'user_role_id',
                                'nameHtml' 		=> 'user_role_id',
                                'displayField'  => 'name',
                                'isNone'  	    => true,
                                'valueField'  	=> 'id',
                                'listData' 		=> $listUserRole,
                            ])

                    </div>
                </div>

            </div>

            <div class="row">


                <div class="col-md-4">
                    <div class="form-group">
                        <label>{{ __("Phone") }}</label>
                        <input type="text" class="form-control" name="phone" value="{{ $phone }}" placeholder="{{ __("Enter phone") }}">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="">{{ __("Birthday") }}</label>
                        <div class="input-group">
                            <input type="text" class="form-control input-datepicker border-radius-input-before" id="birthday" name="birthday"  placeholder="{{ __("Birthday") }}" value="{{ $birthday }}" required>
                            <div class="input-group-append">
                                <button class="btn btn-secondary access-input" data-input="#birthday" type="button"><i class="fas fa-calendar-alt"></i></button>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>{{ __("Contact Email") }}</label>
                        <input type="text" class="form-control" name="contact_email" value="{{ $contact_email }}" placeholder="{{ __("Enter contact email") }}">
                    </div>
                </div>

            </div>

            <div class="row">



                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label required-cls">{{ __("Language") }}</label>
                        @include("Elements.cbb", [
                            'domeHtml' 		=> 'lang_key',
                            'nameHtml' 		=> 'lang_key',
                            'displayField'  => 'name',
                            'valueField'  	=> 'code',
                            'id'  	        => $lang_key,
                            'listData' 		=> $listLanguage,
                        ])
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>{{ __("Lasted login") }}</label>
                        <input type="text" class="form-control"  value="{{ $lasted_login }}" placeholder="{{ __("") }}" readonly>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>{{ __("Created at") }}</label>
                        <input type="text" class="form-control"  value="{{ $created_at }}" placeholder="{{ __("") }}" readonly>
                    </div>
                </div>

            </div>

            <div class="form-group">
                <label>{{ __("Address") }}</label>
                <textarea type="text" class="form-control" name="address" placeholder="{{ __("Address") }}">{{ $address }}</textarea>
            </div>

            <div class="form-group">
                <label>{{ __("Status") }}</label>
                <div class="checkbox-list">

                    <label class="checkbox">
                        <input type="checkbox" checked="checked" name="status" {{ $status }}>
                        <span></span> {{ __("Active") }}
                    </label>


                </div>
            </div>
        </div>
        <div class="card-footer text-center">
            <button type="submit" class="btn btn-primary mr-2 btn-act-lg"><i class="fa fa-save"></i> {{ __("Save changes") }}</button>
            <button type="reset" class="btn btn-secondary btn-act-lg"><i class="fa fa-sync"></i> {{ __("Refresh") }}</button>
        </div>
    </form>
    <!--end::Form-->
</div>
