<?php

use Illuminate\Support\Facades\Auth;

$authUser = Auth::user();
$avatar = $authUser->avatar;
$avatar_path = empty($avatar) ? $current_domain.'/img/avatar_default.jpg' :
    $current_domain.'/uploads/User/'.$authUser->id.'/Avatar/'.$avatar;
$is_admin = $authUser->is_admin ?? 0;
$position_id = $authUser->position_id ?? 0;

$position_name = "";

?>
<div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
    <!--begin::Header-->
    <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5" kt-hidden-height="40" style="">
        <h3 class="font-weight-bold m-0">{{ __("User Menu") }}</h3>
        <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
            <i class="ki ki-close icon-xs text-muted"></i>
        </a>
    </div>
    <!--end::Header-->
    <!--begin::Content-->
    <div class="offcanvas-content pr-5 mr-n5 scroll ps ps--active-y" style="height: 399px; overflow: hidden;">
        <!--begin::Header-->
        <div class="d-flex align-items-center mt-5">
            <div class="symbol symbol-100 mr-5">
                <div class="symbol-label" style="background-image:url({{ $avatar_path }})"></div>
                <i class="symbol-badge bg-success"></i>
            </div>
            <div class="d-flex flex-column">
                <a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">{{ $authUser->name }}</a>
                <div class="text-muted mt-1">{{ __("$position_name") }}</div>
                <div class="navi mt-2">
                    <a href="#" class="navi-item">
								<span class="navi-link p-0 pb-2">
									<span class="navi-icon mr-1">
										<span class="svg-icon svg-icon-primary">
											<i class="fas fa-envelope fa-1x"></i>
										</span>
									</span>
									<span class="navi-text text-muted text-hover-primary">{{ $authUser->contact_email }}</span>
								</span>
                    </a>
                    <a href="{{ route('logout')  }}"  onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5">{{ __("Log Out") }}</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Separator-->
        <div class="separator separator-dashed mt-8 mb-5"></div>
        <!--end::Separator-->
        <!--begin::Nav-->
        <div class="navi navi-spacer-x-0 p-0">
            <!--begin::Item-->
            <a href="{{ url('admin/user/profile/general/') }}" class="navi-item">
                <div class="navi-link">
                    <div class="symbol symbol-40 bg-light mr-3">
                        <div class="symbol-label">
                            <span class="svg-icon svg-icon-md svg-icon-success">
                                <i class="fas fa-address-card"></i>
                            </span>
                        </div>
                    </div>
                    <div class="navi-text">
                        <div class="font-weight-bold">{{ __("My Profile") }}</div>
                        <div class="text-muted">{{ __("Account settings and more") }}
                            <span class="label label-light-danger label-inline font-weight-bold">{{ __("update") }}</span></div>
                    </div>
                </div>
            </a>
            <!--end:Item-->
            <!--begin::Item-->
            <a href="{{ url('admin/user/profile/password/') }}" class="navi-item">
                <div class="navi-link">
                    <div class="symbol symbol-40 bg-light mr-3">
                        <div class="symbol-label">
                            <span class="svg-icon svg-icon-md svg-icon-warning">
                                <i class="fab fa-keycdn"></i>
                            </span>
                        </div>
                    </div>
                    <div class="navi-text">
                        <div class="font-weight-bold">{{ __("Change password") }}</div>
                        <div class="text-muted">{{ __("Update your password") }}</div>
                    </div>
                </div>
            </a>
            <!--end:Item-->

        </div>
        <!--end::Nav-->


    </div>
    <!--end::Content-->
</div>
