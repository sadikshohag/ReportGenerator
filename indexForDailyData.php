<?php include('server.php');
 include 'session.php';
chk_Session(2); 
 if(isset($_GET['edit'])) {
	$id = $_GET['edit'];
	$edit_state = true;
	$rec = mysqli_query($conn,"SELECT * FROM info WHERE id = $id");
	$record = mysqli_fetch_array($rec);
	$category = $record['category'];
	$down_Date_Time = $record['down_Date_Time'];
	$up_Date_Time = $record['up_Date_Time'];
	$site = $record['site'];
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
	$bts_list = array();
	$sql = "SELECT `Qubee_ID` FROM `onair` ";
	$queryResult = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_assoc($queryResult)){
		array_push($bts_list, $row['Qubee_ID']);
	}
	
?>
<!Doctype html>
	<html>
	<head>
		<meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  
	    
		<link rel="stylesheet" type="text/css"  href="style.css">
	
		
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<script src="js/bootstrap.min.js"></script>
		<link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet">
		<script src="js/bootstrap-datetimepicker.min.js"></script>
		<script type="text/javascript" src="jquery/jquery-1.8.3.min.js" charset="UTF-8"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
		<script type="text/javascript" src="js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
		<link rel="stylesheet" href="css/bootstrap.min.css">
		
</head>

<body>

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
<?php include 'menu2.php'; ?>
<br>
   <div class="container2">
  
	<div class="collapse navbar-collapse js-navbar-collapse">
		<ul class="list-inline text-center">
			<li><a href="indexForDailyData.php"><strong>Insert Outage</strong></a></li>			
			<li><a href="viewOutage.php"><strong>View Outage</strong> </a></li>			
			<li><a href="planedOutage.php"><strong>Planned/Unplanned Outage</strong> </a></li>			
			<li><a href="outageGraph.php"><strong>Outage Minute Graph</strong> </a></li>			
			<li><a href="userImpact.php"><strong>User Imapct Graph</strong> </a></li>			
		</ul>
        
	</div><!-- /.nav-collapse -->
</div>





<br>
<div class="container">
	<form method="post" action="server.php">
	
	<br>
		<fieldset>
		<label><b>Category</label>
  <select name = "category" id="category" onchange="category_list()">
		    <option value=""></option>
           <option <?php echo($category=='Site')?"selected":""?>>Site</option>
			<option <?php echo($category=='Link')?"selected":""?>>Link</option>
			<option <?php echo($category=='Site+Link')?"selected":""?>>Site+Link</option>
 </select> 
 </fieldset>
 
 <div id="trSite" class="general">
	 <fieldset>
	 <legend>Site Info</legend>
	  <label><b>Site</b></label> 
	 <!--<input type="text" name="site" value="<?php //echo $site; ?>">-->
	  <select name="site">
		<option value=""></option>
		<?php
			foreach($bts_list as $bts){
				$selected=($options == $bts)? "selected" : "";
				echo "<option '.$selected.'value=".$bts.">". $bts ."</option>" ;
			}
		
		?>
			 
	 </select>
	<label><b>Sector</b></label>
	 <select name="sector">
	 <option value=""></option>
	 <option <?php echo($sector=='1')?"selected":""?>>1</option>
	 <option <?php echo($sector=='2')?"selected":""?>>2</option>
	 <option <?php echo($sector=='3')?"selected":""?>>3</option>
	 <option <?php echo($sector=='4')?"selected":""?>>4</option>
	 <option <?php echo($sector=='5')?"selected":""?>>5</option>
	 <option <?php echo($sector=='6')?"selected":""?>>6</option>
	 <option <?php echo($sector=='7')?"selected":""?>>7</option>
	 </select>
	</fieldset>
