<?php
    $fullName  = isset($data['name']) ?$data['name'] : '';
    $email     = isset($data['email']) ?$data['email'] : '';
    $message   = isset($data['message']) ?$data['message'] : '';
?>

<div style="margin-top: 10px;">
    <span style="line-height: 2; padding-left: 20px; ">{{__("You have a request sent from")}} <?php echo $fullName;?> {{__("with email")}}: <?php echo $email ?>.</span><br/>
    <span style="line-height: 2; padding-left: 20px;">{{__("Message")}}: <?php echo $message;?></span><br/>
</div>

<p style="font-weight:normal;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif;line-height:1.7;margin-bottom:1.3em;font-size:15px;color:#47505e">
    ***********************<br>
    有限会社永商  ペルシア絨毯ギャラリー,<br>
    東京都目黒区中目黒5-27-1,<br>
    Tel:  03-5722-0006<br>
    ***********************
</p>
