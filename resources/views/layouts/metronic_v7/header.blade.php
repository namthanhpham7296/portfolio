<?php

use App\Constant;use Illuminate\Support\Facades\Auth;

$authUser = Auth::user();

$avatar = $authUser->avatar;
$company_id = $authUser->company_id;
$avatar_path = empty($avatar) ? $current_domain.'/img/avatar_default.jpg' :
    $current_domain.'/public/uploads/'.$company_id.'/User/'.$authUser->id.'/Avatar/'.$avatar;

$current_flag_path =  $current_domain.'/uploads/'.$currentLanguage->company_id.'/Language/'.$currentLanguage->id."/".$currentLanguage->flag.'?t='.Constant::SYSTEM_CACHE;

?>

<style>
    .lbl-back{
        font-size: 13px;
        padding-left: 5px;
        font-weight: bold;
    }
</style>

<div id="kt_header" class="header header-fixed">
    <!--begin::Container-->
    <div class="container-fluid d-flex align-items-stretch justify-content-between">

        <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
            <!--begin::Header Menu-->
            <div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">

                <ul class="menu-nav">

                    <?php if(isset($back_url) ){?>

                        @if(isset($is_show_back_url) && $is_show_back_url)

                            <li class="menu-item menu-item-submenu menu-item-rel menu-item-active" >
                                <a href="{{ $back_url }}" class="menu-link">

                                    <span class="menu-text"><i class="fas fa-chevron-double-left"></i>  <span class="lbl-back">{{ __("Back") }}</span></span>

                                </a>

                            </li>
                        @endif

                        <?php } ?>

                </ul>
            </div>
            <!--end::Header Menu-->
        </div>

        @if(isset($show_header_name) && $show_header_name)
        <!--begin::Details-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{ __($title) }} (<span id="total-header-name">...</span>)</h5>
            <!--end::Title-->
        </div>
        <!--end::Details-->
        @endif
        <!--begin::Topbar-->

        <div class="topbar">

            <!--begin::Languages-->
            <div class="dropdown">
                <!--begin::Toggle-->
                <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                    <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1">
                        <img class="h-20px w-20px rounded-sm" src="{{  $current_flag_path }}" alt="" />
                    </div>
                </div>
                <!--end::Toggle-->
                <!--begin::Dropdown-->
                <div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">
                    <!--begin::Nav-->
                    <ul class="navi navi-hover py-4">

                        @foreach($listLanguage as $key => $language)
                            <?php
                            $flag_path =  $current_domain.'/uploads/'.$company_id.'/Language/'.$language->id."/".$language->flag.'?t='.Constant::SYSTEM_CACHE;
                            ?>
                            <!--begin::Item-->
                            <li class="navi-item">
                                <a href="{!! route('user.change-language', [$language->code]) !!}" class="navi-link">
                                    <span class="symbol symbol-20 mr-3">
                                        <img src="{{  $flag_path }}" alt="{{ $language->name }}" />
                                    </span>
                                    <span class="navi-text">{{ $language->name }}</span>
                                </a>
                            </li>
                            <!--end::Item-->
                        @endforeach

                    </ul>
                    <!--end::Nav-->
                </div>
                <!--end::Dropdown-->
            </div>
            <!--end::Languages-->
            <!--begin::User-->
            <div class="topbar-item">
                <div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
                    <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">{{ __("Hi") }},</span>
                    <span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">{{ $authUser->name }}</span>
                    <span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
                        <img src="{{ $avatar_path }}">
                    </span>
                </div>
            </div>
            <!--end::User-->
        </div>
        <!--end::Topbar-->
    </div>
    <!--end::Container-->
</div>
