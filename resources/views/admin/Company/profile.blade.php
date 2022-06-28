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
<?php
    use App\Constant;

?>

<div class="d-flex flex-row">
    <!--begin::Aside-->
    @include("admin.Elements.Company.profile_aside", [
        'company' => $company,
        'page' => $page,
    ])
    <!--end::Aside-->
    <!--begin::Content-->
    @include("admin.Elements.Company.profile_content")

    <!--end::Content-->
</div>

<script>
    var iconEye = '<i class="far fa-eye"></i>';
    var iconEyeSlash = '<i class="far fa-eye-slash"></i>';
</script>


@endsection

@section('pagescript')
    <script src="{{ asset('public/js/Admin/Company/profile.js?t='.Constant::SYSTEM_CACHE) }}"></script>
@endsection


