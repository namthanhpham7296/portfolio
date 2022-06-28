<?php

use Illuminate\Support\Facades\Auth;

$authUser = Auth::user();

    $id             = $userInfo['id'] ?? -1;
    $company_id     = $userInfo['company_id'] ?? -1;
    $name           = $userInfo['name'] ?? '';
    $phone          = $userInfo['phone'] ?? '';
    $birthday       = $userInfo['birthday'] ?? '';
    $lang_key       = $userInfo['lang_key'] ?? '';
    $contact_email  = $userInfo['contact_email'] ?? '';
    $address        = $userInfo['address'] ?? '';
    $avatar         = $userInfo['avatar'] ?? '';

    $avatar_path = empty($avatar) ? $current_domain.'/img/no_img.jpg' :
        $current_domain.'/uploads/'.$company_id.'/User/'.$id.'/Avatar/'.$avatar;

    $listProfileMenu = [
        ['name' => "General information", 'page' => "general", 'cls_icon' => "fas fa-info-square","url" => url("admin/user/profile/general/".$id)],
        ['name' => "Change password", 'page' => "password", 'cls_icon' => "fab fa-keycdn","url" => url("admin/user/profile/password/".$id)],
        ['name' => "Access Menu", 'page' => "access_menu", 'cls_icon' => "fas fa-folder-tree","url" => url("admin/user/profile/accessMenu/".$id)],
    ];

?>
<div class="flex-row-auto offcanvas-mobile w-300px w-xl-350px" id="kt_profile_aside">
    <!--begin::Profile Card-->
    <div class="card card-custom card-stretch">
        <!--begin::Body-->
        <div class="card-body pt-4">
            <!--begin::Toolbar-->
            <div class="d-flex justify-content-end">
                <div class="dropdown dropdown-inline">
                    <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="ki ki-bold-more-hor"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                        <!--begin::Navigation-->
                        <ul class="navi navi-hover py-5">
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="fas fa-file-download"></i>
                                    </span>
                                    <span class="navi-text">{{ __("Export Excel") }}</span>
                                </a>
                            </li>

                        </ul>
                        <!--end::Navigation-->
                    </div>
                </div>
            </div>
            <!--end::Toolbar-->
            <!--begin::User-->
            <div class="d-flex align-items-center">
                <div class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
                    <div class="symbol-label" id="logo-path" style="background-image:url('{{ $avatar_path }}')"></div>
                    <i class="symbol-badge bg-success"></i>
                </div>
                <div>
                    <a href="#" class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary">{{ $name }}</a>
                    <div class="mt-2">

                        @if($authUser->is_admin == \App\Constant::MASTER_ADMIN)
                            <a href="javascript:;" class="btn btn-sm btn-danger font-weight-bold mr-2 py-2 px-3 px-xxl-5 my-1"><i class="fas fa-lock"></i> {{ __("Block") }}</a>
                            <a href="javascript:;" class="btn btn-sm btn-primary font-weight-bold py-2 px-3 px-xxl-5 my-1"><i class="fas fa-unlock"></i> {{ __("Unlock") }}</a>
                        @endif
                    </div>
                </div>
            </div>
            <!--end::User-->
            <!--begin::Contact-->
            <div class="py-9">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="font-weight-bold mr-2">{{ __("Contact Email") }}:</span>
                    <a href="#" class="text-muted text-hover-primary">{{ $contact_email }}</a>
                </div>
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="font-weight-bold mr-2">{{ __("Phone") }}:</span>
                    <span class="text-muted">{{ $phone }}</span>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <span class="font-weight-bold mr-2">{{ __("Address") }}:</span>
                    <span class="text-muted">{{ $address }}</span>
                </div>
            </div>
            <!--end::Contact-->
            <!--begin::Nav-->
            <div class="navi navi-bold navi-hover navi-active navi-link-rounded">

                <?php
                    foreach ($listProfileMenu as $profileMenu){
                        $name       = $profileMenu['name'];
                        $cls_icon   = $profileMenu['cls_icon'];
                        $url        = $profileMenu['url'];

                        if($page == "accessMenu"){$page = "access_menu";}

                        $active = $page == $profileMenu['page'] ? "active" : ''
                        ?>
                            <div class="navi-item mb-2">
                        <a href="{{ $url }}" class="navi-link py-4 {{ $active }}">
                            <span class="navi-icon mr-2">
                                <i class="{{ $cls_icon }}"></i>
                            </span>
                            <span class="navi-text font-size-lg">{{ __($name) }}</span>
                        </a>
                    </div>
                        <?php
                    }
                ?>
            </div>
            <!--end::Nav-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Profile Card-->
</div>
