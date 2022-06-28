<ul class="sticky-toolbar nav flex-column pl-2 pr-2 pt-3 pb-3 mt-4">

    <?php
        foreach ($listWallet as $key => $item){
            $id = $item->id;
            $is_selected = $item->is_selected;
            $picture = $item->picture;
            $wallet_picture_path = !empty($picture) ? url("public/uploads/Admin/CashWallet/".$item->id.'/'.$picture) : "";
            $active = $is_selected ? " active" : '';
            ?>
            <!--begin::Item-->
            <li class="nav-item mb-2"  data-toggle="tooltip" title="" data-placement="right" data-original-title="{{ $item->name }}">
                <a class="btn btn-sm btn-icon btn-bg-light btn-icon-success btn-hover-success select-wallet {{ $active }}" href="javascript:;" data-selected="{{ $is_selected }}" data-id="{{ $id }}">
                    <img src="{{ $wallet_picture_path }}" width="16px" height="16px">
                </a>
            </li>
            <!--end::Item-->
            <?php
        }
    ?>

</ul>

@include("Elements.modal_confirm", ['btnId' => "btn-change-wallet", "modalId" => "modalConfirmChangeWallet"])

<script>
    var lblHeaderConfirmChangeWallet = "{{ __("Confirm Change Wallet") }}";
    var lblContentConfirmChangeWallet = "{{ __("Are you sure you want to change wallet?") }}";

    $(document).ready(function () {
        $(document).on("click", ".select-wallet", function (e) {

            var id = $(this).attr('data-id');
            var is_selected = $(this).attr('data-selected');

            if(parseInt(is_selected)){
                slideMessage(TRANSLATED_LABELS.lblWarning, TRANSLATED_LABELS.lblCurrentWalletSelected, 'warning');
                return false;
            }

            $("#modalConfirmChangeWallet #header-confirm").text(lblHeaderConfirmChangeWallet);
            $("#modalConfirmChangeWallet #content-confirm").text(lblContentConfirmChangeWallet);

            $("#btn-change-wallet").attr('data-id', id);
            console.log("Wallet ID: "+id);
            showModal("#modalConfirmChangeWallet");
        });

        $(document).on("click", "#btn-change-wallet", function (e) {
            var id = $(this).attr("data-id");

            $.loadingStart();
            $.ajax({
                url: APP.ApiUrl('cash/cashApp/changeWallet'),
                type: 'POST',
                data: {id: id},
                success: function (data) {
                    var response = $.parseJSON(data);
                    $.loadingEnd();
                    if (response.success) {
                        slideMessage(TRANSLATED_LABELS.lblSuccess, response.message, 'success');
                        hideModal("#modalConfirmChangeWallet");
                        window.location.reload();
                    }else{
                        slideMessage(TRANSLATED_LABELS.lblError, response.message, 'danger');
                    }
                },
                cache: false
            });

        });
    });
</script>