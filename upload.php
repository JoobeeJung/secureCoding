<?php

    function getNow()
    {
        $tmp = Date('G');
        if($tmp <10)
            $ret = Date('Ymd0Gis');
        else
            $ret = Date('YmdGis');

        $ret = Date('YmdHis');
        return $ret;
    }

    function getFileExt($file)
    {
        //$file = strtolower($file);
        $fileInfo = pathinfo($file);
        return $fileInfo["extension"];

        // a.jpg.php
        // .git
        // README
    }

    $now = getNow();

    echo "now = $now<br>";

    if(isset($_FILES["upfile"]) and strlen($_FILES["upfile"]["name"]))
    {
        // 업로드 처리
        echo "name = " . $_FILES["upfile"]["name"] . "<br>";
        echo "size = " . $_FILES["upfile"]["size"] . "<br>";

        // 테스트문서.jpg
        // 20220921163456.jpg

        $fileName = $_FILES["upfile"]["name"];
        $ext = getFileExt($fileName);
        $saveFile = "$now.$ext";

        echo "file name = $fileName , saveFile = $saveFile<br>";

        chmod("data", 0777);
        move_uploaded_file($_FILES["upfile"]["tmp_name"], "data/$saveFile");
        chmod("data/$saveFile", 0777);

        echo "
        <div class='row'>
            <div class='col-2'>
                <img src='data/$saveFile' class='img-fluid rounded'>
            </div>
        </div>
        ";

    }

?>

<form method="post" enctype="multipart/form-data" action="main.php?cmd=upload">
<div class="row">
    <div class="col-2">File</div>
    <div class="col-9">
        <input type="file" class="form-control" name="upfile"></div>
    <div class="col">
        <button type="submit" class="btn btn-primary">Go</button>
    </div>
</div>
</form>