<?php
    if(!isset($page))
        $page = 1;

    // page : start
    // 1    : 1
    // 2    : 11
    // 3    : 21

    $start = ($page -1)* 10 + 1;

    $REQURL = "https://search.naver.com/search.naver?where=news&ie=utf8&sm=nws_hty&query=삼성전자" . "&start=$start";

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $REQURL); // URL 지정
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // 요청결과를 문자열로 반환
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 원격서버의 인증서 유효성 검사
    $response = curl_exec($curl);

    // response 쪼개서 DB에 저장
    /*
        aaaaa news_tit="dfdfdf"</a>dfkdkfkd news_tit="aaa"</a>dskfdsafd
        JAVA : tokenizer
        JS : str.split()
        PHP : explode()
    */

    $splitResponse = explode("news_tit", $response);
    for($i=1; $i < count($splitResponse); $i++)
    {
        $splitTitle = explode("</a>", $splitResponse[$i]);
        $splitTitle2 = explode("title=", $splitTitle[0]);
        $title = $splitTitle2[1];
        $title = strip_tags($title);
        $title = addslashes($title);

        echo "title = $title<br>";
    }


    if(isset($response))
    {
        echo "
        <div class='row'>
            <div class='col'>
                <textarea class='form-control' rows='10'>$response</textarea>
            </div>
        </div>
        ";
    }
?>

<form method="post" action="main.php?cmd=crawling">
<div class="row">
    <div class="col-2">URL</div>
    <div class="col-9">
        <input type="text" name="url" class="form-control" value="">
    </div>
    <div class="col">
        <button type="submit" class="btn btn-primary">Go</button>
    </div>
</div>
</form>

<?php

        $nextPage = $page + 1;

        if($page >=10)
            exit();

        ?>
        <script>
            function repeatCrawling()
            {
                setTimeout( location.href='main.php?cmd=crawling&page=<?php echo $nextPage?>', 3000);
            }

            repeatCrawling();
        </script>
        <?php        
    
?>