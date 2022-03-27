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

    $day =strtotime($date);

    $insert = array($day,$distance);

    $arr[] = $insert; 

    }
  

  //Generate based on weekly

  // 1) Weekly array
  $weekly=array();

  // 2) add up the first set of weeks (x day to Saturday)
  $total_otw=0;
  $i=0;
  do {

    $total_otw = $arr[$i][1]+$total_otw;

    $dayOfWeek = date("l", $arr[$i][0]);

    $i++;
  } while($dayOfWeek!="Saturday");

  //Store into array
  $insert=array("['w1',".$total_otw."]");
  $weekly[]=$insert;

  // # of days for w1 (need to for last week calc.)
  $w1 = $i;

  $k=0;

  // add up any middle week (if total days > 7, while )
  if((sizeof($arr)-$i)>7){

    //calculate how many times we should run next step
    $times = intval((sizeof($arr)-$i)/7);

    for(;$k<$times;$k++){
      $total_otw=0;
      for($j=$i;$j<($i+7);$j++){
        $total_otw = $arr[$j][1]+$total_otw;
        //$dayOfWeek = date("l", $arr[$i][0]);
      }
      $i=$j;

      //Store into DB
      $insert=array("['w".($k+2)."',".$total_otw."]");
      $weekly[]=$insert;

    }
  }

  // 4) add up last week
  $total_otw=0;

  while($i<sizeof($arr)){
    $total_otw = $arr[$i][1]+$total_otw;
    $dayOfWeek = date("l", $arr[$i][0]);
    $i++;
  }

  //Store into DB
  $insert=array("['w".($k+2)."',".$total_otw."]");
  $weekly[]=$insert;

  //Generate based on monthly

  //generate based on yearly

  }
  else{

    $weekly=array();

    $insert=array("['w0',0]");
    $weekly[]=$insert;

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
        for($i=0;$i<sizeof($weekly);$i++){
          foreach($weekly[$i] as $entry) {
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