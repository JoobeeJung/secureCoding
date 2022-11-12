<?php
    // 순서, IP, WORK, Flag, 비고
    function ip2country($ip)
    {
        // ip = 1.2.3.4
        $splitIP = explode(".", $ip);
        //echo "ip_files/" . $splitIP[0] . ".php <br>";
        include "ip_files/" . $splitIP[0] . ".php";
        
        $code = ( $splitIP[0] * 16777216) + ($splitIP[1] * 65536 ) + ($splitIP[2] * 256 ) + ($splitIP[3]);

        foreach($ranges as $key => $value)
        {
            if($key <= $code)
            {
                if($ranges[$key][0] >=$code)
                    $country = $ranges[$key][1]; break;
            }
        }

        if(!isset($country))
            $country = "";

        if(isset($country) and $country == "")
            $country = "noflag";

        return $country;
    }
?>
<div class="row">
    <div class="col">순서</div>
    <div class="col">IP</div>
    <div class="col">접속시간</div>
    <div class="col">작업내용</div>
    <div class="col">Flag</div>
    <div class="col">비고</div>
</div>

<?php
    $sql = "select * from log_table order by idx desc limit 30";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($result);

    $cnt = 0;
    while($data)
    {
        $cnt ++;

        $nation = ip2country($data["ip"]);
        $nationFlag = "<img src='flags/$nation.gif'>";

        ?>
        <div class="row">
            <div class="col"><?php echo $cnt?></div>
            <div class="col"><?php echo $data["ip"]?></div>
            <div class="col"><?php echo $data["time"]?></div>
            <div class="col"><?php echo $data["work"]?></div>
            <div class="col"><?php echo $nationFlag ?></div>
            <div class="col">비고</div>
        </div>    
        <?php    
        $data = mysqli_fetch_array($result);
    }
?>