<?php

$listField = [
    ['label' => "Facebook Fanpage", "column" => "facebook_url", "cls_icon" => "fab fa-facebook", "placeholder" => "Enter facebook fanpage url"],
    ['label' => "Youtube Chanel", "column" => "youtube_url", "cls_icon" => "fab fa-youtube", "placeholder" => "Enter youtube chanel url"],
    ['label' => "Tiktok Chanel", "column" => "tiktok_url", "cls_icon" => "fa-b fa-tiktok", "placeholder" => "Enter tiktok chanel url"],
    ['label' => "Twitter", "column" => "twitter_url", "cls_icon" => "fab fa-twitter", "placeholder" => "Enter twitter url"],
    ['label' => "Instagram", "column" => "instagram_url", "cls_icon" => "fab fa-instagram", "placeholder" => "Enter instagram url"],
    ['label' => "Pinterest", "column" => "pinterest_url", "cls_icon" => "fab fa-pinterest", "placeholder" => "Enter pinterest url"],
];

$id             = $company['id'] ?? -1;

?>

<div class="card card-custom">
    <div class="card-header">
        <h3 class="card-title">
            {{ __("General Information") }}
        </h3>
        <div class="card-toolbar">

        </div>
    </div>
    <!--begin::Form-->
    <form id="form-social" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <input type="text" class="form-control " name="id" value="{{ $id }}" hidden>

            @foreach($listField  as $key => $item)
                <?php
                    $value  = $company[$item["column"]] ?? '';
                ?>
                <div class="form-group">
                    <label>{{ $item['label'] }}</label>

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="{{ $item["cls_icon"] }}"></i></span>
                        </div>
                        <input type="text" class="form-control" name="{{ $item["column"] }}" value="{{ $value }}" placeholder="{{ __($item["placeholder"]) }}">
                    </div>

                </div>

            @endforeach


        </div>
        <div class="card-footer text-center">
            <button type="submit" class="btn btn-primary mr-2 btn-act-lg"><i class="fa fa-save"></i> {{ __("Save changes") }}</button>
            <button type="reset" class="btn btn-secondary  btn-act-lg"><i class="fa fa-sync"></i> {{ __("Refresh") }}</button>
        </div>
    </form>
    <!--end::Form-->
</div>
