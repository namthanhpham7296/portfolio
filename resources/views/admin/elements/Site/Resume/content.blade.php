<?php
$placeholder = __("Search ....")
?>
<style>
    .modal-open, .modal-open body {
        overflow: hidden !important;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card card-custom" id="kt_card_2">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label"><i class="fas fa-concierge-bell"></i></h3>
                </div>
                <div class="card-toolbar">
                    <a href="#" id="btn-add-menu" class="btn btn-icon btn-sm btn-primary mr-1 btn-add-resume" data-card-tool="toggle" data-toggle="tooltip" data-placement="top" title="{{ __("Add new") }}">
                        <i class="fa fa-plus icon-nm"></i>
                    </a>
                    <a href="#" class="btn btn-icon btn-sm btn-success mr-1 btn-refresh" data-card-tool="reload" data-toggle="tooltip" data-placement="top" title="{{ __("Refresh") }}">
                        <i class="ki ki-reload icon-nm"></i>
                    </a>

                </div>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-12 table-responsive-lg">

                        @include("Elements.search_box", compact('placeholder'))

                        <table id="searchTableResume" class="table table-bordered ">
                            <thead>
                            <tr>
                                <th class="col-no w-50px"></th>
                                <th class="col-no w-50px">{{__("No.")}}</th>
                                <th class="w-100px">{{ __('Title') }}</th>
                                <th class="w-100px">{{ __('Subtitle') }}</th>
                                <th class="w-100px">{{ __('Photo') }}</th>
                                <th class="w-200px">{{ __('Content') }}</th>
                                <th class="w-100px">{{ __('From') }}</th>
                                <th class="w-100px">{{ __('To') }}</th>
                                <th class="w-100px">{{ __('Show Homepage') }}</th>
                                <th class="w-100px">{{ __('Status') }}</th>
                                <th class="col-action-width w-200px" nowrap></th>
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

@include("admin.elements.Site.Resume.form")
@include("Elements.modal_confirm_delete", ['modalId' => 'modalDeleteResumeId', 'btnIdDel' => 'btnDeleteResumeId'])
<script src="{{asset('public/js/admin/Site/Resume/index.js?t='.time())}}"></script>
