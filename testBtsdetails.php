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
    <link rel="stylesheet" type="text/css"  href="style.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery-3.3.1/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet">
	<script src="js/bootstrap-datetimepicker.min.js"></script>
	<script type="text/javascript" src="jquery/jquery-1.8.3.min.js" charset="UTF-8"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
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
      <div class="page-header text-center">
        <h1>QUBEE BTS Report</h1>
      </div>

      <div class="container">
      	<form method="get" action="">
      	      		<?php 
                  if (!empty($hard_details_data)) :
                		$serial=0;
                  foreach ($hard_details_data as $Oneuser) :
                  $serial++;  
                    ?>
                    <br>
       <label>SL</label>
       <input type="text" name="" value="<?php echo $serial;?>">
       <label>Qubee ID</label>
       <input type="text" name="" value="<?php echo $Oneuser['Qubee_ID'];?>">
       <label>Operator_Site_ID</label>
       <input type="text" name="" value="<?php echo $Oneuser['Operator_Site_ID'];?>">

       <label>Operator</label>
       <input type="text" name="" value="<?php echo $Oneuser['Operator'];?>">
       <br/>
       <br/>
       <label>Region</label>
       <input type="text" name="" value="<?php echo $Oneuser['Region'];?>">
       <label>Cluster_Name</label>
       <input type="text" name="" value="<?php echo $Oneuser['Cluster_Name'];?>">
       
       <label>Location</label>
       <input type="text" name="" value="<?php echo $Oneuser['Location'];?>">
       <br/>
       <br/>
       <label>District</label>
       <input type="text" name="" value="<?php echo $Oneuser['district'];?>">
       <label>Status</label>
       <input type="text" name="" value="<?php echo $Oneuser['Status'];?>">
       <label>On Air Date</label>
       <input type="text" name="" value="<?php echo $Oneuser['On_Air_Date'];?>">
       <br/>
       <br/>
       <label>Turn_Off_Date</label>
       <input type="text" name="" value="<?php echo $Oneuser['Turn_Off_Date'];?>">
       <label>Final Soft Copy (SSD)</label>
       <input type="text" name="" value="<?php echo $Oneuser['Final_Soft_Copy_SSD']; ?>">
       <br/>
       <br/>
       <br/>
       <label>PAC_Date</label>
       <input type="text" name="" value="<?php echo $Oneuser['PAC_Date'];?>">
       <br/>
       <br/>
       <label>Civil Vendor</label>
       <input type="text" name="" value="<?php echo $Oneuser['Civil_Vendor'];?>">
       <label>Civil_PAC_date</label>
       <input type="text" name="" value="<?php echo $Oneuser['Civil_PAC_date'];?>">
       <br/>
       <br/>
       <label>Site_Address</label>
       <input type="text" name="" value="<?php echo $Oneuser['Site_Address'];?>">
       <label>Latitude</label>
       <input type="text" name="" value="<?php echo $Oneuser['Latitude'];?>">
       <label>Longitude</label>
       <input type="text" name="" value="<?php echo $Oneuser['Longitude'];?>">
       <br/>
       <br/>
       <label>Coverage_Objective</label>
       <input type="text" name="" value="<?php echo $Oneuser['Coverage_Objective'];?>">
       <label>Sector_Remarks</label>
       <input type="text" name="" value="<?php echo $Oneuser['Sector_Remarks'];?>">
       <label>Power_Type</label>
       <input type="text" name="" value="<?php echo $Oneuser['Power_Type'];?>">
	   <br/>
       <br/>
       <label>House_Owner_Contact</label>
       <input type="text" name="" value="<?php echo $Oneuser['House_Owner_Contact'];?>">
       <label>Battery_Type_AH</label>
       <input type="text" name="" value="<?php echo $Oneuser['Battery_Type_AH'];?>">
       <label>Key_Lock_Remarks</label>
       <input type="text" name="" value="<?php echo $Oneuser['Key_Lock_Remarks'];?>">
       <br>
       <br>
                           <?php
                   
                  endforeach;
                endif;
              ?>
          </form>
          <br>
	<a href="onAirSite.php"><button style="float:right" class=" btn-primary btn-lg ">Back</button></a>

    </div>

  
  </body>
</html>