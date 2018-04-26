
<?php
$hard_details_data = array();
$current_Date=date("Y-m-d");
$from_date_time=$current_Date.'00:00:00';
$to_date_time=$current_Date.'23:59:59';
$con = mysqli_connect("localhost","root","","test");
$query = "SELECT Site,Down_Date,Down_Time,Up_Date,Up_Time,Duration_of_Outage_Mins,ReasonCategory FROM INFO where Down_Date <= '$current_Date' and  Up_Date >= '$current_Date'";
$result = mysqli_query($con,$query);
while($row = mysqli_fetch_assoc($result))
    {
      $hard_details_data[]=$row;
    }

    if(isset($_POST["ExportType"]))
	{
	 
    switch($_POST["ExportType"])
    	{
        case "export-to-excel" :
            // Submission from
			$filename = $_POST["ExportType"] . ".xls";		 
            header("Content-Type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename=\"$filename\"");
			ExportFile($hard_details_data);
			//$_POST["ExportType"] = '';
            exit();
        default :
            die("Unknown action : ".$_POST["action"]);
            break;
    	}
	}

function ExportFile($records) {
	$heading = false;
		if(!empty($records))
		  foreach($records as $row) {
			if(!$heading) {
			  // display field/column names as a first row
			  echo implode("\t", array_keys($row)) . "\n";
			  $heading = true;
			}
			echo implode("\t", array_values($row)) . "\n";
		  }
		exit;
}

?>

<!DOCTYPE html>
<html>
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>  
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"> 
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script> -->
		<title>QUBEE Daily Site Outage </title>
		
	</head>
	<body>
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
		<div class="container">
			<div class="page-header text-center">
				<h2>QUBEE Daily Site Outage</h2>
			</div>
			<div class="col-md-6">
				<input type="text" name="down_date" id="down_date" class="form-control" placeholder="Search According Down Date">
			</div>
			<div class="col-md-3">
				<input type="button" name="filter" id="filter" value="Filter" class="btn btn-info">
			</div>
			<div class="btn-group pull-right">
				<!-- <button type="button" class="btn btn-info">Action</button> -->
				<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
				<span class="caret"></span>
				<span class="sr-only">Toggle Dropdown</span>
				</button>
				<ul class="dropdown-menu" role="menu" id="export-menu">
				<li id="export-to-excel"><a href="#">Export to excel</a></li>
				<li class="divider"></li>
				<li><a href="#">Other</a></li>
				</ul>
				</div>
				
			  <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" id="export-form">
				<input type="hidden" value='' id='hidden-type' name='ExportType'/>
			  </form>
			<div style="clear:both"></div>                 
                <br /> 
                <br />
			<div id="daily_data">
				<table class="table table-bordered table-hovor">
					<thead>
		                <tr class="alert-success">
		                  <th>SL</th>
		                  <th>Site</th>
		                  <th width="10px">Down Date</th>
		                  <th>Down Time</th>
		                  <th>Up Date</th>
		                  <th>Up Time</th>
		                  <th>Total Down Time (Minutes)</th>
		                  <th>Planned/Unplanned</th>
		                  <th>Reason</th>
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
		                    <td><?php echo $Oneuser['Site'];?></td>
		                    <td><?php echo $Oneuser['Down_Date'];?></td>
		                    <td><?php echo $Oneuser['Down_Time'];?></td>
		                    <td><?php echo $Oneuser['Up_Date'];?></td>
		                    <td><?php echo $Oneuser['Up_Time'];?></td>
		                    <td><?php echo $Oneuser['Duration_of_Outage_Mins']?></td>
		                    <td>Planned</td>
		                    <td><?php echo $Oneuser['ReasonCategory'];?></td>
		                  </tr>
		                    <?php
		                   
		                  endforeach;
		                endif;
		              ?>
		            </tbody>
					
				</table>
				
			</div>
		</div>
		<script type="text/javascript" src="js/script.js"></script>
	</body>
</html>
<script  type="text/javascript">
$(document).ready(function() {
jQuery('#export-menu li').bind("click", function() {
var target = $(this).attr('id');
switch(target) {
	case 'export-to-excel' :
	$('#hidden-type').val(target);
	//alert($('#hidden-type').val());
	$('#export-form').submit();
	$('#hidden-type').val('');
	break
}
});
    });
</script>
