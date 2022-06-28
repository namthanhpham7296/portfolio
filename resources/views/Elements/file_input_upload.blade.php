
<?php
    use App\Constant;
$domId              = isset($domId) ? $domId : 'upload-input';
$domName            = str_replace('-', '_', $domId);
$domName            = isset($nameHtml) ? $nameHtml : str_replace('-', '_', $domId);
$accept             = isset($accept) ? $accept : '*';
$filePath           = isset($filePath) ? $filePath : "";
$caption            = isset($caption) ? $caption : '';
$showUpload         = isset($showUpload) && $showUpload ? true : false;
$showPreview        = isset($showPreview) && !$showPreview ? false : true;
$showDownload        = isset($showDownload) && !$showDownload ? false : true;
$browseLabel        = isset($browseLabel) ? __($browseLabel) : __('Upload');
$browseIcon         = isset($browseIcon) ? $browseIcon : "fas fa-folder-open";
$removeLabel        = isset($removeLabel) ? __($removeLabel) : __('Remove');
$uploadLabel        = isset($uploadLabel) ? __($uploadLabel) : __('Upload');
$maxFile            = isset($maxFile) ? $maxFile : 1;
$multiple           = isset($multiple) && $multiple ? 'multiple' : '';
$browseOnZone       = isset($browseOnZone) && $browseOnZone ? true : false;
$deletePath         = isset($deletePath)? $deletePath : null;
$overwriteInitial	= isset($overwriteInitial) ? $overwriteInitial : true;
$allowedFileExtensions = isset($allowedFileExtensions) ? $allowedFileExtensions : [];
$maxFileSize 		= isset($maxFileSize) ? $maxFileSize : 10240;
$isVideo			= isset($isVideo) && $isVideo ? $isVideo : Constant::STATUS_INACTIVE;
$data_type			= isset($data_type)  ? $data_type : '';
?>

<input id="<?php echo $domId;?>" type="file" data-type="{{ $data_type }}" accept="<?php echo $accept;?>" name="<?php echo $domName;?>" <?php echo $multiple?>>
<script>
    $(document).on('ready', function() {


        $("<?php echo "#".$domId;?>").fileinput({
            <?php if($overwriteInitial) { ?>
            overwriteInitial: true,
            <?php } else { ?>
            overwriteInitial: false,
            <?php } ?>
                <?php if($filePath != ""){?>
            initialPreview: [<?php echo $filePath && is_array($filePath) ? implode(",", $filePath) : "'$filePath'";?>],
            initialPreviewAsData: true,
            initialPreviewConfig:[
                {
                    caption: "<?php echo $caption;?>"
                    <?php if($isVideo == 1) { ?>
                    ,type: "video"
                    ,filetype: "video/mp4"
                    <?php } elseif($isVideo == 2) { ?>
                    ,type: "audio"
                    ,filetype: "audio/mp3"
                    <?php } ?>

                    <?php if($deletePath){?>
                    ,url: "<?php echo $deletePath?>" // server delete action
                    <?php }?>

                    <?php if($filePath){?>
                    ,downloadUrl: "<?php echo $filePath?>" // server delete action
                    <?php }?>

                }

            ],
            <?php }?>
            language: 'en',
            showCaption: true,
            showDownload: true,

            <?php if($showPreview){?>
            showPreview: true,
            <?php }else{?>
            showPreview: false,
            <?php }?>

            showRemove: true,
            maxFileCount: <?php echo $maxFile?>,

            <?php if($browseOnZone){?>
            browseOnZoneClick: true,
            <?php }?>

            showUploadedThumbs: true,

            <?php if($showUpload){?>
            showUpload: true,
            <?php }else{?>
            showUpload: false,
            <?php }?>

            showCancel: false,
            previewFileType: ['image', 'html', 'text', 'video', 'audio', 'flash', 'object'],
            allowedPreviewTypes: ['image', 'html', 'text', 'video', 'audio', 'flash', 'object'],
            browseClass: "btn btn-success",
            browseLabel: "<?php echo $browseLabel;?>",
            browseIcon: "<i class=\"<?php echo $browseIcon;?>\"></i> ",
            removeClass: "btn btn-danger",
            removeLabel: "<?php echo $removeLabel;?>",
            removeIcon: "<i class=\"glyphicon glyphicon-trash\"></i> ",
            uploadClass: "btn btn-info",
            uploadLabel: "<?php echo $uploadLabel;?>",
            uploadIcon: "<i class=\"far fa-upload\"></i> ",
            dropZoneTitle: "<?php echo __("Kéo & thả file vào đây") ?>...",
            dropZoneClickTitle: "<br>(hoặc click để chọn file)",
            msgPlaceholder: "<?php echo __("Chọn file") ?>...",
            msgSizeTooLarge: '<?php echo __("File") ?> "{name}" (<b>{size} KB</b>) <?php echo __("exceeds maximum allowed upload size of") ?> <b>{maxSize} KB</b>. <?php echo __("Please reduce for file size") ?>',
            <?php if($allowedFileExtensions) { ?>
            allowedFileExtensions: '<?php echo json_encode($allowedFileExtensions) ?>',
            <?php } ?>



            previewFileIconSettings: { // configure your icon file extensions
                'doc': '<i class="fas fa-file-word text-primary"></i>',
                'xls': '<i class="fas fa-file-excel text-success"></i>',
                'ppt': '<i class="fas fa-file-powerpoint text-danger"></i>',
                'zip': '<i class="fas fa-file-archive text-muted"></i>',
                'txt': '<i class="fas fa-file-alt text-info"></i>',
                'htm': '<i class="fas fa-file-code text-info"></i>'
            },
            previewFileExtSettings: { // configure the logic for determining icon file extensions
                'doc': function(ext) {
                    return ext.match(/(doc|docx)$/i);
                },
                'xls': function(ext) {
                    return ext.match(/(xls|xlsx)$/i);
                },
                'ppt': function(ext) {
                    return ext.match(/(ppt|pptx)$/i);
                },
                'zip': function(ext) {
                    return ext.match(/(zip|rar|tar|gzip|gz|7z)$/i);
                },
                'htm': function(ext) {
                    return ext.match(/(htm|html)$/i);
                },
                'txt': function(ext) {
                    return ext.match(/(txt|ini|csv|java|php|js|css)$/i);
                }
            },
            fileActionSettings: {
                zoomTitle: "{{ __("View details") }}",
                downloadTitle: "{{ __("Download") }}",
                removeTitle: "{{ __("Delete") }}",
                removeIcon: '<i class="far fa-trash"></i>',
                uploadIcon: '<i class="far fa-upload"></i>',
                uploadRetryIcon: '<i class="glyphicon glyphicon-repeat"></i>',
                downloadIcon: '<i class="far fa-download"></i>',
                zoomIcon: '<i class="far fa-search"></i>',
                dragIcon: '<i class="glyphicon glyphicon-move"></i>',


            }
        });
    });
</script>
