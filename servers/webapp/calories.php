<?php

  include 'header.php';


  $db_servername="localhost";
  $db_username="root";
  $db_password="";
  $db_name="test";

  $conn=mysqli_connect($db_servername,$db_username,$db_password,$db_name);
  if(!$conn ) {
    die('Could not connect: ' . mysqli_error());
 }



  // retrieving and preparing data from json file

  $json = file_get_contents('stats.json');
  $data = json_decode($json,true);

  foreach ($data as $days) {
    $date = $days['startTime'];
    $calories = $days['calsBurned'];

    $day = strtotime($date);
    $day = date('d F Y', $day);

    $insert=array("['".$day."',".$calories."]");

    $arr[] = $insert;
  }

  // inserting data from json file into sql database
 /* 
 $sql0 = "INSERT INTO calsBurnt(Day, Calories) VALUES('$day', '$calories')";
  if(!$conn ) {
    die('Could not connect: ' . mysqli_error());
 }
  $result0 = $conn->query($sql0);
*/


  // setting up my select query
  $sql1 = "SELECT * FROM calsBurnt WHERE Day >= '2021-06-01' AND Day <= '2021-06-07'";
  $sql2 = "SELECT * FROM calsBurnt WHERE Day >= '2021-06-15' AND Day <= '2021-06-21'";
  $sql3 = "SELECT * FROM calsBurnt WHERE Day >= '2021-07-07' AND Day <= '2021-07-14'";
  $sql4 = "SELECT * FROM calsBurnt WHERE Day >= '2022-07-15' AND Day <= '2022-07-21'";
  $sqljun = "SELECT * FROM calsBurnt WHERE Day >= '2021-06-01' AND Day <= '2021-06-30'";
  $sqljul1 = "SELECT * FROM calsBurnt WHERE Day >= '2021-07-01' AND Day <= '2021-07-31'";
  $sqljul2 = "SELECT * FROM calsBurnt WHERE Day >= '2022-07-01' AND Day <= '2022-07-31'";
  $sql21 = "SELECT * FROM calsBurnt WHERE Day >= '2021-01-01' AND Day <= '2021-12-31'";
  $sql22 = "SELECT * FROM calsBurnt WHERE Day >= '2022-01-01' AND Day <= '2022-12-31'";


  if(!$conn ) {
    die('Could not connect: ' . mysqli_error());
 }
  
  $result1 = $conn->query($sql1);
  $result2 = $conn->query($sql2); 
  $result3 = $conn->query($sql3);
  $result4 = $conn->query($sql4); 

  $resultjun = $conn->query($sqljun);
  $resultjul1 = $conn->query($sqljul1); 
  $resultjul2 = $conn->query($sqljul2); 
  $result21 = $conn->query($sql21);
  $result22 = $conn->query($sql22); 




  if (!empty($result1) && $result1->num_rows > 0) {

  $arr1=array();

  // output data from each row of the database into each row of the table
  while($row = $result1->fetch_assoc()) {

    $date=$row["Day"];
    $calories =$row["Calories"];

    $date =strtotime($date);
    $day = date('d F Y', $date);

    $insert1=array("['".$day."',".$calories."]");

    $arr1[] = $insert1; 

    }
  }

  if (!empty($result2) && $result2->num_rows > 0) {

  $arr2=array();

  // output data from each row of the database into each row of the table
  while($row = $result2->fetch_assoc()) {

    $date=$row["Day"];
    $calories =$row["Calories"];

    $date =strtotime($date);
    $day = date('d F Y', $date);

    $insert2=array("['".$day."',".$calories."]");

    $arr2[] = $insert2; 

    }
  } 

  if (!empty($result3) && $result3->num_rows > 0) {

  $arr3=array();

  // output data from each row of the database into each row of the table
  while($row = $result3->fetch_assoc()) {

    $date=$row["Day"];
    $calories =$row["Calories"];

    $date =strtotime($date);
    $day = date('d F Y', $date);

    $insert3=array("['".$day."',".$calories."]");

    $arr3[] = $insert3; 

    }
  } 

  if (!empty($result4) && $result4->num_rows > 0) {

  $arr4=array();

  // output data from each row of the database into each row of the table
  while($row = $result4->fetch_assoc()) {

    $date=$row["Day"];
    $calories =$row["Calories"];

    $date =strtotime($date);
    $day = date('d F Y', $date);

    $insert4=array("['".$day."',".$calories."]");

    $arr4[] = $insert4; 

    }
  } 

  if (!empty($resultjun) && $resultjun->num_rows > 0) {

  $arrjun=array();

  // output data from each row of the database into each row of the table
  while($row = $resultjun->fetch_assoc()) {

    $date=$row["Day"];
    $calories =$row["Calories"];

    $date =strtotime($date);
    $day = date('d F Y', $date);

    $insertjun=array("['".$day."',".$calories."]");

    $arrjun[] = $insertjun; 

    }
  } 

  if (!empty($resultjul1) && $resultjul1->num_rows > 0) {

  $arrjul1=array();

  // output data from each row of the database into each row of the table
  while($row = $resultjul1->fetch_assoc()) {

    $date=$row["Day"];
    $calories =$row["Calories"];

    $date =strtotime($date);
    $day = date('d F Y', $date);

    $insertjul1=array("['".$day."',".$calories."]");

    $arrjul1[] = $insertjul1; 

    }
  } 

  if (!empty($resultjul2) && $resultjul2->num_rows > 0) {

  $arrjul2=array();

  // output data from each row of the database into each row of the table
  while($row = $resultjul2->fetch_assoc()) {

    $date=$row["Day"];
    $calories =$row["Calories"];

    $date =strtotime($date);
    $day = date('d F Y', $date);

    $insertjul2=array("['".$day."',".$calories."]");

    $arrjul2[] = $insertjul2; 

    }
  } 

  if (!empty($result21) && $result21->num_rows > 0) {

  $arr21=array();

  // output data from each row of the database into each row of the table
  while($row = $result21->fetch_assoc()) {

    $date=$row["Day"];
    $calories =$row["Calories"];

    $date =strtotime($date);
    $day = date('d F Y', $date);

    $insert21=array("['".$day."',".$calories."]");

    $arr21[] = $insert21; 

    }
  } 

  if (!empty($result22) && $result22->num_rows > 0) {

  $arr22=array();

  // output data from each row of the database into each row of the table
  while($row = $result22->fetch_assoc()) {

    $date=$row["Day"];
    $calories =$row["Calories"];

    $date =strtotime($date);
    $day = date('d F Y', $date);

    $insert22=array("['".$day."',".$calories."]");

    $arr22[] = $insert22; 

    }
  } 

  //searches for user selection  
  if(isset($_POST["submit"])){

    $time=$_POST["time"];

    if($time=="week1"){
      $display=$arr1;
    }
    else if($time=="week2"){
      $display=$arr2;
    }
    else if($time=="week3"){
      $display=$arr3;
    }
    else if($time=="week4"){
      $display=$arr4;
    }
    else if($time=="June 2021"){
      $display=$arrjun;
    }
    else if($time=="July 2021"){
      $display=$arrjul1;
    }
    else if($time=="July 2022"){
      $display=$arrjul2;
    }
    else if($time=="2021"){
      $display=$arr21;
    }
    else if($time=="2022"){
      $display=$arr22;
    }
  }
  else{
    $display=$arr4;
  }





