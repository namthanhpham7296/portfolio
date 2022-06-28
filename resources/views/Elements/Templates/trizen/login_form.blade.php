<?php
use App\Constant;
$turn_off_recaptcha = $setting->turn_off_recaptcha ?? 0;
?>

<style>
    #google-signin{
        position: relative;
    }
    #google-signin-inner{
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        opacity: 0;
    }
</style>

<!-- end modal-shared -->
<div class="modal-popup">
    <div class="modal fade" id="loginPopupForm" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <h5 class="modal-title title" >{{ __("Login") }}</h5>
                        <p class="font-size-14">Hello! Welcome to your account</p>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="la la-close"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="contact-form-action">
                        <form method="post" id="form-login">
                            {{ csrf_field() }}
                            <div class="input-box">
                                <label class="label-text">Username</label>
                                <div class="form-group">
                                    <span class="la la-user form-icon"></span>
                                    <input class="form-control" type="text" name="email" placeholder="{{ __("Enter Username") }}">
                                </div>
                            </div><!-- end input-box -->
                            <div class="input-box">
                                <label class="label-text">Password</label>
                                <div class="form-group mb-2">
                                    <span class="la la-lock form-icon"></span>
                                    <input class="form-control" type="password" name="password" placeholder="{{ __("Enter Password") }}">
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="custom-checkbox mb-0">
                                        <input type="checkbox" id="rememberchb">
                                        <label for="rememberchb">Remember me</label>
                                    </div>
                                    <p class="forgot-password">
                                        <a href="recover.html">Forgot Password?</a>
                                    </p>
                                </div>
                            </div>

                            @if(!$turn_off_recaptcha)
                                <div class="input-box" style="padding-top: 10px">
                                    <div class="g-recaptcha" data-sitekey="<?php echo Constant::GOOGLE_SITE_KEY; ?>"></div>
                                </div>
                            @endif
                            <!-- end input-box -->
                            <div class="btn-box pt-3 pb-4">
                                <button type="submit" class="theme-btn w-100">{{ __("Login Account") }}</button>
                            </div>
                            <div class="action-box text-center">
                                <p class="font-size-14">Or Login Using</p>
                                <ul class="social-profile py-3">
                                    <li><a href="javascript:;" class="bg-5 text-white" id="facebook-login"><i class="lab la-facebook-f"></i></a></li>
                                    <li><a href="javascript:;" class="bg-7 text-white" id="google-signin">
                                            <i class="lab la-google"></i>
                                            <div id="google-signin-inner"></div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </form>
                    </div><!-- end contact-form-action -->
                </div>
            </div>
        </div>
    </div>
</div>



<!-- end modal-popup -->
@include("Elements.Social.facebook_login")
@include("Elements.Social.google_login")




