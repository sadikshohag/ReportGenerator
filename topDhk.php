<?php 
$servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "test";
    $con = mysqli_connect($servername, $username, $password, $dbname);
    $hard_details_data = array();
    $assign_history_data = array();
    $details_data = array();
    $query = "SELECT USERID,PLANNAME,usage_in_mb from detail_report where BILLINGAREA='Dhaka' order by usage_in_mb desc limit 20";
    $result = mysqli_query($con,$query);
    
    while($row = mysqli_fetch_assoc($result))
    {
      $hard_details_data[]=$row;
    }




 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Top user Dhaka</title>
</head>
<body>
	<?php include 'topUser.php'; ?>
<!-- <div class="container1">
  
    
		<a class="navbar-brand" href="#">Qubee</a>
	
	
	<div class="collapse navbar-collapse js-navbar-collapse">
		<ul class="nav navbar-nav">
			<li><a href="#"><strong>Home </strong></a></li>			
			<li><a href="outage.php"><strong>Outage</strong> </a></li>			
			<li><a href="#"><strong>Top Users</strong> </a></li>			
			<li><a href="#"><strong>BTS</strong> </a></li>			
			<li><a href="#"><strong>MISC</strong> </a></li>			
			<li><a href="#"><strong>Admin Operations </strong></a></li>					
            <li><a href="#"><strong>About</strong></a></li>
            <li><a href="#"><strong>Contact Us</strong></a></li>
		</ul>
        <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#"><strong>LOGOUT</strong></a></li>
      </ul>
	</div>/.nav-collapse
 
</div> -->
<br>
	
	<div class="wrapper">
      <div class="page-header text-center">
        <h1>Top Twenty Users - Dhaka</h1>
      </div>
      <div class="container">
        <div class="table-responsive">
        <table id="mytable" class="table table-bordered table-hover">
            <thead>
                <tr class="alert-success">
                  <th>SL</th>
                  <th>USER NAME</th>
                  <th>PACKAGENAME</th>
                  <th>TOTAL USAGES (MB)</th>
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
                    <td><?php echo $Oneuser['USERID'];?></td>
                    <td><?php echo $Oneuser['PLANNAME'];?></td>
                    <td><?php echo $Oneuser['usage_in_mb'];?></td>
                  </tr>
                    <?php
                   
                  endforeach;
                endif;
              ?>
            </tbody>
        </table>
        </div>
    </div>
   </div>

	
</body>
</html>