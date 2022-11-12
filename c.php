<?php
    // id, pass
    $id = $_POST["id"];
    $pass = $_POST["pass"];

    if(isset($_POST["age"]))
        $age = $_POST["age"];
    else
        $age = 0;

    echo "입력 값 체크 $age<br>";
    echo "id = $id , pass = $pass 입니다.<br>";
    echo "id = " . $id . "이고, pass = " . $pass ."<br>";
?>