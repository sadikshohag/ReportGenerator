<?php include('server1.php');
	
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
	 <br> 
           <div class="container2">
  
	<div class="collapse navbar-collapse js-navbar-collapse">
		<ul class="list-inline text-center">
			<li><a href="down.php"><strong>Insert Outage</strong></a></li>			
			<li><a href="viewOutage.php"><strong>View Outage</strong> </a></li>			
			<li><a href="planedOutage.php"><strong>Planned/Unplanned Outage</strong> </a></li>			
			<li><a href="outageGraph.php"><strong>Outage Minute Graph</strong> </a></li>			
			<li><a href="#"><strong>User Imapct Graph</strong> </a></li>			
		</ul>
        
	</div><!-- /.nav-collapse -->
</div>

	<?php $id = $_GET['id'];?>
	
	<br>
	<h3 align="center">Edit Data</h3>
 
	<div class="container">
	<br>
	<form method="post" action="server1.php">
	<input type = "hidden" name = 'id' " value="<?php echo $id; ?>" /> 
	
	
	
		<fieldset>
		<label>Category</label>
		<select name="category" id = "category" onchange="category_list">
			<option value=""></option>
			<option <?php echo($_GET['category']=='Site')?"selected":""?>>Site</option>
			<option <?php echo($_GET['category']=='Link')?"selected":""?>>Link</option>
			<option <?php echo($_GET['category']=='Site+Link')?"selected":""?>>Site+Link</option>
			</select>
		 
		<label>Down Date Time</label>
		<input type="datetime" id="datetime1" name="down_Date_Time" value="<?php echo $_GET['down_Date_Time']; ?>">
		
		<label>Up Date Time</label>
		<input type="datetime" id="datetime2" name="up_Date_Time" value="<?php echo $_GET['up_Date_Time']; ?>">
		</fieldset>
		<br>
		
		<fieldset>
		<legend>Site Info</legend>
		<label>Site</label>
		<input type="text" name="site" value="<?php echo $_GET['site']; ?>">
			
		<label>Sector</label>
		<input type="text" name="sector" value="<?php echo $_GET['sector']; ?>">
		</fieldset>
		<br>
		
		<fieldset>
		<legend>Link Info</legend>
		<label>Fiber Vendor</label>
		<select name="fiber_Vendor">
			<option value=""></option>
			<option <?php echo($_GET['fiber_Vendor']=='Summit')?"selected":""?>>Summit</option>
			<option <?php echo($_GET['fiber_Vendor']=='Telnet')?"selected":""?>>Telnet</option>
			<option <?php echo($_GET['fiber_Vendor']=='F@H')?"selected":""?>>F@H</option>
			</select>
			
		<label>Link Between</label>
		<input type="text" name="link_Between" value="<?php echo $_GET['link_Between']; ?>">
		
		<label>Information Source</label>
		<input type="text" name="information_Source" value="<?php echo $_GET['information_Source']; ?>">
		
		
		<label>Outage Type</label>
		<select name="outage_type">
			<option value=""></option>
			<option <?php echo($_GET['outage_type']=='Planned')?"selected":""?>>Planned</option>
			<option <?php echo($_GET['outage_type']=='Unplanned')?"selected":""?>>Unplanned</option>
			</select>
	
	
		
		<label>Reason</label>
		<select name="reason">
			<option value=""></option>
			<option <?php echo($_GET['reason']=='Power problem')?"selected":""?>>Power problem</option>
			<option <?php echo($_GET['reason']=='Battery problem')?"selected":""?>>Battery problem</option>
			<option <?php echo($_GET['reason']=='Others')?"selected":""?>>Others</option>
			</select>
			<br>
		
		<label>Specific reason</label>
		<input type="text" name="specific_reason" value="<?php echo $_GET['specific_reason']; ?>">
		</fieldset>
		<br>
		
		<fieldset>
		<legend>Vendor</legend>
		<label>Inform time</label>
		<input type="datetime" id="datetime3" name="inform_time" value="<?php echo $_GET['inform_time']; ?>">
	
		<label>Inform type</label>
		<select name="inform_type">
			<option value=""></option>
			<option <?php echo($_GET['inform_type']=='Phone')?"selected":""?>>Phone</option>
			<option <?php echo($_GET['inform_type']=='Email')?"selected":""?>>Email</option>
			<option <?php echo($_GET['inform_type']=='Phone+Mail')?"selected":""?>>Phone+Mail</option>
			</select>
	
		
		<label>Vendor Person</label>
		<input type="text" name="informed_Vendor" value="<?php echo $_GET['informed_Vendor']; ?>">
		</fieldset>
		 <br>
		 
		 <fieldset>
		 <legend>CCD</legend>
		<label>Inform time</label>
		<input type="datetime" id="datetime4" name="incident_Time" value="<?php echo $_GET['incident_Time']; ?>">
		
		
		
		<label>Inform type</label>
		<select name="informOfType">
			<option value=""></option>
			<option <?php echo($_GET['informOfType']=='Phone')?"selected":""?>>Phone</option>
			<option <?php echo($_GET['informOfType']=='Email')?"selected":""?>>Email</option>
			<option <?php echo($_GET['informOfType']=='Phone')?"selected":""?>>Phone+Mail</option>
			</select>
		
		
		<label>CCD Person</label>
		<input type="text" name="informed_Person" value="<?php echo $_GET['informed_Person']; ?>">
		</fieldset>
		<br>
		
		<fieldset>
		<legend>Customer Care</legend>
		<label>Resolve Time</label>
		<input type="datetime" id="datetime5" name="inform_TimeonResolve" value="<?php echo $_GET['inform_TimeonResolve']; ?>">
		
		
		
		<label>Inform type</label>
		<select name="Type_Of_inform">
			<option value=""></option>
			<option <?php echo($_GET['Type_Of_inform']=='Phone')?"selected":""?>>Phone</option>
			<option <?php echo($_GET['Type_Of_inform']=='Email')?"selected":""?>>Email</option>
			<option <?php echo($_GET['Type_Of_inform']=='Phone')?"selected":""?>>Phone+Mail</option>
			</select>
	
		<label>Customer Care Representative</label>
		<input type="text" name="informedToPerson" value="<?php echo $_GET['informedToPerson']; ?>">
		
		<label>NOC duty Engineer</label>
		<input type="text" name="noc_DutyEngineer" value="<?php echo $_GET['noc_DutyEngineer']; ?>">
		</fieldset>
		<br>
		<fieldset>
		
		<input type="hidden" name="last_ModifiedBy" value="<?php echo $_SESSION['uname']; ?>">
		<input type="hidden" name="last_ModifiedDT" value="<?php echo date('Y-m-d'); ?>">
		</fieldset>
		<br>
		
		<fieldset>
		<legend>Remarks</legend>
		<label>
		<input type="text" name="comment"  value="<?php echo $_GET['comment']; ?>"></input>
		</label>
		</fieldset>
		<br>
		
		<button style="float:center" type="submit" name="update" class="btn-success btn-lg">Update</button>
		
		</form>
	
		
	</div>
	    
	
<script>
	
	$("#datetime1").datetimepicker({
		weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
        showMeridian: 1
});
$("#datetime2").datetimepicker({
		weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
        showMeridian: 1
});
$("#datetime3").datetimepicker({
    weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
        showMeridian: 1
});
$("#datetime4").datetimepicker({
		weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
        showMeridian: 1
});
$("#datetime5").datetimepicker({
		weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
        showMeridian: 1
});
	
$("#datetime6").datetimepicker({
		weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
        showMeridian: 1
});	
	
</script>

	</body>
	</html>
	
	