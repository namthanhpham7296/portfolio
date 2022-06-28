<?php

use App\Constant;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;

$authUser = Auth::user();
$lang_key = $authUser->lang_key ?? 'en';
$company_id = $authUser->company_id ?? null;

?>


<script>
    var TRANSLATED_LABELS = {
        lblError        : "{{ __('Error') }}",
        lblSuccess      : "{{ __('Success') }}",
        lblWarning      : "{{ __('Warning') }}",
        lblUpload       : "{{ __('Upload') }}",
        lblDelete       : "{{ __('Delete') }}",
        lblDetail       : "{{ __('Details') }}",
        lblReply       : "{{ __('Reply') }}",
        lblLock         : "{{ __('Khóa') }}",
        lblUnlock       : "{{ __('Unlock') }}",
        lblAdd          : "{{ __('Add new') }}",
        lblActive         : "{{ __('Active') }}",
        lblConfirm         : "{{ __('Confirm') }}",
        lblHeaderDelete         : "{{ __('Confirm Delete') }}",
        lblConfirmDelete         : "{{ __('Are you sure you want to delete this record?') }}",
        lblConfirmDeleteAll         : "{{ __('Are you sure you want to delete all this record?') }}",
        lblCurrent         : "{{ __('Current') }}",
        lblDownload         : "{{ __('Download') }}",
        lblNew         : "{{ __('New') }}",
        lblProcessing         : "{{ __('Processing') }}",
        lblResolved         : "{{ __('Resolved') }}",
        lblCanceled         : "{{ __('Canceled') }}",
        lblProfile         : "{{ __('Profile') }}",
        lblServices         : "{{ __('Services') }}",
        lblDeleteSuccess         : "{{ __('Delete Success') }}",
        lblAccess         : "{{ __('Access') }}",
        lblDeleteError         : "{{ __('Delete Error') }}",
        lblCalculator         : "{{ __('Calculator data') }}",
        lblExport         : "{{ __('Export') }}",
        lblImport         : "{{ __('Export') }}",
        lblCurrentWalletSelected         : "{{ __('You are selected current wallet') }}",
        lblYes         : "{{ __('Yes') }}",
        lblApproval         : "{{ __('Approval') }}",
        lblApproved         : "{{ __('Approved') }}",
        lblNo         : "{{ __('No') }}",
        lblEdit         : "{{ __('Edit') }}",
        lblPlay         : "{{ __('Play') }}",
        lblGalleries         : "{{ __('Galleries') }}",
        lblMonday         : "{{ __('Monday') }}",
        lblTuesday         : "{{ __('Tuesday') }}",
        lblWednesday         : "{{ __('Wednesday') }}",
        lblThursday         : "{{ __('Thursday') }}",
        lblFriday         : "{{ __('Friday') }}",
        lblSaturday         : "{{ __('Saturday') }}",
        lblSunday         : "{{ __('Sunday') }}",
        lblDefault         : "{{ __('Default') }}"

    };

    var SYSTEM_CONSTANT = {
        STATUS_ACTIVE : <?php echo Constant::STATUS_ACTIVE;?>,
        STATUS_INACTIVE : <?php echo Constant::STATUS_INACTIVE;?>,
        TA_ADMIN : "{{ \App\Constant::TA_ADMIN }}",
        COMPANY_ID : "{{ $company_id }}"
    };

    var PUBLIC_PATH = "{{ $current_domain.'/public' }}";
    var DEFAULT_TIME = 1;
    var SYSTEM_CACHE = " <?php echo Constant::SYSTEM_CACHE;?>";
    var lang_key = "<?php echo $lang_key;?>";
    var lastChange;
    var dateFormat = lang_key == "en" ? "mm/dd/yyyy" : "dd/mm/yyyy";
</script>
