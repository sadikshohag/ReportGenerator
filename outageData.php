
<?php
$hard_details_data = array();

$dt = new DateTime("now", new DateTimeZone('Asia/Dhaka'));
$toDate = $dt->format('Y-m-d');

$dt->modify('-7 day');
$fromDate = $dt->format('Y-m-d');

$con = mysqli_connect("localhost","root","","qubee");
$query = "SELECT id,Site,Down_Date,Down_Time,reason,outage_type FROM INFO where Down_Date >= '$fromDate' and Up_Date='0000-00-00'";
$result = mysqli_query($con,$query);
while($row = mysqli_fetch_assoc($result))
    {
      $hard_details_data[]=$row;
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
		<title>QUBEE Outage Data</title>
		
	</head>
	<body>
<?php include 'menu2.php'; ?>
<br>

<div class="container2">
  
	<div class="collapse navbar-collapse js-navbar-collapse">
		<ul class="list-inline text-center">
			<li><a href="indexForDailyData.php"><strong>Insert Outage</strong></a></li>	
			<li><a href="outage.php"><strong>Outage Log</strong></a></li>			
			<li><a href="viewOutage.php"><strong>View Outage</strong> </a></li>
			<li><a href="outageData.php"><strong>Outage Data</strong></a></li>			
			<li><a href="planedOutage.php"><strong>Planned/Unplanned Outage</strong> </a></li>			
			<!-- <li><a href="outageGraph.php"><strong>Outage Minute Graph</strong> </a></li>			 -->
			<li><a href="userImpact.php"><strong>User Imapct Graph</strong> </a></li>			
		</ul>
        
	</div><!-- /.nav-collapse -->
 
</div>
		<div class="container">
			<div class="page-header text-center">
				<h2>QUBEE Site Outage Data</h2>
			</div>
			<div class="col-md-3">
				<input type="text" name="from_date" id="from_date" class="form-control" placeholder="Down Date">
			</div>
			<div class="col-md-3">  
                     <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" />  
            </div>  
			<div class="col-md-5">
				<input type="button" name="filter" id="filter" value="Filter" class="btn btn-info">
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
		                  <th>Down Date</th>
		                  <th>Down Time</th>
		                  <!-- <th>Up Date</th>
		                  <th>Up Time</th>
		                  <th>Total Down Time (Minutes)</th> -->
		                  <th>Planned/Unplanned</th>
		                  <th>Reason</th>
		                  <th>Detail</th>
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
		                    <!-- <td><?php echo $Oneuser['Up_Date'];?></td>
		                    <td><?php echo $Oneuser['Up_Time'];?></td>
		                    <td><?php echo $Oneuser['Duration_of_Outage_Mins']?></td> -->
		                    <td><?php echo $Oneuser['outage_type']  ?></td>
		                    <td><?php echo $Oneuser['reason'];?></td>

		                    <td><a href="display.php?edit=<?php echo $Oneuser['id'] ;?>">Detail</a></td>
		                  </tr>
		                    <?php
		                   
		                  endforeach;
		                endif;
		              ?>
		            </tbody>
					
				</table>
				
			</div>
			<br>

		<a href="delete.php"><button style="float:right" type="submit" name="update" class="btn-danger btn-lg">Delete</button></a>
		<a href="indexForDailyData.php"><button style="float:right" class=" btn-primary btn-lg ">Add</button></a>
		</div>
		<script type="text/javascript" src="js/script.js"></script>
	</body>
</html>

 <script>  
      $(document).ready(function(){  
           $.datepicker.setDefaults({  
                dateFormat: 'yy-mm-dd'   
           });  
           $(function(){  
                $("#from_date").datepicker();  
                $("#to_date").datepicker();  
           });  
           $('#filter').click(function(){  
                var from_date = $('#from_date').val();  
                var to_date = $('#to_date').val();  
                if(from_date != '' && to_date != '')  
                {  
                     $.ajax({  
                          url:"downfilter.php",  
                          method:"POST",  
                          data:{from_date:from_date, to_date:to_date},  
                          success:function(data)  
                          {  
                               $('#daily_data').html(data);  
                          }  
                     });  
                }  
                else  
                {  
                     alert("Please Select Date");  
                }  
           });  
      });  
 </script>

