<?php

    include 'session.php';
    chk_Session(2); 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "qubee";
    $con = mysqli_connect($servername, $username, $password, $dbname);
    $hard_details_data = array();

    $details_data = array();
    $query = "SELECT Date,Outage_Mins, count(Site)as bts_num,User_No from weekly_reports GROUP BY Date";
    $result = mysqli_query($con,$query);
    
    while($row = mysqli_fetch_assoc($result))
    {
      $hard_details_data[]=$row;
    }


    $query = "SELECT Date from weekly_reports GROUP BY Date";
    $result = mysqli_query($con,$query);
    
    while($row = mysqli_fetch_assoc($result))
    {
      $details_data[]=$row;
    }

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
      <li><a href="indexForDailyData.php"><strong>Insert Outage</strong></a></li>
      <li><a href="outage.php"><strong>Outage Log</strong></a></li>     
      <li><a href="viewOutage.php"><strong>View Daily Outage</strong> </a></li>
      <li><a href="outageData.php"><strong>Outage Data</strong></a></li>            
      <li><a href="planedOutage.php"><strong>Planned/Unplanned Outage</strong> </a></li>      
      <!-- <li><a href="outageGraph.php"><strong>Outage Minute Graph</strong> </a></li>      -->
      <li><a href="userImpact.php"><strong>User Imapct Graph</strong> </a></li>     
    </ul>
        
	</div><!-- /.nav-collapse -->
 
</div>
       <div class="wrapper">
      <div class="page-header text-center">
        <h1>Unplanned Outage</h1>
      </div>
      <div class="container">
        <div class="table-responsive">
        <table id="mytable" class="table table-bordered table-hover">
            <thead>
                <tr class="alert-success">
                  <th>SL</th>
                  <th>Date</th>
                  <th>Outage (Min)</th>
                  <th>BTS Number</th>
                  <th>Sub-base Subject to Interruption</th>
                </tr>
            </thead>
            <tbody>
              <?php
                if (!empty($hard_details_data)) :
                		$serial=0;
                  foreach ($hard_details_data as $Oneuser) :
                  $serial++;  
                    ?>
                  <tr>
                  	<td><?php echo $serial;?></td>
                    <td><?php echo $Oneuser['Date'];?></td>
                    <td><?php echo $Oneuser['Outage_Mins'];?></td>
                    <td><?php echo $Oneuser['bts_num'];?></td>
                    <td><?php echo $Oneuser['User_No'];?></td>
                  </tr>
                    <?php
                   
                  endforeach;
                endif;
              ?>
            </tbody>
        </table>
        </div>
        <div class="pagination-container">
        <nav>
        <ul class="pagination"></ul>
        </nav>
        </div>
    </div>
   </div>
  

  <br/>
         <div class="wrapper">
      <div class="page-header text-center">
        <h1>Planned Outage</h1>
      </div>
      <div class="container">
        <div class="table-responsive">
        <table id="mytable" class="table table-bordered table-hover">
            <thead>
                <tr class="alert-success">
                  <th>SL</th>
                  <th>Date</th>
                  <th>Outage (Min)</th>
                  <th>BTS Number</th>
                  <th>Sub-base Subject to Interruption</th>
                </tr>
            </thead>
            <tbody>
              <?php
                if (!empty($details_data)) :
                    $serial=0;
                  foreach ($details_data as $Oneuser) :
                  $serial++;  
                    ?>
                  <tr>
                    <td><?php echo $serial;?></td>
                    <td><?php echo $Oneuser['Date'];?></td>
                    <!-- <td><?php echo $Oneuser['Outage_Mins'];?></td>
                    <td><?php echo $Oneuser['bts_num'];?></td>
                    <td><?php echo $Oneuser['User_No'];?></td> -->
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                    <?php
                   
                  endforeach;
                endif;
              ?>
            </tbody>
        </table>
        </div>
        <div class="pagination-container">
        <nav>
        <ul class="pagination"></ul>
        </nav>
        </div>
    </div>
   </div>
  </body>
</html>