<?php

    $letters ="abcdefghijklmnopqrstuvwxyz12345";
    $size = strlen($letters);

    $cnt = 0;
    $findFlag = 0;

    for($i=0; $i<$size -1 ; $i++)
    {
        for($j=0; $j<$size -1 ; $j++)
        {
            for($k=0; $k<$size -1 ; $k++)
            {
                for($l=0; $l<$size -1 ; $l++)
                {
                    $cnt ++;

                    if($cnt % 10000 == 0)
                        echo "$cnt <br>";

                    $pw = $letters[$i] . $letters[$j] . $letters[$k] . $letters[$l];

                    $sql = "select * from member where pass='$pw' ";
                    $result = mysqli_query($conn, $sql);
                    $data = mysqli_fetch_array($result);

                    while($data)
                    {


                        $id = $data["id"];
                        echo "[ $cnt ] id = $id , pw = $pw <br>";

                        $findFlag = 1;
                        $data = mysqli_fetch_array($result);
                    }

                    if($findFlag == 1)
                        exit();
                }
                    
            }
            
        }
    
    }

?>