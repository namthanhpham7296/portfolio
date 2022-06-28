<?php
$id             = isset($company['id']) ? $company['id'] : -1;
$subject        = isset($company['subject']) ? $company['subject'] : "";
$address        = isset($company['address']) ? $company['address'] : "";
$province       = isset($company['province']) ? $company['province'] : "";
$email          = isset($company['email']) ? $company['email'] : "";
$phoneNumber    = isset($company['phone_number']) ? $company['phone_number'] : "";
$website        = isset($company['website']) ? $company['website'] : "";
$copyright      = isset($company['copyright']) ? $company['copyright'] : "";
$emailSupport   = isset($company['email_support']) ? $company['email_support'] : "";
$phoneSupport   = isset($company['phone_support']) ? $company['phone_support'] : "";

$homeLogo       = isset($company['home_logo']) ? $company['home_logo'] : "";
$logo           = isset($company['logo']) ? $company['logo'] : "";
$logoAlt        = isset($company['logo_alt']) ? $company['logo_alt'] : "";
$logoTitle      = isset($company['logo_title']) ? $company['logo_title'] : "";

$favicon        = isset($company['favicon']) ? $company['favicon'] : "";

$cover          = isset($company['cover']) ? $company['cover'] : "";
$banner         = isset($company['banner']) ? $company['banner'] : "";
$bannerAlt      = isset($company['banner_alt']) ? $company['banner_alt'] : "";
$bannerTitle    = isset($company['banner_title']) ? $company['banner_title'] : "";

$homeBanner     = isset($company['home_banner']) ? $company['home_banner'] : "";
$homeBannerAlt  = isset($company['home_banner_alt']) ? $company['home_banner_alt'] : "";
$homeBannerTitle= isset($company['home_banner_title']) ? $company['home_banner_title'] : "";

$loginImg       = isset($company['login_img']) ? $company['login_img'] : "";
$cover          = isset($company['cover']) ? $company['cover'] : "";
$coverAlt       = isset($company['cover_alt']) ? $company['cover_alt'] : "";
$coverTitle     = isset($company['cover_title']) ? $company['cover_title'] : "";

$description    = isset($company['description']) ? $company['description'] : "";
$keyword        = isset($company['keyword']) ? $company['keyword'] : "";
$title          = isset($company['title']) ? $company['title'] : "";
$slogan         = isset($company['slogan']) ? $company['slogan'] : "";
$hotline        = isset($company['hotline']) ? $company['hotline'] : "";
$googleAnalytic = isset($company['google_analytic']) ? $company['google_analytic'] : "";

$addressLat     = isset($company['address_lat']) ? $company['address_lat'] : "";
$addressLng     = isset($company['address_lng']) ? $company['address_lng'] : "";

$facebookUrl    = isset($company['facebook_url']) ? $company['facebook_url'] : "";
$instagramUrl   = isset($company['instagram_url']) ? $company['instagram_url'] : "";
$twitterUrl     = isset($company['twitter_url']) ? $company['twitter_url'] : "";
$pinterestUrl   = isset($company['pinterest_url']) ? $company['pinterest_url'] : "";
$youtubeUrl     = isset($company['youtube_url']) ? $company['youtube_url'] : "";
$googlePlusUrl  = isset($company['google_plus_url']) ? $company['google_plus_url'] : "";
$linkedInUrl    = isset($company['linked_in_url']) ? $company['linked_in_url'] : "";
$stumbleUponUrl = isset($company['stumble_upon_url']) ? $company['stumble_upon_url'] : "";
$redditUrl      = isset($company['reddit_url']) ? $company['reddit_url'] : "";
$tumbrlUrl      = isset($company['tumbrl_url']) ? $company['tumbrl_url'] : "";
$bloggerUrl     = isset($company['blogger_url']) ? $company['blogger_url'] : "";
$flickrUrl      = isset($company['flickr_url']) ? $company['flickr_url'] : "";
$websiteRedirect= strpos($website, 'https') || strpos($website, 'http') ? $website : 'http://'.$website;

$faviconPath    = empty($favicon) ? "" : asset('/public/uploads/company/favicon/'.$favicon);
$logoPath       = empty($logo) ? "" : asset('/public/uploads/company/logo/'.$logo);
$homeLogoPath   = empty($homeLogo) ? "" : asset('/public/uploads/company/home/'.$homeLogo);
$homeBannerPath = empty($homeBanner) ? "" : asset('/public/uploads/company/banner/home/'.$homeBanner);
$coverPath      = empty($cover) ? "" : asset('/public/uploads/company/cover/'.$cover);
$bannerPath     = empty($banner) ? "" : asset('/public/uploads/company/banner/'.$banner);
$loginImgPath   = empty($loginImg) ? "" : asset('/public/uploads/company/banner/'.$loginImg);

?>

<style>
    .file-drag-handle{
        display: none;
    }

    .file-preview .fileinput-remove {
        top: 4px;
        right: 4px;
    }

    .kv-fileinput-caption{
        border-top-right-radius: 0 !important;
        border-bottom-right-radius: 0 !important;
    }

    .btn-same-width{
        width: 130px;
    }

</style>

