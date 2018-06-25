<?php include('server1.php');
if(isset($_GET['edit'])) {
	$id = $_GET['edit'];
	$edit_state = true;
	$rec = mysqli_query($conn,"SELECT * FROM info WHERE id = $id");
	$record = mysqli_fetch_array($rec);
	$category = $record['category'];
	$down_Date_Time = $record['Down_Date'];
	$down_time =$record['Down_Time'];
	$combinedDT = $down_Date_Time." ".$down_time;
	$up_Date_Time = $record['Up_Date'];
	$up_time = $record['Up_Time'];
	$combinedUDT = $up_Date_Time." ". $up_time;
	$site = $record['Site'];
	$sector = $record['sector'];
	$fiber_Vendor = $record['fiber_Vendor'];
	$link_Between = $record['link_Between'];
	$information_Source = $record['information_Source'];
	$outage_type = $record['outage_type'];
	$reason = $record['reason'];
	$specific_reason = $record['specific_reason'];
	$inform_time= $record['inform_time'];
	$inform_type = $record['inform_type'];
	$informed_Vendor = $record['informed_Vendor'];
	$incident_Time = $record['incident_Time'];
	$informOfType = $record['informOfType'];
	$informed_Person = $record['informed_Person'];
	$inform_TimeonResolve= $record['inform_TimeonResolve'];
	$Type_Of_inform = $record['Type_Of_inform'];
	$informedToPerson = $record['informedToPerson'];
	$noc_DutyEngineer = $record['noc_DutyEngineer'];
	$last_ModifiedBy = $record['last_ModifiedBy'];
	$last_ModifiedDT = $record['last_ModifiedDT'];
	$comment = $record['comment'];
	$id = $record['id'];
	
}
	
?>
<!Doctype html>
	<html>
	<head>
	
	
	
	<link rel="stylesheet" type="text/css"  href="style.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery-3.3.1/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet">
	<script src="js/bootstrap-datetimepicker.min.js"></script>
	<script type="text/javascript" src="jquery/jquery-1.8.3.min.js" charset="UTF-8"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
	<script type="text/javascript" src="js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>

</head>

<body>
<?php include 'menu2.php'; ?>
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
    <div class="container2">
  
	<div class="collapse navbar-collapse js-navbar-collapse">
		<ul class="list-inline text-center">
			<li><a href="down.php"><strong>Insert Outage</strong></a></li>	
			<li><a href="outage.php"><strong>Outage Log</strong></a></li>			
			<li><a href="viewOutage.php"><strong>View Outage</strong> </a></li>			
			<li><a href="planedOutage.php"><strong>Planned/Unplanned Outage</strong> </a></li>			
			<li><a href="outageGraph.php"><strong>Outage Minute Graph</strong> </a></li>			
			<li><a href="#"><strong>User Imapct Graph</strong> </a></li>			
		</ul>
        
	</div><!-- /.nav-collapse -->
