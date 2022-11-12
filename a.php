<?php
    include "db.php";

    $conn = connectDB();
?>

<!doctype html>

<html>
<head>

</head>
<body>
HTML 영역입니다. <br>
<?php
    $i = 3;

    echo "$i<br>";
    $i = "홍길동";
    echo "$i<br>";

    for($i=1; $i<=10; $i++)
    {
        echo "$i<br>";
    }

    include "b.php";
    echo "after b $i<br>";
?>

<script>
    function checkError()
    {
        let regexp = /^[가-힣]{2,4}$/;
        if(!regexp.test(document.getElementById('id').value))
        {
            // document.querySelector('#id').value
            // $('$id').val()

            alert('이름은 한글로 2~4글자만 됩니다.');
            return false; 

        }
    }
</script>


<form method="POST" action="c.php" onSubmit="return checkError()">
ID <input type="text" name="id" id="id" > <br>
PW <input type="password" name="pass"><br>
<input type="submit" value="로그 인">

</form>

<?php
    $sql = "select * from first";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($result);

    if($data)
    {
        while($data)
        {
            $id = $data["id"];
            echo "id = $id , name = $data[name] <br>";
            $data = mysqli_fetch_array($result);
        }
    }

?>



</body>
</html>

<?php
    closeDB($conn);
?>