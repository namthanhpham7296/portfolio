<?php
$id = isset($user['id']) ? $user['id'] : '';
?>
<form method="post" id="form-change-password" enctype="multipart/form-data">
    <input class="form-control border-no-radius-right hide"  name="id" value="<?php echo $id?>">
    <?php if(1 == 0){?>
    <div class="form-group">
        <label class="control-label"><?php echo __("Mật khẩu hiện tại")?></label>
        <div class="input-group">
            <input class="form-control border-no-radius-right"  type="password" name="current_password">
            <span class="input-group-addon border-radius-right pointer show-password" data-show="0">
                <i class="far fa-eye-slash"></i>
            </span>
        </div>
    </div>
    <?php }?>
    <div class="form-group">
        <label class="control-label"><?php echo __("Mật khẩu mới")?></label>
        <div class="input-group">
            <input class="form-control border-no-radius-right"  type="password" name="password">
            <span class="input-group-addon border-radius-right pointer show-password" data-show="0">
                <i class="far fa-eye-slash"></i>
            </span>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label"><?php echo __("Nhập lại mật khẩu mới")?></label>

        <div class="input-group">
            <input class="form-control border-no-radius-right"  type="password" name="password_confirm">
            <span class="input-group-addon border-radius-right pointer show-password" data-show="0">
                <i class="far fa-eye-slash"></i>
            </span>
        </div>

    </div>
    <hr>

    <div class="margin-top-10 text-center">
        <button type="submit" href="javascript:;" class="btn blue btn-act-detail btn-smooth btn-same-width"><i
                class="fa fa-floppy-o"></i> <?php echo __("Lưu thay đổi") ?> </button>
    </div>
</form>
