<?php
use App\Constant;
?>
<script>
    /// Cài đăt thư viện javascript SDK
    window.fbAsyncInit = function() {
        FB.init({
            appId      : "<?php echo Constant::FACEBOOK_APP_ID;?>",
            cookie     : true,
            xfbml      : true,
            version    : 'v13.0'
        });

        FB.AppEvents.logPageView();

    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));


    ///Gọi thực thi khi click button Login with facebook
    $(document).ready(function (e) {

        $(document).on("click", "#facebook-login", function (e) {
            FB.login(function(response) {

                /// Kiểm tra hiện tại đang có đăng nhập với facebook?
                if (response.status === 'connected') {
                    console.log("Logged into your webpage and Facebook.");
                    // Logged into your webpage and Facebook.
                } else {
                    /// Chưa đăng nhập sẽ gọi đăng nhập
                    if (response.authResponse) {
                        console.log('Welcome!  Fetching your information.... ');
                    } else {
                        console.log('User cancelled login or did not fully authorize.');
                    }
                }

                /// Sau khi đăng nhập hoàn tất sẽ gửi thông tin về server để xử lý các bước tiếp theo
                $.loadingStart();
                $.ajax({
                    url: APP.ApiUrl('auth/socialLogin'),
                    type: 'POST',
                    data: {
                        _token: _token,
                        type: "<?php echo Constant::REGISTER_TYPE_FACEBOOK?>",
                        facebookUser: response.authResponse,
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

            });
        });

    });

</script>