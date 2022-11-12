<?php
    session_save_path("./sess");
    session_start();

    $who = $_SESSION["sess_name"];

    session_destroy();
    echo "
    <script> 
        alert('$who 님 안녕히 가세요');
        location.href='main.php';
    </script>
    ";
?>