</div>
<br>
<div>
	<fieldset>
	<label><b>Information Source</b></label> 
		 <input type="text" name="information_Source" value="<?php echo $information_Source; ?>">
		 <label><b>Outage Type</label>
		 <select name="outage_type">
			<option value=""></option>
			<option <?php echo($outage_type=='Planned')?"selected":""?>>Planned</option>
			<option <?php echo($outage_type=='Unplanned')?"selected":""?>>Unplanned</option>
		 </select>

		 <label><b>Reason</label>
		 <select name="reason">
			<option value=""></option>
			<option <?php echo($reason=='Power problem')?"selected":""?>>Power problem</option>
			<option <?php echo($reason=='Battery problem')?"selected":""?>>Battery problem</option>
			<option <?php echo($reason=='Fiber problem')?"selected":""?>>Fiber problem</option>
			<option <?php echo($reason=='Equipment problem')?"selected":""?>>Equipment problem</option>
			<option <?php echo($reason=='Technical problem')?"selected":""?>>Technical problem</option>
			<option <?php echo($reason=='Problem at SCL end')?"selected":""?>>Problem at SCL end</option>
			<option <?php echo($reason=='Problem at Summit end')?"selected":""?>>Problem at Summit end</option>
			<option <?php echo($reason=='CPRI cable faulty')?"selected":""?>>CPRI cable faulty</option>
			<option <?php echo($reason=='PMU faulty')?"selected":""?>>PMU faulty</option>
			<option <?php echo($reason=='Soft block')?"selected":""?>>Soft block</option>
			<option <?php echo($reason=='Device malfunctioning')?"selected":""?>>Device malfunctioning</option>
			<option <?php echo($reason=='Device problem at SCL end')?"selected":""?>>Device problem at SCL end</option>
			<option <?php echo($reason=='Breaker tripped')?"selected":""?>>Breaker tripped</option>
			<option <?php echo($reason=='Link flap')?"selected":""?>>Link flap</option>
			<option <?php echo($reason=='Others')?"selected":""?>>Others</option>
			</select>
		 
		 <label><b>Specific reason</label>
		 <input type="text" name="specific_reason" value="<?php echo $specific_reason; ?>">
		</fieldset>
</div>
<br>
	 <div id="trLink" class="general"> 
	 <fieldset>
		 <legend>Link Info</legend>
		 <label><b>Fiber Vendor</label>
		 <select name="fiber_Vendor">
			<option value=""></option>
			<option <?php echo($fiber_Vendor=='Summit')?"selected":""?>>Summit</option>
			<option <?php echo($fiber_Vendor=='Telnet')?"selected":""?>>Telnet</option>
			<option <?php echo($fiber_Vendor=='F@H')?"selected":""?>>F@H</option>
			<option <?php echo($fiber_Vendor=='APCL')?"selected":""?>>APCL</option>
			<option <?php echo($fiber_Vendor=='SCL')?"selected":""?>>SCL</option>
			<option <?php echo($fiber_Vendor=='N/A')?"selected":""?>>N/A</option>

			</select>
			
		 <label><b>Link Between</b></label>
		 <input type="text" name="link_Between" value="<?php echo $link_Between; ?>"> 
		 <!-- <label><b>Information Source</b></label> 
		 <input type="text" name="information_Source" value="<?php echo $information_Source; ?>">
		 <label><b>Outage Type</label>
		 <select name="outage_type">
			<option value=""></option>
			<option <?php echo($outage_type=='Planned')?"selected":""?>>Planned</option>
			<option <?php echo($outage_type=='Unplanned')?"selected":""?>>Unplanned</option>
			</select> -->
	
		
		 
		</fieldset>
		</div>
		<br>
		
	
		<br>
		<fieldset>
       <legend>Date Time</legend>		
			<label>Down Date Time</label>
		<input type="datetime" id="datetime1" name="down_Date_Time" value="<?php echo $down_Date_Time; ?>">
		
		<label>Up Date Time</label>
		<input type="datetime" id="datetime2" name="up_Date_Time" value="<?php echo $up_Date_Time; ?>">
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
		 
		 <div id = "content5">
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
		</div>
		<br>
		
		<div id = "content6">
		<fieldset>
		<legend>NOC</legend>
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
		<input type="text" name="informedToPerson" value="<?php echo $informedToPerson; ?>"></fieldset>
		<br>
		<fieldset>
		<label>NOC duty Engineer</label>
		<input type="text" name="noc_DutyEngineer" value="<?php echo $noc_DutyEngineer; ?>">
		</fieldset></div>
		<br>
		<fieldset>
		
		<input type="hidden" name="last_ModifiedBy" value="<?php echo $_SESSION['uname']; ?>">
		<input type="hidden" name="last_ModifiedDT" value="<?php echo date('Y-m-d'); ?>">
		</fieldset>
		<br>
		<fieldset>
		<legend>Remarks</legend>
		<label>
		<center><input type="textarea" name="comment" value="<?php echo $comment; ?>"/></center>
		</label>
		</fieldset>
		</form>
		<br> 
		<button type="save" name="save" class="btn-success btn-lg">Save</button>	
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
		
	$(function () {
            $('.general').hide();
            $('#category').change(function () {
				
		var category = document.getElementById("category").value; 
		 
		 if (category == "Site") { 
		 document.getElementById("trSite").style.display = 'block'; 
		 document.getElementById("trLink").style.display = 'none'; 
		 
		 
		 } 
		 else if(category=="Link")
		 { 
		 document.getElementById("trLink").style.display = 'block'; 
		 document.getElementById("trSite").style.display = 'none'; 
		 
		 
		 }
		 else{
			document.getElementById("trLink").style.display = 'block'; 
			document.getElementById("trSite").style.display = 'block';
		 }
		 
		 
			
			});				
			});				
		
		
			
 
</script>
<br>

	</body>
	
	</html>
	
	