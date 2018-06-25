<?php 
    include 'session.php';
    chk_Session(6); 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "qubee";
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


<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css"  href="style.css">
<!------ Include the above in your HEAD tag ---------->
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


