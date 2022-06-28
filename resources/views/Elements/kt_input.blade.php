<?php
    $thumbnail  = $thumbnail ?? "avatar-thumbnail";
    $file_id    = $file_id ?? "avatar-file";
    $file_name  = $file_name ?? "avatar-file";
    $file_path  = $file_path ?? $current_domain.'/images/no_img.png';
?>
<style>

</style>
<div class="image-input image-input-outline">
    <div class="image-input-wrapper" id="{{ $thumbnail }}" style="background-image: url({{ $file_path }})"></div>

    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow icon-default" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
        <i class="fa fa-pencil icon-sm text-muted"></i>
        <input type="file" name="{{ $file_name }}" id="{{ $file_id }}" class="hide" accept=".png, .jpg, .jpeg"/>
        <input type="hidden" name="avatar_remove"/>
    </label>

    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
  <i class="ki ki-bold-close icon-xs text-muted"></i>
 </span>
</div>

<script>
    $(document).ready(function () {
        $(document).on("change", "#{{ $file_id }}", function(e){
            e.preventDefault();
            var file_path = URL.createObjectURL(this.files[0]);
            $('#{{ $thumbnail }}').css('background-image', 'url(' + file_path + ')');
        });
    });
</script>