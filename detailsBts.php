<?php
if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "qubee";
    $con = mysqli_connect($servername, $username, $password, $dbname);
    $hard_details_data = array();
    $query = "SELECT * from onair where id = $id";
    $result = mysqli_query($con,$query);
    
    while($row = mysqli_fetch_assoc($result))
    {
      $hard_details_data[]=$row;
    }
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
                  <th>Operator_Site_ID</th>
                  <th>Operator</th>
                  <th>Region</th>
                  <th>Cluster_Name</th>
                  <th>Location</th>
                  <th>District</th>
                  <th>Status</th>
                  <th>On Air Date</th>
                  <th>Turn_Off_Date</th>
                  <th>Final Soft Copy (SSD)</th>
                  <th>PAC_Date</th>
                  <th>Civil Vendor</th>
                  <th>Civil_PAC_date</th>
                  <th>Site_Address</th>
                  <th>Latitude</th>
                  <th>Longitude</th>
                  <th>Coverage_Objective</th>
                  <th>Sector_Remarks</th>
                  <th>Power_Type</th>
                  <th>House_Owner_Contact</th>
                  <th>Battery_Type_AH</th>
                  <th>Key_Lock_Remarks</th>
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
                    <td><?php echo $Oneuser['Operator_Site_ID']; ?></td>
                    <td><?php echo $Oneuser['Operator'];?></td>
                    <td><?php echo $Oneuser['Region'];?></td>
                    <td><?php echo $Oneuser['Cluster_Name']; ?></td>
                    <td><?php echo $Oneuser['Location'];?></td>
                    <td><?php echo $Oneuser['district']; ?></td>
                    <td width="10px"><?php echo $Oneuser['Status']; ?></td>
                    <td><?php echo $Oneuser['On_Air_Date']; ?></td>
                    <td><?php echo $Oneuser['Turn_Off_Date']; ?></td>
                    <td><?php echo $Oneuser['Final_Soft_Copy_SSD']; ?></td>
                    <td><?php echo $Oneuser['PAC_Date']; ?></td>
                    <td><?php echo $Oneuser['Civil_Vendor']; ?></td>
                    <td><?php echo $Oneuser['Civil_PAC_date']; ?></td>
                    <td><?php echo $Oneuser['Site_Address']; ?></td>
                    <!-- <td><?php echo $Oneuser['']; ?></td> -->
                    <td><?php echo $Oneuser['Latitude']; ?></td>
                    <td><?php echo $Oneuser['Longitude']; ?></td>
                    <td><?php echo $Oneuser['Coverage_Objective']; ?></td>
                    <td><?php echo $Oneuser['Sector_Remarks']; ?></td>
                    <td><?php echo $Oneuser['Power_Type']; ?></td>
                    <td><?php echo $Oneuser['House_Owner_Contact']; ?></td>
                    <td><?php echo $Oneuser['Battery_Type_AH']; ?></td>
                    <td><?php echo $Oneuser['Key_Lock_Remarks']; ?></td>
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
  
  </body>
</html>