<?php
use App\Constant;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    @include("Elements.meta_data")

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('public/assets/templates/clark/')}}/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('public/assets/templates/clark/')}}/css/animate.css">
    <link rel="stylesheet" href="{{asset('public/assets/templates/clark/')}}/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{asset('public/assets/templates/clark/')}}/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="{{asset('public/assets/templates/clark/')}}/css/magnific-popup.css">
    <link rel="stylesheet" href="{{asset('public/assets/templates/clark/')}}/css/aos.css">
    <link rel="stylesheet" href="{{asset('public/assets/templates/clark/')}}/css/ionicons.min.css">
    <link rel="stylesheet" href="{{asset('public/assets/templates/clark/')}}/css/flaticon.css">
    <link rel="stylesheet" href="{{asset('public/assets/templates/clark/')}}/css/icomoon.css">
    <link rel="stylesheet" href="{{asset('public/assets/templates/clark/')}}/css/style.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="{{  asset('public/js/jquery.js') }}"></script>
    <script src="{{  asset('public/js/bootstrap.js') }}"></script>
    <script>
        var _token = "{{ csrf_token() }}";
        var APP = {};
        APP.API_URL = "{!! url('/').'/' !!}";
    </script>
</head>
@include("Elements.include_variables")
<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

@include('layouts.clark.header')

@yield('content')

@include('layouts.clark.footer')



<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>
<script src="{{asset('public/assets/templates/clark')}}/js/jquery.min.js"></script>
<script src="{{asset('public/assets/templates/clark')}}/js/jquery-migrate-3.0.1.min.js"></script>
<script src="{{asset('public/assets/templates/clark')}}/js/popper.min.js"></script>
<script src="{{asset('public/assets/templates/clark')}}/js/bootstrap.min.js"></script>
<script src="{{asset('public/assets/templates/clark')}}/js/jquery.easing.1.3.js"></script>
<script src="{{asset('public/assets/templates/clark')}}/js/jquery.waypoints.min.js"></script>
<script src="{{asset('public/assets/templates/clark')}}/js/jquery.stellar.min.js"></script>
<script src="{{asset('public/assets/templates/clark')}}/js/owl.carousel.min.js"></script>
<script src="{{asset('public/assets/templates/clark')}}/js/jquery.magnific-popup.min.js"></script>
<script src="{{asset('public/assets/templates/clark')}}/js/aos.js"></script>
<script src="{{asset('public/assets/templates/clark')}}/js/jquery.animateNumber.min.js"></script>
<script src="{{asset('public/assets/templates/clark')}}/js/scrollax.min.js"></script>
<script src="{{asset('public/assets/templates/clark')}}/js/main.js"></script>
<script src="{{  asset('public/js/common.js?t='.time()) }}"></script>
<script src="{{  asset('public/js/bootstrap-notify.js') }}"></script>
<script src="{{  asset('public/js/slide-message.js') }}"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

</body>
</html>
