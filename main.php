<?php
    session_save_path("./sess");
    session_start();

    include "db.php";
    include "register_global.php";

    register_globals();

    date_default_timezone_set("Asia/Seoul");

    $conn = connectDB();

    if(isset($_GET["cmd"]))
        $cmd = $_GET["cmd"];
    else
        $cmd = "";


?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="css/style.css" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script> 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/md5.js"></script>
 
 <script>
    function getCookieOld(name) // secureid, securepass
    {
        var search = name + '=';
        // javascript:alert(document.cookie);
        if(document.cookie.length >0)
        {
            offset = document.cookie.indexOf(search);

            if(offset != -1)
            {
                offset += search.length;
                end = document.cookie.indexOf(';', offset);
                if(end == -1)
                    end = document.cookie.length;

                var returnValue = unescape(document.cookie.substring(offset, end));

                return returnValue;
            }
        }
    }

    function getCookieIfSaveOld()
    {
        if(getCookieOld('secureid'))
        {
            var thisid = getCookieOld('secureid');

            var decrypto = CryptoJS.enc.Base64.parse(thisid);
            document.querySelector('#secureid').value = decrypto.toString(CryptoJS.enc.Utf8);
            document.querySelector('#idsave').checked = true;
        }

        if(getCookieOld('securepass'))
        {
            var thispass = getCookieOld('securepass');

            var decrypto = CryptoJS.enc.Base64.parse(thispass);

            document.querySelector('#securepass').value = decrypto.toString(CryptoJS.enc.Utf8);
            document.querySelector('#passsave').checked = true;
        }
    }

    function setCookie(name, value, expiredays)
    {
        //alert('name = ' + name + ', value = ' + value + ', ed =' + expiredays)
        var todayDate = new Date();
        todayDate.setDate(todayDate.getDate() + expiredays );

        let key = CryptoJS.enc.Utf8.parse(value);
        let base64 = CryptoJS.enc.Base64.stringify(key);
        
        document.cookie = name + '=' + base64 + ';path=/; expires=' + todayDate.toGMTString() + ';';
        //alert(document.cookie);
    }
  </script>
</head>
<body>
    <?php
        $rand1 = rand(1,255);
        $rand2 = rand(1,255);
        $rand3 = rand(1,255);
        $rand4 = rand(1, 255);

        $REMOTE_ADDR = $rand1 . "." . $rand2 . "." . $rand3 . "." . $rand4;

        $sql = "INSERT INTO log_table (ip, work, time) 
                    values ( '$REMOTE_ADDR', '$QUERY_STRING', now() )";
        $result = mysqli_query($conn, $sql);
        
        $sql = "select * from black_table where ip='$REMOTE_ADDR' ";
        $result = mysqli_query($conn, $sql);
        $data = mysqli_fetch_array($result);

        if($data)
        {
            $sql = "update black_table set reject = reject +1 where ip='$REMOTE_ADDR'";
            $result = mysqli_query($conn, $sql);

           echo "
           <script>
                location.href='http://warning.or.kr';
           </script>
           "; 

           exit();
        }


        $sql = "SELECT * from log_table 
                where ip='$REMOTE_ADDR'  and
                time >= adddate(now(), interval -10 second)
                ";
                //echo "$sql <br>";
        $result = mysqli_query($conn, $sql);
        $connCount = mysqli_num_rows($result);
        if($connCount > 10 )
        {
            

            $sendMsg = "불법 접속!!!!";
            //include "sendSms.php";

            // 블랙리스트..
            $sql = "select * from black_table where ip='$REMOTE_ADDR' ";
            $result = mysqli_query($conn, $sql);
            $data = mysqli_fetch_array($result);

            if($data)
            {
                $sql = "update black_table set reject = reject +1 where ip='$REMOTE_ADDR'";
                $result = mysqli_query($conn, $sql);
            }else
            {
                $sql = "insert into black_table (ip, reject, time) 
                        values('$REMOTE_ADDR', '1', now())";
                $result = mysqli_query($conn, $sql);
            }
        }
    ?>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <div class="container">
    <a class="navbar-brand text-white" href="#">HOME</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown">Attack Test</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="main.php?cmd=board">게시판</a></li>
            <li><a class="dropdown-item" href="main.php?cmd=ftp">Web FTP</a></li>
            <li><a class="dropdown-item" href="main.php?cmd=shell">Web Shell</a></li>
            <li><a class="dropdown-item" href="main.php?cmd=upload">File Upload</a></li>
            <li><a class="dropdown-item" href="main.php?cmd=brute">Brute Force</a></li>
            <li><a class="dropdown-item" href="main.php?cmd=brute2">Brute Force</a></li>
            <li><a class="dropdown-item" href="main.php?cmd=chart">Google Chart</a></li>
            <li><a class="dropdown-item" href="main.php?cmd=sms">SMS</a></li>
            <li><a class="dropdown-item" href="main.php?cmd=crawling">Crawling</a></li>
            <li><a class="dropdown-item" href="main.php?cmd=fake">Fake Data</a></li>
            <li><a class="dropdown-item" href="main.php?cmd=log">Flag Log</a></li>
        
        
        </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col"><h5 class="text-primary">메인 페이지</h5></div>
    </div>
    <?php
        if(isset($_SESSION["sess_id"]))
        {
            ?>
            <div class="row">
                <div class="col text-end">
                    <button type="button" class="btn btn-primary" onClick="location.href='logout.php';"><?php echo $_SESSION["sess_name"] ?>님 로그아웃</button>
                </div>
            </div>
            <?php
        }else
        {
            include "printLogin.php";
        }

    ?>


<?php
    if($cmd and file_exists("$cmd.php"))
        include "$cmd.php";
?>

</body>
</html>
<?php
    closeDB($conn);
?>
