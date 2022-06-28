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



    </style>

    <?php $placeholder = __('Search by code, fullname, email ...'); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom" id="kt_card_2">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">{{ __($title) }}</h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="javascript:;" class="btn btn-icon btn-sm btn-primary mr-1 btn-add" data-card-tool="toggle" data-toggle="tooltip" data-placement="top" title="{{ __("Add new") }}">
                            <i class="fa fa-plus icon-nm"></i>
                        </a>
                        <a href="#" class="btn btn-icon btn-sm btn-success mr-1" data-card-tool="reload" data-toggle="tooltip" data-placement="top" title="Reload Card">
                            <i class="ki ki-reload icon-nm"></i>
                        </a>
                        <a href="#" class="btn btn-icon btn-sm btn-warning" data-card-tool="remove" data-toggle="tooltip" data-placement="top" title="Remove Card">
                            <i class="ki ki-close icon-nm"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12 table-responsive-lg">

                            @include("Elements.search_box", compact('placeholder'))

                            <table id="searchTable" class="table table-bordered ">
                                <thead>
                                    <tr>
                                        <th  class=" w-100px" >{{ __('No.') }}</th>
                                        <th  class=" w-100px text-center">{{ __('Logo') }}</th>
                                        <th  class=" w-200px">{{ __('Subject') }}</th>
                                        <th  class=" w-100px">{{ __('Phone') }}</th>
                                        <th  class=" w-100px">{{ __('Email') }}</th>
                                        <th  class=" ">{{ __('Address') }}</th>
                                        <th  class=" w-100px">{{ __('Status') }}</th>
                                        <th  class=" w-100px">{{ __('Action') }}</th>
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




    <script>
        var titleAdd = "{{ __('Add new') }}",
                titleEdit = "{{ __('Edit') }}";
    </script>

    @include("Elements.modal_confirm_delete")
    @include("Admin.Elements.Company.form")


@endsection

@section("pagescript")
    <script src="{{asset('public/js/Admin/Company/index.js?t=1')}}"></script>
@endsection


