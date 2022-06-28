<?php
use Illuminate\Support\Facades\Config;
$id                 = isset($user['id']) ? $user['id'] : '';
    $code               = isset($user['code']) ? $user['code'] : '';
    $name               = isset($user['name']) ? $user['name'] : '';
    $avatar             = isset($user['avatar']) ? $user['avatar'] : '';
    $email              = isset($user['email']) ? $user['email'] : '';
    $contactEmail       = isset($user['contact_email']) ? $user['contact_email'] : '';
    $phone              = isset($user['phone']) ? $user['phone'] : '';
    $address            = isset($user['address']) ? $user['address'] : '';
    $isAdmin            = isset($user['is_admin']) ? $user['is_admin'] : '';
    $birthday           = isset($user['birthday']) ? \App\Helpers\BaseService::formatDate($user['birthday'], 'd/m/Y') : '';
    $selfIntroduction   = isset($user['self_introduction']) ? $user['self_introduction'] : '';
    $createdAt          = isset($user['created_at']) ? $user['created_at'] : '';
    $updatedAt          = isset($user['updated_at']) ? $user['updated_at'] : '';
    $status             = isset($user['status']) ? $user['status'] : -1;

    $picturePath        = !empty($avatar) ? url('public/uploads/Admin/User/'.$id.'/avatar/'.$avatar.'?t='.time()) : asset('/public/images/no_img.png');

    $listStatus = Config::get('constants.LIST_STATUS');

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


    .file-drag-handle {
        display: none;
    }

    .file-preview .fileinput-remove {
        top: 4px;
        right: 4px;
    }

    .kv-fileinput-caption {
        border-top-right-radius: 0 !important;
        border-bottom-right-radius: 0 !important;
    }

    .btn-same-width {
        width: 130px;
    }

    .bootstrap-tagsinput {
        min-height: 50px;
        -webkit-border-radius:;
        -moz-border-radius:;
        border-radius: 4px !important;
    }

    .profile-avatar{
        display: block;
        border-radius: 4px !important;
        width: 240px;
        height: 184px;
    }

    .avatar-cover{
        display: table-cell;
        background-color: rgba(192,192,192,0.3);
        height: 184px;
        position: absolute;
        width: 240px;
        cursor: pointer;
        border-radius: 4px !important;
    }

    .btn-edit-user-avatar{
        position: absolute;
        right: 0;
        bottom: 0 !important;
        color: #7d7d7d;
        opacity: 1;
    }

    .btn-edit-user-avatar:hover{
        color: white;
    }


    .res-image{
        max-height: 100%;
        border-left: 2px solid #ddd;
        margin: auto;
        padding: 0 10px;
        float: right;
        position: relative;
        max-width: 100%;
    }
</style>



