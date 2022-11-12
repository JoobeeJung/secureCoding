
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Time',  'Connect'],
          <?php
                // 2022-09-22 11:22:33
                $today = Date('Y-m-d');
                for($i =0; $i<24; $i++)
                {
                    $next = $i + 1;
                    $sql = "select * from log_table 
                                where time >='$today $i:00:00' and time< '$today $i:59:59' ";
                    $result = mysqli_query($conn, $sql);
                    $man = mysqli_num_rows($result);
                    echo "['$i:00' , $man ],";
                }
          ?>
        ]);

        var options = {
          title: '접속 로그 분석',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('secureChart'));

        chart.draw(data, options);
      }
    </script>

    <div id="secureChart" style="width: 900px; height: 500px"></div>

   
    <script>
        setTimeout(function(){
            location.href='main.php?cmd=chart';
        }, 5000);
    </script>
   
