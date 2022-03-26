<?php

  include 'includes/db-connect.php';
  include 'includes/header.php';

  // setting up my select query
  $sql = "SELECT * FROM distancetravelled";

  if(!$conn ) {
    die('Could not connect: ' . mysqli_error());
 }
  $result = $conn->query($sql);

 if (!empty($result) && $result->num_rows > 0) {

  $arr=array();

  // output data from each row of the database into each row of the table
  while($row = $result->fetch_assoc()) {

    $date=$row["Day"];
    $distance=$row["Distance"];

    $date =strtotime($date);
    $day = date('d', $date);

    $insert=array("['".$day."',".$distance."]");

    $arr[] = $insert; 

    }
  }

  
?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Day", "Distance (KM)"]
        <?php
        for($i=0;$i<sizeof($arr);$i++){
          foreach($arr[$i] as $entry) {
            echo ",".$entry;
          }
        }
        ?>
      ]);

      var view = new google.visualization.DataView(data);

      var options = {
        title: "Distance Travelled, in km",
        width: 600,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
  }
  </script>


<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:250px;">

  <!-- Push down content on small screens -->
  <div class="w3-hide-large" style="margin-top:83px"></div>

  <!-- Image header -->
  <div class="w3-display-container w3-container">
    <!-- <div id='chart' class='chart'></div> -->
  </div>

  <div id="columnchart_values" style="width: 900px; height: 300px;"></div>

  <!-- End page content -->
</div>

</body>

</html>