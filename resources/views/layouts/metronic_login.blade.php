
<!DOCTYPE html>
<!--
Template Name: Metronic - Bootstrap 4 HTML, React, Angular 10 & VueJS Admin Dashboard Theme
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: https://1.envato.market/EA4JP
Renew Support: https://1.envato.market/EA4JP
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en">
<!--begin::Head-->
<head>

@include('Elements.meta_data', compact('company'))
<!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Custom Styles(used by this page)-->
    <link href="{{  asset('public/assets/templates/metronicv7/assets/css/pages/login/login-1.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Page Custom Styles-->

    <link rel="stylesheet" href="{{  asset('public/css/common.css?t=1') }}">

    <script src="{{  asset('public/js/jquery.js') }}"></script>
    <script src="{{  asset('public/js/bootstrap.js') }}"></script>
    <!--begin::WOW Animation -->
    <link href="{{  asset('public/assets/templates/metronicv7/assets/css/animate.css') }}" rel="stylesheet" type="text/css"  />
    <!--end::WOW Animation -->

    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="{{  asset('public/assets/templates/metronicv7/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{  asset('public/assets/templates/metronicv7/assets/plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{  asset('public/assets/templates/metronicv7/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    <link href="{{  asset('public/assets/templates/metronicv7/assets/css/themes/layout/header/base/light.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{  asset('public/assets/templates/metronicv7/assets/css/themes/layout/header/menu/light.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{  asset('public/assets/templates/metronicv7/assets/css/themes/layout/brand/dark.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{  asset('public/assets/templates/metronicv7/assets/css/themes/layout/aside/dark.css') }}" rel="stylesheet" type="text/css" />

    <script>
        var _token = "{{ csrf_token() }}";
        var APP = {};
        APP.API_URL = "{!! url('/').'/' !!}";
    </script>

@include('Elements.include_variables')

    <!--end::Layout Themes-->
</head>
<?php
    use App\Helpers\BaseService;
    $currUrl = BaseService::getFullUrl();
    $path = parse_url($currUrl)['path'];
?>
<!--end::Head-->
<!--begin::Body-->
<style>

</style>
<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
<!--begin::Main-->
<div class="d-flex flex-column flex-root">
    <!--begin::Login-->
    <div class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
        <!--begin::Aside-->
        @if($path === '/login' || $path === '/signUp' || $path === '/registerSuccessfully' || $path === '/registerConfirmSuccessfully' )
        <div class="login-aside d-flex flex-column flex-row-auto" style="background-color: #F2C98A;">
            <!--begin::Aside Top-->
            <div class="d-flex flex-column-auto flex-column pt-lg-40 pt-15">
                <!--begin::Aside header-->
                <a href="#" class="text-center mb-10">
                    <img src="{{  asset('public/assets/templates/metronicv7/assets/media/logos/logo-letter-1.png') }}" class="max-h-70px" alt="" />
                </a>
                <!--end::Aside header-->
                <!--begin::Aside title-->
                <h3 class="font-weight-bolder text-center font-size-h4 font-size-h1-lg" style="color: #986923;">LMS System
                    <br />easier your jobs</h3>
                <!--end::Aside title-->
            </div>
            <!--end::Aside Top-->
            <!--begin::Aside Bottom-->
            <div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center" style="background-image: url({{  asset('public/img/login_bg.png') }})"></div>
            <!--end::Aside Bottom-->
        </div>
        <!--begin::Aside-->

        <!--begin::Content-->
        <div class="login-content flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden p-7 mx-auto">
            <!--begin::Content body-->
            <div class="d-flex flex-column-fluid flex-center">
                @yield('content')
            </div>
            <!--end::Content body-->
            <!--begin::Content footer-->

            <div class="d-flex justify-content-lg-start justify-content-center align-items-end py-7 py-lg-0" style="margin: auto;">
                <div class="text-dark-50 font-size-lg font-weight-bolder mr-10">
                    <span class="mr-1">{{ date('Y') }}©</span>
                    <a href="javascript:;" target="_blank" class="text-dark-75 text-hover-primary">{{ $company['subject'] }}</a>
                </div>
                <a href="{{ url('/terms') }}" class="text-primary font-weight-bolder font-size-lg">{{ __("Terms") }}</a>
                <a href="{{ url('/privacy-policy') }}" class="text-primary font-weight-bolder font-size-lg ml-5">{{ __("Privacy Policy") }}</a>
                <a href="{{ url('/plans') }}" class="text-primary ml-5 font-weight-bolder font-size-lg">{{ __("Plans") }}</a>
                <a href="{{ url('/contact-us') }}" class="text-primary ml-5 font-weight-bolder font-size-lg">{{ __("Contact Us") }}</a>
            </div>
            <!--end::Content footer-->
        </div>
        @endif
        <!--end::Content-->
    </div>
    <!--end::Login-->
</div>
<!--end::Main-->
<script>var HOST_URL = "https://lms.devil/";</script>
<!--begin::Global Config(global config for global JS scripts)-->
<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
<!--end::Global Config-->
<!--begin::Global Theme Bundle(used by all pages)-->
<script src="{{  asset('public/assets/templates/metronicv7/assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{  asset('public/assets/templates/metronicv7/assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
<script src="{{  asset('public/assets/templates/metronicv7/assets/js/scripts.bundle.js') }}"></script>
<!--end::Global Theme Bundle-->
<!--begin::Page Scripts(used by this page)-->
<!--end::Page Scripts-->
<script src="{{  asset('public/js/common.js?t=1') }}"></script>
<script src="{{  asset('public/js/bootstrap-notify.js') }}"></script>
<script src="{{  asset('public/js/slide-message.js') }}"></script>

<script>
    $(function () {
//        $('input.input-number').number( true, 0 );
        $(".tooltips").tooltip();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    $(document).ready(function(e){
        $(document).on("click", ".btn-selected", function(){
            var elSelect = $(this);
            $(".btn-selected").removeClass("selected");
            elSelect.addClass("selected");
        });
    });
</script>

</body>
<!--end::Body-->
</html>
