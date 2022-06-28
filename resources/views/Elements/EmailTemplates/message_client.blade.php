<?php

$fullName  = isset($data['name']) ? $data['name'] : '';
$message   = isset($data['message']) ? $data['message'] : '';
$subject   = isset($data['company']['name']) ? $data['company']['name'] : '';

?>
<div style="">
    <span style="line-height: 2;"><b><?php echo $fullName;?></b></span> Dear,<br/>
</div>

<div style="margin-top: 20px;">
    <span style="line-height: 2; padding-left: 20px;">{{__("Your request have been sent")}}.</span><br/>
    <span style="line-height: 2; padding-left: 20px;">{{__("Our team will handle your request soon")}}.</span><br/>
    <span style="line-height: 2; padding-left: 20px;">{{__("Your message")}}: {{$message}}.</span>
</div>

<div style="margin-top: 20px;">
    <span style="line-height: 2;">有限会社永商ベルシア絨毯ギャラリー</span>
</div>
