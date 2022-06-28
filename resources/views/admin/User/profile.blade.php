@extends('Layouts.metronic_v7')
@section('title', $title)
@section('content')
    <style>
        .profile-userpic img {
            width: 80%;
            height: 80%;
            -webkit-border-radius: 4px!important;
            -moz-border-radius: 4px!important;
            border-radius: 4px!important;
        }
    </style>
    <script>
        var iconEye = '<i class="far fa-eye"></i>';
        var iconEyeSlash = '<i class="far fa-eye-slash"></i>';
        var user_id = <?php echo $userInfo['id'] ?? -1?>;
        var company_id = -1;
    </script>
    <div class="d-flex flex-row">
        <!--begin::Aside-->
    @include("Admin.Elements.User.Profile.profile_aside", [
        'page' => $page,
    ])
    <!--end::Aside-->
        <!--begin::Content-->
    @include("Admin.Elements.User.Profile.profile_content")

    <!--end::Content-->
    </div>




@endsection

@section('pagescript')
    <script src="{{ asset('public/js/admin/User/profile.js?t=1') }}"></script>
@endsection

