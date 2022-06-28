@extends("Layouts.metronic_v7")
@section('title', $title)
@section("content")
    <?php
    $terms_of_services = $company['terms_of_services'] ?? "";
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
                        <div class="col-md-12 ">
                            <form id="form-terms" method="post" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label>{{ __("Content") }}</label>
                                    <textarea type="text" class="form-control" name="terms_of_services" id="terms-of-service"><?php echo $terms_of_services;?></textarea>
                                </div>

                                <div class="card-footer text-center">
                                    <button type="submit" class="btn btn-primary font-weight-bold btn-act-lg"><i class="fas fa-save"></i> {{ __("Save") }}</button>
                                    <button type="button" class="btn btn-default font-weight-bold btn-act-lg" data-dismiss="modal"><i class="fas fa-times"></i> {{ __("Close") }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <script>
        var titleAdd = "{{ __('Add new') }}",
                titleEdit = "{{ __('Edit') }}";

        $(document).ready(function() {
            activeSummerNote(550, 'monokai','#terms-of-service');
        });
    </script>


@endsection

@section("pagescript")
    <script src="{{asset('public/js/Admin/Company/index.js?t=1')}}"></script>
@endsection


