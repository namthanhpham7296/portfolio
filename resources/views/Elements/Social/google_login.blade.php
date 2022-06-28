<?php
    use App\Constant;
?>
<script>

    window.onload = function () {
        google.accounts.id.initialize({
            client_id: "<?php echo Constant::GOOGLE_OAUTH_CLIENT_ID;?>",
            callback: handleCredentialResponse
        });
        google.accounts.id.renderButton(
            document.getElementById("google-signin-inner"),
            { theme: "outline", size: "large" }  // customization attributes
        );
    };

    function handleCredentialResponse(googleUser) {
        $.loadingStart();
        $.ajax({
            url: APP.ApiUrl('auth/socialLogin'),
            type: 'POST',
            data: {
                _token: _token,
                type: "<?php echo Constant::REGISTER_TYPE_GOOGLE;?>",
                google_user: googleUser,
            },
            success: function (data) {
                var response = $.parseJSON(data);
                $.loadingEnd();

                if (response.success) {
                    slideMessage(TRANSLATED_LABELS.lblSuccess, response.message, 'success');
                    setTimeout(
                        window.location.href = response.url
                        , 300);
                }else{
                    slideMessage(TRANSLATED_LABELS.lblError, response.message, 'danger');
                }
            },
            cache: false
        });
    }

</script>