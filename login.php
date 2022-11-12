<?php
    session_save_path("./sess");
    session_start();

    include "db.php";

    $conn = connectDB();

    //$id = $_POST["secureid"];
    //$pass = $_POST["securepass"];

    $id= $secureid;
    $pass = $securepass;


    $id = str_replace("-", "", $id);
    $id = str_replace(" ", "", $id);

    $sql = "select * from member where id='$id' and pass='$pass' ";
                                          
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($result);

    if($data)
    {
        $_SESSION["sess_id"] = $data["id"];
        $_SESSION["sess_name"] = $data["name"];
        echo "
        <script>
            alert('반갑습니다.');
            location.href='main.php';
        </script>
        ";
    }else
    {
        echo "
        <script>
            alert('아이디와 비번 확인하세요');
            location.href='main.php';
        </script>
        ";
    }
?>


<?php
    closeDB($conn);
?>

