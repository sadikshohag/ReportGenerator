<?php
$servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "qubee";
    $con = mysqli_connect($servername, $username, $password, $dbname);
/*    $hard_details_data = array();
    $operator_data = array();
    $total_data = array();
    $query = "SELECT COUNT(Operator) as op,Operator FROM `onair` GROUP BY Operator order by Operator desc";
    $result = mysqli_query($con,$query);
    
    while($row = mysqli_fetch_assoc($result))
    {
      $hard_details_data[]=$row;
    }
*/
    $allOperator=array();
    $res=mysqli_query($con,"SELECT distinct Operator from onair");
    while($row = mysqli_fetch_assoc($res))
    {
      array_push($allOperator,$row['Operator']);
    }

    $allRegion = array();
    $regionResult=mysqli_query($con,"SELECT distinct Region from onair");
    while($row = mysqli_fetch_assoc($regionResult))
    {
      if($row['Region'] != NULL){
         array_push($allRegion,$row['Region']);
      }
    }
    
    $finalData = array();
    foreach ($allOperator as $operator) {
      
      $data = array();
      foreach ($allRegion as $region) {
        $queryResult = mysqli_query($con, "SELECT Region,Operator,COUNT(Operator)as bts FROM `onair` Where Operator = '$operator' and Region = '$region' ");

        $row = mysqli_fetch_assoc($queryResult);
          
        array_push($data,$row['bts']);
      }
      
      array_push($finalData,array(
          "operator" => $operator,
          "bts"      => $data
      ));
    }
         

//    echo "<pre>";
//     print_r($finalData);
// echo "</pre>";
// die();
    //array_push($total_data,$allOperator);
    // array_push($total_data,$operator_data);
?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->

    <title>QUBEE Daily Site Outage </title>
  </head>
  <body>
        <?php include 'menu2.php'; ?>
		<br/>
		<div class="container2">
  
	<div class="collapse navbar-collapse js-navbar-collapse">
		<ul class="list-inline text-center">
			<li><a href="onAirSite.php"><strong>On Air Site Tracker</strong></a></li>			
			<li><a href="areawiseSum.php"><strong>Site list summary</strong> </a></li>					
		</ul>
        
	</div><!-- /.nav-collapse -->
 
</div>
<br>
<div class="container3">
      
	<div class="collapse navbar-collapse js-navbar-collapse">
		<ul class="list-inline text-center">
			<li><a href="areawiseSum.php"><strong>Areawise Summary</strong></a></li>			
			<li><a href="operatorwiseSum.php"><strong>Operatorwise Summary</strong> </a></li>					
		</ul>
        
	</div><!-- /.nav-collapse -->
 
</div>
       <div class="wrapper">
      <div class="page-header text-center">
        <h1>QUBEE Operatorwise Summary</h1>
      </div>
      <div class="container">
        <div class="table-responsive">
        <table id="mytable" class="table table-bordered table-hover">
            <thead>
                <tr class="alert-success">
                  <!-- <th>SL</th> -->
                  <th>Operator</th>
                  <th>Rural</th>
                  <th>Chittagong</th>
                  <th>Dhaka</th>
                  <th>Sylhet</th>
                </tr>
            </thead>
            <tbody>
              <?php
                if (!empty($finalData)) {
                  $serial=0;

                  // 

                    foreach ($finalData as $data) {
                      
                    echo "<tr>";
                    echo "<td>". $data['operator'] ."</td>";
                      foreach ($data['bts'] as $bts) {
                        echo "<td>". $bts."</td>";
                      }
                      
                    
                    echo "</tr>";
                    
                  }
                  
                }
                  
              ?>
            </tbody>
        </table>
        </div>
<!--         <div class="pagination-container">
<nav>
<ul class="pagination"></ul>
</nav>
</div> -->
    </div>
   </div>
  
  </body>
</html>