<?php
include 'session.php';
chk_Session(4);
$servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "qubee";
    $con = mysqli_connect($servername, $username, $password, $dbname);
    $hard_details_data = array();
    $query = "SELECT * from onair";
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
  
	<div class="collapse navbar-collapse js-navbar-collapse">
		<ul class="list-inline text-center">
			<li><a href="onAirSite.php"><strong>On Air Site Tracker</strong></a></li>			
			<li><a href="siteSum.php"><strong>Site list summary</strong> </a></li>					
		</ul>
        
	</div><!-- /.nav-collapse -->
 
</div>
       <div class="wrapper">
      <div class="page-header text-center">
        <h1>QUBEE BTS Report</h1>
      </div>
      <div class="container">
        <div class="table-responsive">
        <table id="mytable" class="table table-bordered table-hover">
            <thead>
                <tr class="alert-success">
                  <th>SL</th>
                  <th>Qubee ID</th>
                  <th>Operator</th>
                  <th>Region</th>
                  <th>Location</th>
                  <th>Status</th>
                  <th>On Air Date</th>
                  <th>No_Sector</th>
                  <th>Civil Vendor</th>
                  <th>Details</th>
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
                    <td><?php echo $Oneuser['Qubee_ID'];?></td>
                    <td><?php echo $Oneuser['Operator'];?></td>
                    <td><?php echo $Oneuser['Region'];?></td>
                    <td><?php echo $Oneuser['Location'];?></td>
                    <td width="10px"><?php echo $Oneuser['Status']; ?></td>
                    <td><?php echo $Oneuser['On_Air_Date']; ?></td>
                    <td><?php echo $Oneuser['No_Sector']; ?></td>
                    <td><?php echo $Oneuser['Civil_Vendor']; ?></td>
                    <td>
                      <a href="testBtsdetails.php?id=<?php echo $Oneuser['id']; ?>">Details</a>
                    </td>
                  </tr>
                    <?php
                   
                  endforeach;
                endif;
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
