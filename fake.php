<?php
    $familyList = "김,김,김,김,이,박,최,정,오,민,노,전";
    $genderList = "남,남,남,여";
    $middleList = "길,동,경,기,성,영,재,진,계,대,원,홍,주";
    $lastList = "준,식,동,순,숙,희,종,호,주,은,진,미,길,수";

    $splitFamily = explode(",", $familyList);
    $splitMiddle = explode(",", $middleList);
    $splitLast = explode(",", $lastList);

    for($i=1; $i<=1000; $i++)
    {
        $rand1 = rand(0, count($splitFamily) -1);
        $rand2 = rand(0, count($splitMiddle) -1);
        $rand3 = rand(0, count($splitLast) -1);
        $name = $splitFamily[$rand1] . $splitMiddle[$rand2] . $splitLast[$rand3];

        echo "$i : $name <br>";
    }
    


?>