?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Day", "Calories"]
        <?php
        for($i=0;$i<sizeof($display);$i++){
          foreach($display[$i] as $entry) {
            echo ",".$entry;
          }
        }
        ?>
      ]);

      var view = new google.visualization.DataView(data);

      var options = {
        title: "Calories Burnt",
        width: 600,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
        colors: ['#e0440e'],
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
  }
  </script>








<!DOCTYPE html>
<html>
<head>
<title>CHARTS</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    .w3-sidebar a {font-family: "Roboto", sans-serif}
    body,h1,h2,h3,h4,h5,h6,.w3-wide {font-family: "Roboto", sans-serif;}
</style>
</head>
<body class="w3-content" style="max-width:1200px">

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-bar-block w3-white w3-collapse w3-top" style="z-index:3;width:250px" id="mySidebar">
  <div class="w3-container w3-display-container w3-padding-16">
    <i onclick="w3_close()" class="fa fa-remove w3-hide-large w3-button w3-display-topright"></i>
    <h3 class="w3-wide"><b>CHARTS</b></h3>
  </div>
  <div class="w3-padding-64 w3-large w3-text-grey" style="font-weight:bold">
    <a href="#" class="w3-bar-item w3-button">CALORIES</a>
    <a href="#" class="w3-bar-item w3-button">ELEVATION/RISE INTENSITY</a>
    <a href="#" class="w3-bar-item w3-button">DISTANCE TRAVELLED</a>
    <a href="activity_recap" class="w3-bar-item w3-button">ACTIVITY RECAP</a>
    <a href="moving_avg" class="w3-bar-item w3-button">MOVING AVERAGE</a>
  </div>
</nav>

<!-- Top menu on small screens -->
<header class="w3-bar w3-top w3-hide-large w3-grey w3-xlarge">
  <div class="w3-bar-item w3-padding-24 w3-wide">CHARTS</div>
  <a href="javascript:void(0)" class="w3-bar-item w3-button w3-padding-24 w3-right" onclick="w3_open()"><i class="fa fa-bars"></i></a>
</header>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:250px;">

  <!-- Push down content on small screens -->
  <div class="w3-hide-large" style="margin-top:83px"></div>

  <!-- Image header -->
  <div class="w3-display-container w3-container">
    <!-- <div id='chart' class='chart'></div> -->
  </div>

   <section id="wrapper">

    <div id="buttons">
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <select name="time" id="time">
        <option value="week1">June 1, 2021 - June 7, 2021</option>
        <option value="week2">June 14, 2021 - June 21, 2021</option>
        <option value="week3">July 7, 2021 - July 14, 2021</option>
        <option value="week4">July 15, 2022 - Jult 21, 2022</option>
        <option value="June 2021">June 2021</option>
        <option value="July 2021">July 2021</option>
        <option value="July 2022">July 2022</option>
        <option value="2021">2021</option>
        <option value="2022">2022</option>
      </select>
      <button type="submit" name="submit">GENERATE</button>
      </form>
    </div>
    <div id="columnchart_values"></div>
  </section>

  <!-- End page content -->
</div>

</body>

</html>
