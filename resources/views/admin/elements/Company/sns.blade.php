<?php
    $id = isset($setting->id) ? $setting->id : -1;
?>


<div class="card card-custom ">
    <div class="card-header card-header-tabs-line">
        <div class="card-title">
            <h3 class="card-label">{{ __("SNS Setting") }}</h3>
        </div>
        <div class="card-toolbar">
            <ul class="nav nav-tabs nav-bold nav-tabs-line">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#tab_face_book">
                        <span class="nav-icon">
                            <i class="fab fa-facebook"></i>
                        </span>
                        <span class="nav-text">{{ __("Facebook") }}</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab_google_seo">
                        <span class="nav-icon">
                            <i class="fab fa-google"></i>
                        </span>
                        <span class="nav-text">{{ __("Google SEO") }}</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
    <div class="card-body">
        <div class="tab-content">
            <div class="tab-pane fade active show" id="tab_face_book" role="tabpanel" aria-labelledby="tab_face_book">
                @include("Admin.Elements.Company.sns_facebook")
            </div>

            <div class="tab-pane fade " id="tab_google_seo" role="tabpanel" aria-labelledby="tab_google_seo">

                @include("Admin.Elements.Company.sns_google_seo")


            </div>

        </div>
    </div>
</div>