<div class="tab-pane active" id="tab_general_info">
    <form role="form" method="post" id="general-info-company" enctype="multipart/form-data">
        <input type="text" class="form-control hidden" name="Company[id]" value="{{ $id }}" >

        <div class="form-group">
            <label class="control-label">{{ trans("Tên công ty") }} (<span class="input-require text-danger">*</span>):</label>
            <input type="text" class="form-control" name="Company[subject]" value="{{ $subject }}"> </div>

        <div class="form-group">
            <label class="control-label">{{ trans("Trang web") }}:</label>
            <div class="input-group">
                <input type="text" class="form-control border-no-radius-right" value="{{ $website }}" name="Company[website]">
                <span class="input-group-addon border-radius-right">
                    <a href="{{ $websiteRedirect }}"><i class="fa fa-external-link"></i></a>
                </span>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label">{{ trans("Bản quyền") }} (<span class="input-require text-danger">*</span>):</label>
            <input type="text" class="form-control" name="Company[copyright]" value="{{ $copyright }}">
            <span class="help-block text-danger"> * {{ trans("Trong chuỗi nhập sở hữu nên có chuỗi #YYYY# hệ thống sẽ tự cập nhật theo năm") }}. </span>
        </div>

        <div class="form-group">
            <label class="control-label">{{ trans("Địa chỉ") }} (<span class="input-require text-danger">*</span>):</label>
            <input type="text" class="form-control" name="Company[address]" value="{{ $address }}"> </div>

        <div class="form-group">
            <label class="control-label">{{ trans("Tỉnh/thành") }} (<span class="input-require text-danger">*</span>):</label>
            <input type="text" class="form-control" name="Company[province]" value="{{ $province }}"> </div>

        <div class="form-group">
            <label class="control-label">{{ trans("Email") }} (<span class="input-require text-danger">*</span>):</label>
            <input type="text" class="form-control" name="Company[email]" value="{{ $email }}"> </div>

        <div class="form-group">
            <label class="control-label">{{ trans("Số điện thoại") }} (<span class="input-require text-danger">*</span>):</label>
            <input type="text" class="form-control" name="Company[phone_number]" value="{{ $phoneNumber }}"> </div>

        <div class="row">
            <div class="col-md-6" style="">
                <div class="form-group">
                    <label class="control-label">{{ trans("Icon trang web") }} (<span class="input-require text-danger">*</span>):</label>
                    @include('Admin.Elements.file_input_upload', [
                        'showUpload'    => false,
                        'showPreview'   => true,
                        'filePath'      => $faviconPath,
                        'domId'         => 'profile-favicon',
                        'caption'       => 'favicon',
                        'deletePath'    => url('admin/company/deletePicture/favicon')
                    ])
                </div>
            </div>
            <div class="col-md-6" style="">
                <div class="form-group">
                    <label class="control-label">{{ trans("Logo trang web") }} (<span class="input-require text-danger">*</span>):</label>
                    @include('Admin.Elements.file_input_upload', [
                        'showUpload'    => false,
                        'showPreview'   => true,
                        'filePath'      => $logoPath,
                        'domId'         => 'profile-logo',
                        'caption'       => 'logo',
                        'deletePath'    => url('admin/company/deletePicture/logo')
                    ])
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12" style="">
                <div class="form-group">
                    <label class="control-label">{{ trans("Biểu ngữ trang chủ") }}:</label>
                    @include('Admin.Elements.file_input_upload', [
                        'showUpload'    => false,
                        'showPreview'   => true,
                        'filePath'      => $bannerPath,
                        'domId'         => 'profile-banner',
                        'caption'       => 'banner',
                        'deletePath'    => url('admin/company/deletePicture/banner')
                    ])
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label">{{ trans("Mô tả Logo") }}:</label>
            <input type="text" class="form-control" name="Company[logo_alt]" value="{{ $logoAlt }}"> </div>

        <div class="form-group">
            <label class="control-label">{{ trans("Tiêu đề Logo") }}:</label>
            <input type="text" class="form-control" name="Company[logo_title]" value="{{ $logoTitle }}"> </div>
        <div class="form-group">
            <label class="control-label">{{ trans("Từ khóa") }}:</label>
            <input type="text" class="form-control" name="Company[keyword]" value="{{ $keyword }}"> </div>
        <div class="form-group">
            <label class="control-label">{{ trans("Tiêu đề trang web") }}:</label>
            <input type="text" class="form-control" name="Company[title]" value="{{ $title }}"> </div>
        <div class="form-group">
            <label class="control-label">{{ trans("Khẩu hiệu") }}:</label>
            <input type="text" class="form-control" name="Company[slogan]" value="{{ $slogan }}"> </div>
        <div class="form-group">
            <label class="control-label">{{ trans("Đường dây nóng") }}:</label>
            <input type="text" class="form-control" name="Company[hotline]" value="{{ $hotline }}"> </div>

        <div class="form-group">
            <label class="control-label">{{ trans("Mô tả trang web") }}:</label>
            <textarea type="text" rows="3" class="form-control"
                      name="Company[description]">{{ $description }}</textarea></div>

        <hr>

        <div class="margiv-top-10 text-center">
            <button type="submit" href="javascript:;" class="btn blue btn-act-detail btn-smooth btn-same-width">
                <i class="fa fa-floppy-o"></i> {{ trans("Lưu thay đổi") }}
            </button>
            {{--<a href="javascript:;" class="btn default btn-act-detail btn-smooth btn-same-width"> --}}
                {{--<i class="fal fa-sync"></i> {{ trans("Refresh") }} --}}
            {{--</a>--}}
        </div>
    </form>
</div>