<form role="form" method="post" id="form-general-info" enctype="multipart/form-data">
    <input type="text" class="form-control hidden" name="id" value="<?php echo $id ?>">

    <div class="row">
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label"><?php echo __("Họ và tên") ?></label>
                        <input type="text" class="form-control" name="name" value="<?php echo $name ?>">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label"><?php echo __("Mã nhân viên") ?></label>
                        <input type="text" class="form-control" name="code" value="<?php echo $code ?>">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label"><?php echo __("Tên tài khoản") ?></label>
                        <input type="text" class="form-control" readonly value="<?php echo $email ?>">
                    </div>
                </div>


            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label"><?php echo __("Birthday") ?></label>
                        <div class="input-group">
                            <input type="text" id="birthday" class="form-control input-datepicker border-no-radius-right"  placeholder="<?php echo date("d/m/Y")?>" value="<?php echo $birthday?>" name="birthday">
                            <span class="input-group-addon pointer access-input"  data-input="#birthday">
                                <i class="fas fa-calendar-alt"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label"><?php echo __("Thư điện tử") ?></label>

                        <div class="input-group">
                            <input type="text" class="form-control border-no-radius-right" name="contact_email"
                                   value="<?php echo $contactEmail ?>">
                            <span class="input-group-addon border-radius-right">
                                    <i class="fas fa-envelope"></i>
                                </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label"><?php echo __("Phone") ?></label>
                        <div class="input-group">
                            <input type="text" class="form-control border-no-radius-right" name="phone"
                                   value="<?php echo $phone ?>">
                            <span class="input-group-addon border-radius-right">
                            <i class="fas fa-phone"></i>
                        </span>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label"><?php echo __("Contact Email") ?></label>
                        <div class="input-group">
                            <input type="text" class="form-control border-no-radius-right" name="contact_email"
                                   value="<?php echo $contactEmail ?>">
                            <span class="input-group-addon border-radius-right">
                            <i class="fas fa-envelope"></i>
                        </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">{{ __("Quyền tài khoản") }}(<span class="text-required">*</span>)</label>
                        @include("Elements.cbb", [
                            'domeHtml' 		=> 'is_admin',
                            'nameHtml' 		=> 'is_admin',
                            'displayField'  => 'name',
                            'isNone'  	    => true,
                            'id'  	        => $isAdmin,
                            'valueField'  	=> 'is_admin',
                            'listData' 		=> $listIsAdmin,
                        ])
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">{{ __("Trạng thái") }}(<span class="text-required">*</span>)</label>
                        @include("Elements.cbb", [
                            'domeHtml' 		=> 'status',
                            'nameHtml' 		=> 'status',
                            'displayField'  => 'name',
                            'isNone'  	    => true,
                            'id'  	        => $status,
                            'valueField'  	=> 'id',
                            'listData' 		=> $listStatus,
                        ])
                    </div>
                </div>

            </div>


            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label"><?php echo __("Ngày tạo") ?></label>
                        <div class="input-group">
                            <input type="text" class="form-control border-no-radius-right"
                                   value="<?php echo $createdAt ?>" readonly>
                            <span class="input-group-addon border-radius-right">
                            <i class="fas fa-calendar"></i>
                        </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label"><?php echo __("Cập nhật lần cuối") ?></label>
                        <div class="input-group">
                            <input type="text" class="form-control border-no-radius-right"
                                   value="<?php echo $updatedAt ?>" readonly>
                            <span class="input-group-addon border-radius-right">
                            <i class="fas fa-calendar"></i>
                        </span>
                        </div>
                    </div>
                </div>


            </div>

        </div>
        <div class="col-md-2" style=" height: 210px;">
            <div class="row">
                <div class="res-image" >
                    <div class="form-group">
                        <label class="control-label"><?php echo __("Ảnh đại diện")?> :</label>
                        <div class="avatar-cover" style="height: 157px; width: 157px;">
                            <a role="button" class="btn btn-outline btn-edit-user-avatar dropdown-toggle"
                               data-toggle="dropdown" aria-expanded="false" style="padding: 6px;"
                            ><i class="fal fa-edit fa-2x" style="font-size: 1.5em;"></i></a>
                            <ul class="dropdown-menu pull-right">
                                <li>
                                    <a href="javascript:;" id="btn-change-avatar"> <?php echo __("Thay đổi")?> </a>
                                </li>
                                <li>
                                    <a href="javascript:;" id="btn-remove-avatar" data-id="<?php echo $id?>"> <?php echo __("Gỡ bỏ")?> </a>
                                </li>

                            </ul>
                        </div>
                        <img src="<?php echo $picturePath?>" class="profile-avatar" id="profile-avatar" style="height: 157px;width: 157px;">

                        <input type="file" name="avatar_hidden" class="hide" id="input-avatar-hidden" >
                    </div>
                </div>
            </div>
        </div>



    </div>




    <div class="form-group">
        <label class="control-label"><?php echo __("Giới thiệu") ?></label>
        <textarea class="form-control content-summernote" name="self_introduction" id="content-self-introduction"></textarea>
    </div>

    <hr>

    <div class="margin-top-10 text-center">
        <button type="submit" href="javascript:;" class="btn blue btn-same-width btn-smooth btn-same-width"><i
                class="fa fa-floppy-o"></i> <?php echo __("Lưu thay đổi") ?> </button>

    </div>
</form>

<script>
    $(document).ready(function(){
        activeSummerNote(500);
        $("#content-self-introduction").summernote("code", <?php echo json_encode($selfIntroduction)?>);

        $(document).on('click', '#btn-change-avatar', function() {
            var inputFile = $("#input-avatar-hidden");
            inputFile.click();

        });


        $(document).on('change', '#input-avatar-hidden', function() {

            var inputFile = $("#input-avatar-hidden");
            if(!inputFile.val()){
                return false;
            }

            var form = $("form#form-general-info")[0];
            var formData =  new FormData(form);

            $.loadingStart();
            $.ajax({
                url: APP.ApiUrl('admin/user/changeAvatar'),
                type: 'POST',
                data: formData,
                success: function (data) {
                    var response = $.parseJSON(data);
                    $.loadingEnd();
                    if (response.success) {
                        slideMessage(TRANSLATED_LABELS.lblSuccess, response.message, 'success');
                        //$("#avatar").attr('src', response.avatar_path);
                        $("#profile-avatar").attr('src', response.avatar_path);
                    }else{
                        slideMessage(TRANSLATED_LABELS.lblError, response.message, 'danger');
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });

        });

        $(document).on('click', '#btn-remove-avatar', function() {
            var id = $(this).attr('data-id');
            $.loadingStart();
            $.ajax({
                url: APP.ApiUrl('admin/user/removeAvatar'),
                type: 'POST',
                data: {id: id},
                success: function (data) {
                    var response = $.parseJSON(data);
                    $.loadingEnd();
                    if (response.success) {
                        slideMessage(TRANSLATED_LABELS.lblSuccess, response.alert, 'success');
                        $("#profile-avatar").attr('src', response.picture_path);
                    }else{
                        slideMessage(TRANSLATED_LABELS.lblError, response.alert, 'danger');
                    }
                },
                cache: false
            });

        });

    });
</script>



