brute2 

<?php
    set_time_limit(0);
    ini_set('memory_limit','-1');

    $letters ="abc12345defghijklmnopqrstuvwxyz";
    $size = strlen($letters);

    if(!isset($cnt))
        $cnt = 129780;

    echo "cnt = $cnt <br>";

    $first = (int) (((int)(( (int)($cnt -1) / $size) / $size)) / $size)  % $size;
    $second = (int)(( (int)($cnt -1) / $size) / $size)  % $size;   // 몫 -> 몫 -> 나머지
    $third = ((int)(($cnt -1) / $size)) % $size ; // 몫 --> 나머지
    $fourth = ($cnt -1) % $size;

    $pw = $letters[$first] . $letters[$second] . $letters[$third] . $letters[$fourth] ;
    echo "pw = $pw<br>";
    echo "$QUERY_STRING<br>";
    echo "$REMOTE_ADDR<br>";

    $sql = "select * from member where id='test' and  pass='$pw'";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($result);

    if($data)
    {
        echo "FIND !!!! teset의 비밀번호는 $pw ";
        exit();
    }


    $cnt ++;

    if($cnt > $size * $size * $size * $size)
        exit();

    $sleepMs = rand(1, 3000);
    $sleepMs = 10;
    echo "sleepMs = $sleepMs<br>";
    echo "
    <script>
        setTimeout(function(){
            location.href='main.php?cmd=brute2&cnt=$cnt';
        }, $sleepMs);
    </script>
    ";

    // main.php?cmd=brute2&cnt=$cnt
?>