@extends("Layouts.metronic_v7")
@section('title', $title)
@section("content")
    <?php
    ?>
    <style>
        .col-action-width {
            width: 70px;
            max-width: 70px;
        }

        .ng-input-button-container .ng-button {
            height: 34px;
        }

        .ng-button-icon-span {
            margin-top: 2px;
        }

        #searchBox .form-group{
            margin-bottom: 5px !important;
        }
    </style>

    <?php $placeholder = __('Search by code, fullname, email ...'); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom" id="kt_card_2">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label"><i class="fas fa-users"></i> {{ __($title) }}</h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="javascript:;" class="btn btn-icon btn-sm btn-primary mr-1 btn-add" data-card-tool="toggle" data-toggle="tooltip" data-placement="top" title="{{ __("Add new") }}">
                            <i class="fa fa-plus icon-nm"></i>
                        </a>

                    </div>
                </div>
                <div class="card-body pt-2">

                    <div class="row">
                        <div class="col-md-12 pt-5 pb-0">
                            @include("Elements.search_box", compact('placeholder'))
                        </div>
                        <div class="col-md-12">
                            <ul class="nav nav-tabs nav-tabs-line mb-5">
                                <li class="nav-item">
                                    <a class="nav-link active user-type-selected" data-type="0" data-toggle="tab" href="#tab_content_user">
                                        <span class="nav-icon">
                                            <i class="fas fa-users"></i>
                                        </span>
                                        <span class="nav-text">{{ __("All") }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link  user-type-selected" data-type="{{ \App\Constant::MASTER_ADMIN }}"  data-toggle="tab" href="#tab_content_user">
                                        <span class="nav-icon">
                                            <i class="fas fa-user-secret"></i>
                                        </span>
                                        <span class="nav-text">{{ __("System User") }}</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link user-type-selected " data-type="{{ \App\Constant::CUSTOMER_ADMIN }}"  data-toggle="tab" href="#tab_content_user">
                                        <span class="nav-icon">
                                            <i class="fas fa-user-tie"></i>
                                        </span>
                                        <span class="nav-text">{{ __("Customer") }}</span>
                                    </a>
                                </li>

                            </ul>

                            <div class="tab-content mt-5" id="myTabContent">
                                <div class="tab-pane fade active show" id="tab_content_user" role="tabpanel" aria-labelledby="tab_all_user">
                                    <div class="row">
                                        <div class="col-md-12 table-responsive-lg">

                                            <table id="searchTable" class="table table-bordered ">
                                                <thead>
                                                <tr>
                                                    <th  class=" w-100px" >{{ __('No.') }}</th>
                                                    <th  class=" w-100px text-center">{{ __('Code') }}</th>
                                                    <th  class=" w-200px">{{ __('Fullname') }}</th>
                                                    <th  class=" w-200px">{{ __('Username') }}</th>
                                                    <th  class=" w-100px">{{ __('Phone') }}</th>
                                                    <th  class=" w-200px">{{ __('Contact Email') }}</th>
                                                    <th  class=" w-100px">{{ __('Status') }}</th>
                                                    <th  class=" w-80px">{{ __('Action') }}</th>
                                                </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>




    <script>
        var titleAdd = "{{ __('Thêm mới') }}",
                titleEdit = "{{ __('Chỉnh sửa') }}";
        var is_admin = 0;
        var company_id = -1;
    </script>

    @include("Elements.modal_confirm_delete")
    @include("Admin.Elements.User.form")
    @include("Elements.modal_waiting")


@endsection

@section("pagescript")
    <script src="{{asset('public/js/admin/User/index.js?t=2')}}"></script>
@endsection


