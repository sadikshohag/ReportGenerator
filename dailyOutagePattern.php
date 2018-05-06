<?php 
//    $servername = "localhost";
//    $username = "root";
//    $password = "";
//    $dbname = "test";
//    $con = mysqli_connect($servername, $username, $password, $dbname);
//    $hard_details_data = array();
//    $allspeed = array();
//    $finalData=array();
//    $query="SELECT * FROM `speed_report`";
//    $result = mysqli_query($con,$query);
//
//    // $query = "SELECT USERID,PLANNAME,usage_in_mb from detail_report  order by usage_in_mb desc limit 20";
//    // $result = mysqli_query($con,$query);
//    
//    while($row = mysqli_fetch_assoc($result))
//    {
//      array_push($allspeed, $row['speed']);
//    }
//    
//      //print_r($allspeed);die;
//    foreach ($allspeed as $onespeed) {
//    //
////      $queryRes=mysqli_query($con,"SELECT `PLANNAME`,COUNT(`USERID`) as user, SUM(`usage_in_mb`)*0.001 as total FROM `detail_report` WHERE PLANNAME REGEXP '$onespeed' GROUP BY PLANNAME");
//      $queryRes=mysqli_query($con,"SELECT `PLANNAME`,COUNT(`USERID`) as user, SUM(`usage_in_mb`)*0.001 as total FROM `detail_report` WHERE PLANNAME REGEXP 'ES' GROUP BY PLANNAME");
//
//      $userCount = 0;
//      $totalUsage = 0;
//
//      while ( $row= mysqli_fetch_assoc($queryRes)) {
//        $userCount = $userCount + $row['user'];
//        $totalUsage = $totalUsage + $row['total'];
//        
//      }
//
//      array_push($finalData,array($onespeed , $userCount, $totalUsage));
//      
//      break;
//
//      }
//      // echo "<pre>";
//      // print_r($finalData);die;


require 'daily_usage_summary_process.php';


 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Top user Dhaka</title>

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css"  href="style.css">
</head>
<body>
<?php include 'menu2.php'; ?>

<br>
	<div class="container2">
  
  <div class="collapse navbar-collapse ">
    <ul class="list-inline text-center">
      <li><a href="topDhk.php"><strong>Top User's DHK</strong></a></li>     
      <li><a href="topCtg.php"><strong>Top User's CTG</strong> </a></li>   
      <li><a href="dailyOutagePattern.php"><strong>Daily Outage Pattern</strong></a></li>   
    
    </ul>
        
  </div><!-- /.nav-collapse -->
 
</div>
<br>
	<div class="wrapper">
      <div class="page-header text-center">
        <h1>Daily Usage Pattern</h1>
      </div>
      <div class="container">
        <div class="table-responsive">
        <table id="mytable" class="table table-bordered table-hover">
            <thead>
                <tr class="alert-success">
                  <th>Package Type</th>
                  <th>User</th>
                  <th>TOTAL USAGES (GB)</th>
                </tr>
            </thead>
            <tbody>
              <?php
                $finalData = getDailyUsagePattern();
                if (!empty($finalData)) :
                  foreach ($finalData as $Onedata) : 
                    ?>
                  <tr>
                    <td><?php echo $Onedata[0];?></td>
                    <td><?php echo $Onedata[1];?></td>
                    <td><?php echo number_format($Onedata[2],2,'.', '');?></td>
                  </tr>
                    <?php
                   
                  endforeach;
                endif;
                $prepaidSummary = getSummaryData(getPrepaidUsageDetails());
                $postpaidSummary = getSummaryData(getPostpaidUsageDetails());
                $otherSummary = getSummaryData(getOtherUsageDetails());
                
              ?>
            </tbody>
        </table>
        </div>
          
        <div class="page-header text-center">
            <h3>Prepaid</h3>
        </div>
        
        <div class="table-responsive">
        <table id="mytable" class="table table-bordered table-hover">
            <thead>
                <tr class="alert-success">
                  <th>User</th>
                  <th>Usage (TB)</th>
                  <th>Per user avg Usage (GB)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $prepaidSummary[0];?></td>
                    <td><?php echo $prepaidSummary[1];?></td>
                    <td><?php echo $prepaidSummary[2];?></td>
                </tr>
            </tbody>
        </table>
        </div>    
          
          
        <div class="page-header text-center">
            <h3>Postpaid</h3>
        </div>
        
        <div class="table-responsive">
        <table id="mytable" class="table table-bordered table-hover">
            <thead>
                <tr class="alert-success">
                  <th>User</th>
                  <th>Usage (TB)</th>
                  <th>Per user avg Usage (GB)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $postpaidSummary[0];?></td>
                    <td><?php echo $postpaidSummary[1];?></td>
                    <td><?php echo $postpaidSummary[2];?></td>
                </tr>
            </tbody>
        </table>
        </div> 
          
        <div class="page-header text-center">
            <h3>Other Services</h3>
        </div>
        
        <div class="table-responsive">
        <table id="mytable" class="table table-bordered table-hover">
            <thead>
                <tr class="alert-success">
                  <th>User</th>
                  <th>Usage (TB)</th>
                  <th>Per user avg Usage (GB)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $otherSummary[0];?></td>
                    <td><?php echo $otherSummary[1];?></td>
                    <td><?php echo $otherSummary[2];?></td>
                </tr>
            </tbody>
        </table>
        </div>   
          
    </div>
   </div>

	
</body>
</html>