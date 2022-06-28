<?php

use App\Constant;

?>
<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEdit"  aria-modal="true" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">New User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>


                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form id="form-data" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>{{ __("Code") }}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="code" placeholder="{{ __("Enter code") }}">
                                </div>

                                <div class="form-group">
                                    <label>{{ __("Fullname") }}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" placeholder="{{ __("Enter fullname") }}">
                                </div>

                                <div class="row">
                                    <div class="col-md-6 pr-5px">
                                        <div class="form-group">
                                            <label>{{ __("Username") }}<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="email" placeholder="{{ __("Enter username") }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 pl-5px">
                                        <div class="form-group">
                                            <label>{{ __("Password") }}<span class="text-danger">*</span></label>

                                            <div class="input-group">
                                                <input type="password" class="form-control" name="password" placeholder="{{ __("Enter password") }}">
                                                <div class="input-group-append show-password" data-show="0">
                                            <span class="input-group-text pointer " >
                                                <i class="fas fa-eye-slash"></i>
                                            </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 pr-5px">
                                        <div class="form-group">
                                            <label>{{ __("Company") }}</label>
                                            @include("Elements.cbb", [
                                                    'domeHtml' 		=> 'company_id',
                                                    'nameHtml' 		=> 'company_id',
                                                    'displayField'  => 'name',
                                                    'isNone'  	    => true,
                                                    'valueField'  	=> 'id',
                                                    'listData' 		=> $listCompany,
                                                ])

                                        </div>
                                    </div>
                                    <div class="col-md-6 pl-5px">
                                        <div class="form-group">
                                            <label>{{ __("Store") }}</label>
                                            <div id="store-area">
                                                @include("Elements.cbb", [
                                                    'domeHtml' 		=> 'store_id',
                                                    'nameHtml' 		=> 'store_id',
                                                    'displayField'  => 'name',
                                                    'isNone'  	    => true,
                                                    'valueField'  	=> 'id',
                                                    'listData' 		=> [],
                                                ])
                                            </div>


                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>{{ __("User Role") }}</label>
                                    @include("Elements.cbb", [
                                            'domeHtml' 		=> 'user_role_id',
                                            'nameHtml' 		=> 'user_role_id',
                                            'displayField'  => 'name',
                                            'isNone'  	    => true,
                                            'valueField'  	=> 'id',
                                            'listData' 		=> $listUserRole,
                                        ])

                                </div>

                                <div class="form-group">
                                    <label>{{ __("Phone") }}</label>
                                    <input type="text" class="form-control" name="phone" placeholder="{{ __("Enter phone") }}">
                                </div>

                                <div class="form-group">
                                    <label>{{ __("Contact Email") }}</label>
                                    <input type="text" class="form-control" name="contact_email" placeholder="{{ __("Enter contact email") }}">
                                </div>

                                <div class="form-group">
                                    <label>{{ __("More options") }}</label>
                                    <div class="checkbox-list">

                                        <label class="checkbox">
                                            <input type="checkbox" checked="checked" name="status">
                                            <span></span> {{ __("Active") }}
                                        </label>

                                        <label class="checkbox">
                                            <input type="checkbox" name="continue">
                                            <span></span> {{ __("Continue add") }}
                                        </label>

                                    </div>
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