</div>
	<br>
	<h3 align="center">BTS Outage Detail</h3> 
	<div class="container">
	
		<br>
	<form method="get" action="update.php">
	<input type = "hidden" name = 'id'  value="<?php echo $id; ?>" /> 
	
	
	
	
	<br>
		<fieldset>
		<label>Category</label>
		<select name="category" id = "category" onchange="category_list">
			<option value=""></option>
			<option <?php echo($category=='Site')?"selected":""?>>Site</option>
			<option <?php echo($category=='Link')?"selected":""?>>Link</option>
			<option <?php echo($category=='Site+Link')?"selected":""?>>Site+Link</option>
			</select>
		 
		<label>Down Date Time</label>
		<input type="datetime" id="datetime1" name="down_Date_Time" value="<?php echo $combinedDT; ?>">
		
		<label>Up Date Time</label>
		<input type="datetime" id="datetime2" name="up_Date_Time" value="<?php echo $combinedUDT; ?>">
		</fieldset>
		<br>
		
		<fieldset>
		<legend>Site Info</legend>
		<label>Site</label>
		<input type="text" name="site" value="<?php echo $site; ?>">
			
		<label>Sector</label>
		<input type="text" name="sector" value="<?php echo $sector; ?>">
		</fieldset>
		<br>
		
		<fieldset>
		<legend>Link Info</legend>
		<label>Fiber Vendor</label>
		<select name="fiber_Vendor">
			<option value=""></option>

			<option <?php echo($fiber_Vendor=='Summit')?"selected":""?>>Summit</option>
			<option <?php echo($fiber_Vendor=='Telnet')?"selected":""?>>Telnet</option>
			<option <?php echo($fiber_Vendor=='F@H')?"selected":""?>>F@H</option>
			<option <?php echo($fiber_Vendor=='Drik')?"selected":""?>>Drik</option>
			<option <?php echo($fiber_Vendor=='APCL')?"selected":""?>>APCL</option>
			<option <?php echo($fiber_Vendor=='SCL')?"selected":""?>>SCL</option>
			<option <?php echo($fiber_Vendor=='N/A')?"selected":""?>>N/A</option>
			</select>
			
		<label>Link Between</label>
		<input type="text" name="link_Between" value="<?php echo $link_Between; ?>">
		
		<label>Information Source</label>
		<input type="text" name="information_Source" value="<?php echo $information_Source; ?>">
		
		
		<label>Outage Type</label>
		<select name="outage_type">
			<option value=""></option>
			<option <?php echo($outage_type=='Planned')?"selected":""?>>Planned</option>
			<option <?php echo($outage_type=='Unplanned')?"selected":""?>>Unplanned</option>
			</select>
	
	
		
		<label>Reason</label>
		<select name="reason">
			<option value=""></option>
			<option <?php echo($reason=='Power problem')?"selected":""?>>Power problem</option>
			<option <?php echo($reason=='Battery problem')?"selected":""?>>Battery problem</option>
			<option <?php echo($reason=='Others')?"selected":""?>>Others</option>
			</select>
	
		
		<label>Specific reason</label>
		<input type="text" name="specific_reason" value="<?php echo $specific_reason; ?>">
		</fieldset>
		<br>
		
		<fieldset>
		<legend>Vendor</legend>
		<label>Inform time</label>
		<input type="datetime" id="datetime3" name="inform_time" value="<?php echo $inform_time; ?>">
	
		<label>Inform type</label>
		<select name="inform_type">
			<option value=""></option>
			<option <?php echo($inform_type=='Phone')?"selected":""?>>Phone</option>
			<option <?php echo($inform_type=='Email')?"selected":""?>>Email</option>
			<option <?php echo($inform_type=='Phone+Mail')?"selected":""?>>Phone+Mail</option>
			</select>
	
		
		<label>Vendor Person</label>
		<input type="text" name="informed_Vendor" value="<?php echo $informed_Vendor; ?>">
		</fieldset>
		 <br>
		 
		 <fieldset>
		 <legend>CCD</legend>
		<label>Inform time</label>
		<input type="datetime" id="datetime4" name="incident_Time" value="<?php echo $incident_Time; ?>">
		
		
		
		<label>Inform type</label>
		<select name="informOfType">
			<option value=""></option>
			<option <?php echo($informOfType=='Phone')?"selected":""?>>Phone</option>
			<option <?php echo($informOfType=='Email')?"selected":""?>>Email</option>
			<option <?php echo($informOfType=='Phone')?"selected":""?>>Phone+Mail</option>
			</select>
		
		
		<label>CCD Person</label>
		<input type="text" name="informed_Person" value="<?php echo $informed_Person; ?>">
		</fieldset>
		<br>
		
		<fieldset>
		<legend>Customer Care</legend>
		<label>Resolve Time</label>
		<input type="datetime" id="datetime5" name="inform_TimeonResolve" value="<?php echo $inform_TimeonResolve; ?>">
		
		
		
		<label>Inform type</label>
		<select name="Type_Of_inform">
			<option value=""></option>
			<option <?php echo($Type_Of_inform=='Phone')?"selected":""?>>Phone</option>
			<option <?php echo($Type_Of_inform=='Email')?"selected":""?>>Email</option>
			<option <?php echo($Type_Of_inform=='Phone')?"selected":""?>>Phone+Mail</option>
			</select>
	
		<label>Customer Care Representative</label>
		<input type="text" name="informedToPerson" value="<?php echo $informedToPerson; ?>">
		
		<label>NOC duty Engineer</label>
		<input type="text" name="noc_DutyEngineer" value="<?php echo $noc_DutyEngineer; ?>">
		</fieldset>
		<br>
		<fieldset>
		<legend></legend>
		<label>Last Modify By:</label>
		<input type="text" name="last_ModifiedBy" value="<?php echo $last_ModifiedBy; ?>">
		
		<label>Last Modified Time</label>
		<input type="datetime" id="datetime6" name="last_ModifiedDT" value="<?php echo $last_ModifiedDT; ?>">
		</fieldset>
		<br>
		<fieldset>
		<legend>Remarks</legend>
		
		<input type="text" name="comment"  value="<?php echo $comment; ?>" />
		
		</fieldset>
		<br>
		<br>
		<br>
		
		<a href = "update.php"><button type="submit" name="edit" class="btn-info btn-lg">Next For Edit</button></a>
		
		
	</form>
	</div>
	<?php die($comment."test");?>
	
	
<script>
	
	
	
	
</script>

	</body>
	</html>
	
	