<?php
use App\Constant;
$id = isset($company['id']) ? $company['id'] : -1;
    $subject = isset($company['subject']) ? $company['subject'] : '';
    $phone_number = isset($company['phone_number']) ? $company['phone_number'] : '';
    $email = isset($company['email']) ? $company['email'] : '';
    $address = isset($company['address']) ? $company['address'] : '';
    $logo = isset($company['logo']) ? $company['logo'] : '';

    $logo_path = empty($logo) ? $current_domain.'/images/no_img.jpg' :
        $current_domain.'/uploads/'.$id.'/Logo/'.$logo."?t=".Constant::SYSTEM_CACHE;

    $listProfileMenu = [
        ['name' => "General information", 'page' => "general", 'cls_icon' => "fas fa-file-invoice","url" => url("admin/company/profile/")],
        ['name' => "Social", 'page' => "social",'cls_icon' => "fab fa-facebook","url" => url("admin/company/profile/social/")],
        ['name' => "SNS Code", 'page' => "sns",'cls_icon' => "fas fa-share-alt","url" => url("admin/company/profile/sns/")],
        ['name' => "Domain", 'page' => "domain", 'cls_icon' => "fas fa-globe-americas","url" => url("admin/company/profile/domain/")],
        ['name' => "Mailer Setting", 'page' => "mailer", 'cls_icon' => "fas fa-mail-bulk","url" => url("admin/company/profile/mailer/")],
//        ['name' => "Organization", 'page' => "organization", 'cls_icon' => "fas fa-sitemap","url" => url("admin/company/profile/organization/")],
//        ['name' => "Modules Access", 'page' => "modules", 'cls_icon' => "fas fa-user-unlock","url" => url("admin/company/profile/modules/")],
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
                    <div class="symbol-label" id="logo-path" style="background-image:url('{{ $logo_path }}')"></div>
                    <i class="symbol-badge bg-success"></i>
                </div>
                <div>
                    <a href="#" class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary">{{ $subject }}</a>
                    <div class="mt-2">
                        <a href="javascript:;" class="btn btn-sm btn-danger font-weight-bold mr-2 py-2 px-3 px-xxl-5 my-1">{{ __("Block") }}</a>
                        <a href="javascript:;" class="btn btn-sm btn-primary font-weight-bold py-2 px-3 px-xxl-5 my-1">{{ __("Access") }}</a>
                    </div>
                </div>
            </div>
            <!--end::User-->
            <!--begin::Contact-->
            <div class="py-9">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="font-weight-bold mr-2">{{ __("Email") }}:</span>
                    <a href="#" class="text-muted text-hover-primary">{{ $email }}</a>
                </div>
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="font-weight-bold mr-2">{{ __("Phone") }}:</span>
                    <span class="text-muted">{{ $phone_number }}</span>
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
