<?php
use App\Constant;use Illuminate\Support\Facades\Auth;
$authUser = Auth::user();
$id = isset($userInfo['id']) ? $userInfo['id'] : -1;
$email = isset($userInfo['email']) ? $userInfo['email'] : '';
?>
<div class="card card-custom">
    <!--begin::Header-->
    <div class="card-header py-3">
        <div class="card-title align-items-start flex-column">
            <h3 class="card-label font-weight-bolder text-dark"><i class="fab fa-keycdn"></i> {{ __("Change password") }}</h3>
            <span class="text-muted font-weight-bold font-size-sm mt-1">{{ __("Change your account password") }}</span>
        </div>
        <div class="card-toolbar">

        </div>
    </div>
    <!--end::Header-->
    <!--begin::Form-->
    <form class="form" method="post" id="form-password">
        <input type="text" class="form-control " name="id" value="{{ $id }}" hidden>
        <div class="card-body">
            <!--begin::Alert-->
            <div class="alert alert-custom alert-light-danger fade show mb-10" role="alert">
                <div class="alert-icon">
                    <span class="svg-icon svg-icon-3x svg-icon-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"></rect>
                                <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"></circle>
                                <rect fill="#000000" x="11" y="10" width="2" height="7" rx="1"></rect>
                                <rect fill="#000000" x="11" y="7" width="2" height="2" rx="1"></rect>
                            </g>
                        </svg>
                    </span>
                </div>
                <div class="alert-text font-weight-bold">{{ __("Just Master admin can update username for current selected user") }}</div>
                <div class="alert-close">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">
                            <i class="ki ki-close"></i>
                        </span>
                    </button>
                </div>
            </div>

            <!--end::Alert-->

            <?php if($authUser->is_admin == Constant::MASTER_ADMIN){ ?>

                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label text-alert">{{ __("Username") }}</label>
                    <div class="col-lg-9 col-xl-6">
                        <input type="text" class="form-control form-control-lg form-control-solid mb-2" name="email" value="{{ $email }}" placeholder="{{ __("Enter Username") }}">
                    </div>
                </div>
            <?php } ?>

            <?php if($authUser->is_admin != Constant::MASTER_ADMIN){ ?>

            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 col-form-label text-alert">{{ __("Current Password") }}</label>
                <div class="col-lg-9 col-xl-6">
                    <input type="password" class="form-control form-control-lg form-control-solid mb-2" name="current_password" value="" placeholder="{{ __("Enter current password") }}">
                    <a href="#" class="text-sm font-weight-bold">{{ __("Forgot password ?") }}</a>
                </div>
            </div>
            <?php } ?>


            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 col-form-label text-alert">{{ __("New Password") }}</label>
                <div class="col-lg-9 col-xl-6">
                    <input type="password" class="form-control form-control-lg form-control-solid" name="password" value="" placeholder="{{ __("New Password") }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 col-form-label text-alert">{{ __("Confirm Password") }}</label>
                <div class="col-lg-9 col-xl-6">
                    <input type="password" class="form-control form-control-lg form-control-solid" name="confirm_password" value="" placeholder="{{ __("Confirm Password") }}">
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
            <button type="submit" class="btn btn-primary mr-2 btn-act-lg"><i class="fas fa-save"></i> {{ __("Save changes") }}</button>
            <button type="reset" class="btn btn-secondary btn-act-lg"><i class="fas fa-sync"></i> {{ __("Refresh") }}</button>
        </div>
    </form>
    <!--end::Form-->
</div>
