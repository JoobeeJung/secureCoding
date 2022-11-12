<?php
    $sql = "select * from member ";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($result);
    while($data) {
      echo "id = $data[id], pw = $data[pass]<br>";
      $data = mysqli_fetch_array($result);
  }
?>