<?php
$host_mail = isset($setting->host_mail) ? $setting->host_mail : '';
$port_mail = isset($setting->port_mail) ? $setting->port_mail : '';
$username_mail = isset($setting->username_mail) ? $setting->username_mail : '';
$password_mail = isset($setting->password_mail) ? $setting->password_mail : '';
$transport_mail = isset($setting->transport_mail) ? $setting->transport_mail : '';
$encryption = isset($setting->encryption_mail) ? $setting->encryption_mail : "";
$driver     = isset($setting->driver_mail) ? $setting->driver_mail : "";
$fromAddress  = isset($setting->from_address_mail) ? $setting->from_address_mail : "";
$fromName  = isset($setting->from_name_mail) ? $setting->from_name_mail : "";
?>

<div class="card card-custom">
    <div class="card-header">
        <h3 class="card-title">
            {{__("Mailer Setting")}}
        </h3>
        <div class="card-toolbar">

        </div>
    </div>
    <form method="post" id="form-mailer-setting" enctype="multipart/form-data">

        <input type="text" class="form-control" placeholder="" name="company_id" value="{{ $company_id }}" hidden>

        <div class="card-body">
            <div class="form-group mb-8">
                <div class="alert alert-custom alert-default " role="alert" >
                    <div class="alert-icon text-danger">
                        *
                    </div>
                    <div class="alert-text">
                        {{ __("Data required") }}
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label  class="col-2 col-form-label">{{ __("Send Test mail") }}</label>
                <div class="col-10">
                    <div class="input-group">
                        <input type="email" class="form-control" placeholder="chaunp2021@gmail.com" id="test-mail">
                        <div class="input-group-append">
                            <a role="button" id="send-test-mail" class="btn btn-primary " type="button"><i class="far fa-paper-plane"></i> {{ __("Send now") }}!</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="example-search-input" class="col-2 col-form-label required_label">{{ __("Host Mail") }}</label>
                <div class="col-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fal fa-server icon-lg"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control " value="{{ $host_mail }}" placeholder="mail.company.com" name="host_mail">
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="example-search-input" class="col-2 col-form-label required_label">{{ __("Port Mail") }}</label>
                <div class="col-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fal fa-mailbox icon-lg"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control " value="{{ $port_mail }}" placeholder="443" name="port_mail">
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="example-search-input" class="col-2 col-form-label required_label">{{ __("Username") }}</label>
                <div class="col-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fal fa-envelope icon-lg"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control "  value="{{ $username_mail }}" placeholder="no-reply@company.com" name="username_mail">
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="example-search-input" class="col-2 col-form-label required_label">{{ __("Password") }}</label>
                <div class="col-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fal fa-lock icon-lg"></i>
                            </span>
                        </div>
                        <input type="password" class="form-control " placeholder="*************" name="password_mail"  value="{{ $password_mail }}" id="password-mail">
                        <div class="input-group-append">
                            <span class="input-group-text pointer"  id="mailer-show-password" data-input="password-mail" data-show="0">
                                <i class="far fa-eye-slash"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="example-search-input" class="col-2 col-form-label required_label">{{ __("Transport") }}</label>
                <div class="col-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fal fa-truck-moving icon-lg"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control " placeholder="Smtp"  value="{{ $transport_mail }}" name="transport_mail">
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="example-search-input" class="col-2 col-form-label required_label">{{ __("Driver") }}</label>
                <div class="col-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fal fa-truck-moving icon-lg"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" value="{{ $driver }}" name="driver_mail">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="example-search-input" class="col-2 col-form-label required_label">{{ __("Encryption") }}</label>
                <div class="col-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fal fa-truck-moving icon-lg"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" value="{{ $encryption }}" name="encryption_mail">
                    </div>
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
</div>
