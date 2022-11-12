<?php
    function getDirs($path)
    {
        echo "path = $path <br>";
        $dirHandler = opendir($path);

        while( ($filename = readdir($dirHandler)) != false)
        {
            if(is_dir("$path/$filename"))
            {
                //echo "[+] $filename<br>";
                $files[] = $filename;
            }else
            {
                //echo "[-] $filename<br>";
            }
        }

        return $files;
    }

    function getFiles($path)
    {
        echo "path = $path <br>";
        $dirHandler = opendir($path);

        while( ($filename = readdir($dirHandler)) != false)
        {
            if(is_dir("$path/$filename"))
            {
                //echo "[-] $filename<br>";
                
            }else
            {
                //echo "[+] $filename<br>";
                $files[] = $filename;
            }
        }

        return $files;
    }

    function readFileSecure($path)
    {
        if(!$handler = fopen($path, 'r'))
        {
            return "File Open Error!!!";
        }

        $fileContent = file_get_contents($path, true);
        return $fileContent;
    }

    $sess_path = "sess_path";
    if(!isset($_SESSION[$sess_path]) or $_SESSION[$sess_path] == "")
    {
        $_SESSION[$sess_path] = "./";
    }

    // 경로를 알 수 있는 위치

    // pdata, pname

    if(isset($_POST["fdata"]) and isset($_POST["fname"]) and strlen($_POST["fname"]) >=1 )
    {
        //echo "<xmp>";
        //echo "fname =".  $_POST["fname"] . "<br>";
        //echo "fdata = ". $_POST["fdata"] . "<br>";
        //echo "</xmp>";

        $fileName = $_POST["fname"];

        $pathFile = $_SESSION[$sess_path] . "/" . $fileName;

        if(file_exists($pathFile))
        {
            // overwrite
            unlink($pathFile);
        }


        if(!$handler = fopen($pathFile, 'w'))
        {
            echo "File Open Error";
        }
        if( fwrite($handler, $_POST["fdata"]) == false )
        {
            echo "File write Error";
        }

        echo "
        <script> alert('성공');</script>
        <script>location.href='main.php?cmd=ftp';</script>
        ";
        
    }



    if(isset($_GET["pdir"]))
        $_SESSION[$sess_path] = $_GET["pdir"];

    $path = $_SESSION[$sess_path];

    $dir = getDirs($path);
    $files = getFiles($path);

    if($dir)
        sort($dir);
    
    if($files)
        sort($files);

?>

<div class="row">
    <div class="col">
        <table class="table table-bordered">
            <tr>
                <td>
                    <table class="table">
                    <?php
                    $cnt = 0;
                    while(isset($dir[$cnt]))
                    {
                        $nextDir = $_SESSION[$sess_path] . "/" . $dir[$cnt];
                       echo "
                       <tr>
                            <td><a href='main.php?cmd=ftp&pdir=$nextDir'>$dir[$cnt]</a></td>
                       </tr>
                       ";
                        $cnt ++;
                    }
                    ?>
                    </table>

                </td>
                <td>
                    <table class="table">
                    <?php
                    $cnt = 0;
                    while(isset($files[$cnt]))
                    {
                        $currentFile = $files[$cnt];
                       echo "
                       <tr>
                            <td><a href='main.php?cmd=ftp&rfile=$currentFile'>$files[$cnt]</a></td>
                       </tr>
                       ";
                        $cnt ++;
                    }
                    ?>
                    </table>

                </td>
            </tr>
        </table>
    </div>
    <?php
        if(isset($_GET["rfile"]))
        {
            $fileContent = readFileSecure($_SESSION[$sess_path] . "/" . $_GET["rfile"]);
        }else
        {
            $fileContent = "";
        }

        
    ?>

    <form method="post" action="<?php echo $_SERVER["PHP_SELF"] ?>?cmd=ftp">
    <div class="row">
        <div class="col">
            <textarea class="form-control" name="fdata" rows="5"><?php echo $fileContent?></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col">파일명</div>
        <div class="col"><input type="text" name="fname" id="fname" required class="form-control" placeholder="파일명입력"></div>
        <div class="col">
            <button type="submit" class="btn btn-primary">등록</button>
        </div>
    </div>

    </form>
</div>