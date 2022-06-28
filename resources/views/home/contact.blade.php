<?php
    use App\Constant;
    $turn_off_recaptcha = $setting->turn_off_recaptcha ?? 0;
?>
<form method="POST" id="form-contact-email" class="bg-light p-4 p-md-5 contact-form"  enctype="multipart/form-data">
    {!! csrf_field() !!}
    <div class="form-group">
        <input type="text" class="form-control" name="name" placeholder="Your Name" required>
    </div>
    <div class="form-group">
        <input type="text" class="form-control" name="email" placeholder="Your Email" required>
    </div>
    <div class="form-group">
        <input type="text" class="form-control" name="subject" placeholder="Subject" required>
    </div>
    <div class="form-group">
        <textarea name="message" id="message" cols="30" rows="7" class="form-control" placeholder="Message" required></textarea>
    </div>
    @if(!$turn_off_recaptcha)
        <div class="input-box" style="padding-top: 10px; padding-bottom: 10px;">
            <div class="g-recaptcha" data-sitekey="<?php echo Constant::GOOGLE_SITE_KEY; ?>"></div>
        </div>
    @endif
    <div class="form-group">
        <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
    </div>
</form>

<script type="text/javascript">
    $(document).ready(function(e){
        sendEmail();
    });

    function sendEmail(){
        $("form#form-contact-email").submit(function(e){
            e.preventDefault();
            var formData = new FormData(this);
            $.loadingStart();
            $.ajax({
                url: APP.ApiUrl('sendContactMail'),
                type: 'POST',
                data: formData,
                success: function(resp){
                    var response = $.parseJSON(resp);
                    $.loadingEnd();
                    grecaptcha.reset();
                    if(response.success){
                        $("form#form-contact-email")[0].reset();
                        slideMessage(TRANSLATED_LABELS.lblSuccess, response.message, "success");
                    }else{
                        slideMessage(TRANSLATED_LABELS.lblError, response.message, "danger");
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });

    }
</script>
