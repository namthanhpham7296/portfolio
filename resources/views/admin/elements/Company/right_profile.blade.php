<div class="profile-content">
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light ">
                <div class="portlet-title tabbable-line">
                    <div class="caption caption-md">
                        <i class="icon-globe theme-font hide"></i>
                        <span class="caption-subject font-blue-madison bold uppercase">{{ trans("Thông tin công ty") }}</span>
                    </div>
                    <ul class="nav nav-tabs">
                        <li class="active">
                            {{--<a href="#tab_general_info" data-toggle="tab">{{ trans("General Info") }}</a>--}}
                        </li>
                        {{--<li class="">--}}
                            {{--<a href="#tab_mail_setting" data-toggle="tab">{{ trans("Mail Setting") }}</a>--}}
                        {{--</li>--}}
                    </ul>
                </div>
                <div class="portlet-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_general_info">
                            @include('Admin.Company.right_general_info')
                        </div>
                        {{--<div class="tab-pane" id="tab_mail_setting">--}}
                        {{--</div>--}}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>