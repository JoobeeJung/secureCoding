<?php
    $sendMsg = "비정상적인 접속입니다.
http://test.com";

    //include "sendSMS.php";

    if(isset($_POST["smsMsg"]))
    {
        $sendMsg = $smsMsg;
        include "sendSMS.php";
    }
?>

<form method="post" action="main.php?cmd=sms">
<div class="row">
    <div class="col">수신자</div>
    <div class="col">
        <input type="text" name="rphone" value="010-1234-5678" class="form-control">
    </div>

</div>
<div class="row">
    <div class="col-3">내용</div>
    <div class="col-3">
        <textarea name="smsMsg" class="form-control" rows="5"></textarea>
    </div>
    <div class="col">
        <button type="submit" class="btn btn-primary">전송</button>
    </div>
</div>
</form>