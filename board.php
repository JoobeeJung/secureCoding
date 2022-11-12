<?php
    if(isset($_GET["mode"]))
        $mode = $_GET["mode"];
    else
        $mode = "list";

    if($mode == "list")
    {
        $sql = "select * from $board order by idx desc";
        $result = mysqli_query($conn, $sql);
        $data = mysqli_fetch_array($result);
        ?>
        <div class="row">
            <div class="col-1 text-center">순서</div>
            <div class="col-9 text-center">제목</div>
            <div class="col-2 text-center">작성자</div>
        </div>

        <?php

        while($data)
        {
            ?>
            <div class="row">
                <div class="col-1 text-center"><?php echo $data["idx"]?></div>
                <div class="col-9 ellipsis" ><a href='main.php?cmd=board&mode=show&idx=<?php echo $data["idx"]?>'><?php echo $data["title"]?></a></div>
                <div class="col-2 text-center"><?php echo $data["name"]?></div>
            </div>
            <?php
            $data = mysqli_fetch_array($result);
        }
        ?>
            <div class="row">
                <div class="col">
                    
                    <button type="button" class="btn btn-primary" onClick="location.href='main.php?cmd=board&mode=write' ">
                        <span class="material-icons">edit</span>글쓰기</button>
                </div>
                <div class="col">검색, 페이지</div>
            </div>
        <?php

    }

    if($mode == "show")
    {
        $idx = $_GET["idx"];
        $sql = "select * from $board where idx='$idx' ";
        $result = mysqli_query($conn, $sql);
        $data = mysqli_fetch_array($result);

        if($data)
        {
            $data["content"] = nl2br($data["content"]);

            ?>
            <div class="row">
                <div class="col-2">제목</div>
                <div class="col">
                    <?php echo $data["title"] ?>
                </div>
            </div>

        <div class="row">
            <div class="col-2">작성자</div>
            <div class="col">
            <?php echo $data["name"] ?>
            </div>
        </div>

        <div class="row">
            <div class="col-2">내용</div>
            <div class="col">
            <?php echo $data["content"] ?>
            </div>
        </div>

        <div class="row">
            <div class="col-2">첨부</div>
            <div class="col">
                <?php
                    if($data["file"])
                    {
                        echo "<a href='download.php?idx=$data[idx]'>$data[fname]</a>";
                    }
                ?>
            </div>
        </div>
      



        <div class="row">
            <div class="col text-center">
                <button type="button" class='btn btn-primary'>수정,댓글,삭제</button>
                <button type="button" class="btn btn-primary" onClick="location.href='main.php?cmd=board' ">목록</button>
            </div>
        </div>
            <?php
        }else
        {
            ?>
            <script>
                alert('삭제된 글입니다.');
                location.href='main.php?cmd=board';
            </script>
            <?php
        }
    }

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


    if($mode == "dbwrite")
    {
        $now = getNow();


        $name = $_POST["name"];
        $title = $_POST["title"];
        $content = $_POST["content"];

        $content = str_replace("<", "&lt;", $content);
        $content = str_replace(">", "&gt;", $content);

        $content = addslashes($content);
        // 이런 함수가 없으면, 사용자 정의 함수 만들면 편하다.

        if(isset($_FILES["upfile"]) and strlen($_FILES["upfile"]["name"]))
        {
            // 업로드 처리
            echo "name = " . $_FILES["upfile"]["name"] . "<br>";
            echo "size = " . $_FILES["upfile"]["size"] . "<br>";
    
            // 테스트문서.jpg
            // 20220921163456.jpg
    
            $fileName = $_FILES["upfile"]["name"];
            $ext = getFileExt($fileName);

            if($ext =="jpg" or $ext == "jpeg" or $ext =="pdf" or $ext=="txt")
            {

            }else
            {
                echo "
                <script>
                    alert('비정상적인 접근입니다.Error Code : 3');
                    location.href='main.php';
                </script>
                ";

                exit();

            }

            $saveFile = "$now.$ext";
    
            echo "file name = $fileName , saveFile = $saveFile<br>";
    
            chmod("data", 0777);
            move_uploaded_file($_FILES["upfile"]["tmp_name"], "data/$saveFile");
            chmod("data/$saveFile", 0777);
    
    
        }else
        {
            $fileName = "";
            $saveFile = "";
        }

        $sql = "insert into $board (title, name, content, file, fname)
                        values ('$title', '$name', '$content', '$saveFile', '$fileName')";
        $result = mysqli_query($conn, $sql);
        if($result)
        {
            ?>
            <script>
                alert('성공했습니다.');
                location.href='main.php?cmd=board';
            </script>
            <?php
        }
    }
    if($mode == "write")
    {
        ?>
        <form method="post" enctype="multipart/form-data"  action="main.php?cmd=board&mode=dbwrite">
        <div class="row">
            <div class="col-2">제목</div>
            <div class="col">
                <input type="text" name="title" id="title" placeholder="제목 입력" required class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="col-2">작성자</div>
            <div class="col">
                <input type="text" name="name" id="name" placeholder="작성자" value="<?php if(isset($_SESSION["sess_name"])) echo $_SESSION["sess_name"] ?>" required class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="col-2">내용</div>
            <div class="col">
                <textarea name="content" id="content" rows="8" placeholder="내용 입력" required class="form-control"></textarea>
            </div>
        </div>

        <script>
            function checkFile(obj)
            {
                //alert(obj.value); // a.JPG
                var ext = obj.value.split('.').pop().toLowerCase();
                //alert(ext);

                if($.inArray(ext, ['jpg', 'jpeg', 'png', 'txt', 'xls', 'xlsx', 'pdf']) == -1)
                {
                    alert(ext + ' 파일은 업로드 불가');
                    obj.value = "";
                    return;
                }    

                // 특수문자 체크
                var pattern = /[\[\]\{\}%\$\'\"\=]/gi;
                if(pattern.test(obj.value)) 
                {
                    alert('파일명에 특수문자는 사용할 수 없습니다.');
                    obj.value = "";
                    return;
                }

                // 확장자도 정상, 특수문자도 없고..
                // 이미지인 경우에는 미리보기

                previewImage(obj);
            }

            function previewImage(obj)
            {
                if(obj.files && obj.files[0])
                {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        document.querySelector('#preview').src = e.target.result;
                    };
                    reader.readAsDataURL(obj.files[0]);
                }   
            }
        </script>


        <div class="row">
            <div class="col-1">파일</div>
            <div class="col-1">
                <img id="preview" class="img-fluid rounded">

            </div>
            <div class="col">
                <input type="file" onChange="checkFile(this)" accept="image/*" name="upfile" class="form-control">
            </div>
        </div>



        <div class="row">
            <div class="col text-center">
                <button type="submit" class='btn btn-primary'>완료</button>
                <button type="button" class="btn btn-primary" onClick="location.href='main.php?cmd=board' ">목록</button>
            </div>
        </div>

        </form>
        <?php
    }
?>