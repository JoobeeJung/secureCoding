<?php
    include "db.php";
    include "register_global.php";

    register_globals();

    date_default_timezone_set("Asia/Seoul");

    $conn = connectDB();

    $sql = "select * from board_table where idx='$idx' ";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($result);

    $fname = $data["fname"]; // test.jpg
    $file_real = $data["file"]; // 2022010203123456.jpg

    $file = "data/$file_real";
    $file_size = filesize($file);
    $file_dest = urlencode($fname);

header("content-type:application/octet-stream; charset=utf-8;");
@header("content-length:".$file_size);
header('content-disposition:attachment;filename='.$file_dest);
header('content-description:PHP Generated Data');
header('Pragma:no-cache');
header('Expires:0');

if(is_file("$file"))
{
        $fp = fopen("$file", "r");
        if(!fpassthru($fp))
                fclose($fp);
}



closeDB($conn);
?>