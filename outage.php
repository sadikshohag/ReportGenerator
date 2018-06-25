
<?php 

include 'session.php';
chk_Session(3);
$conn = mysqli_connect('localhost','root','','qubee');


$dt = new DateTime("now", new DateTimeZone('Asia/Dhaka'));
$toDate = $dt->format('Y-m-d');

$dt->modify('-30 day');
$fromDate = $dt->format('Y-m-d');

$rec = mysqli_query($conn,"SELECT * FROM info where Down_Date>='$fromDate'"); 




	?>


<!DOCTYPE html>
<html>
<head>
	<title>Outage</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> 
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>  
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">  
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<link rel="stylesheet" type="text/css"  href="style.css">
</head>
<body>




<!------ Include the above in your HEAD tag ---------->
<?php include 'menu2.php'; ?>
<!-- <div class="container1">
  
    
		<a class="navbar-brand" href="#">Qubee</a>
	
	
	<div class="collapse navbar-collapse js-navbar-collapse">
		<ul class="nav navbar-nav">
			<li><a href="menu2.php"><strong>Home </strong></a></li>			
			<li><a href="#"><strong>Outage</strong> </a></li>			
			<li><a href="topUser.php"><strong>Top Users</strong> </a></li>			
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
			<li><a href="indexForDailyData.php"><strong>Insert Outage</strong></a></li>
			<li><a href="outage.php"><strong>Outage Log</strong></a></li>			
			<li><a href="viewOutage.php"><strong>View Daily Outage</strong> </a></li>
			<li><a href="outageData.php"><strong>Outage Data</strong></a></li>						
			<li><a href="planedOutage.php"><strong>Planned/Unplanned Outage</strong> </a></li>			
			<!-- <li><a href="outageGraph.php"><strong>Outage Minute Graph</strong> </a></li>			 -->
			<li><a href="userImpact.php"><strong>User Imapct Graph</strong> </a></li>			
		</ul>
        
	</div><!-- /.nav-collapse -->
 
</div>
		   
           <div class="container">  
                <h3 align="center">BTS Outage Log</h3>  
				<br />

				<div class="col-md-3">
				<input type="text" name="from_date" id="from_date" class="form-control" placeholder="Down Date">
				</div>
				<div class="col-md-3">  
	                     <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" />  
	            </div>  
				<div class="col-md-5">
					<input type="button" name="filter" id="filter" value="Filter" class="btn btn-info">
				</div> 
				<div style="clear:both"></div>                 
                <br /> 
                <br />
                <div class="table-responsive">  
				
                     <table id="BTS_data" class="table table-striped table-bordered"> 
						
                          <thead>  
                               <tr>  
                                    <td bgcolor="#72e5bf">Category</td> 
                                    <td bgcolor="#72e5bf">Down Date Time</td>  
                                    <td bgcolor="#72e5bf">Up Date Time</td>  
									<td bgcolor="#72e5bf">Site</td>  
                                    <td bgcolor="#72e5bf">Sector</td>  
                                    <td bgcolor="#72e5bf">Fiber vendor</td>  
                                    <td bgcolor="#72e5bf">Link between</td>  
                                    <td bgcolor="#72e5bf">Information source</td>  
                                    <td bgcolor="#72e5bf">Reason</td>
                                    <td bgcolor="#72e5bf">Detail</td>
                                    
                                    
  
                               </tr>  
                          </thead> 
				<tbody>						  
                         <?php 
while ($row = mysqli_fetch_array($rec)){ ?>
		<tr>
			
			
			<td><?php echo $row['category'];?></td>
			<td><?php echo $row['Down_Date']."  ".$row['Down_Time'];?></td>
			<td><?php echo $row['Up_Date']."  ".$row['Up_Time']; ?></td>
			<td><?php echo $row['Site']; ?></td>
			<td><?php echo $row['sector']; ?></td>
			<td><?php echo $row['fiber_Vendor']; ?></td>
			<td><?php echo $row['link_Between']; ?></td>
			<td><?php echo $row['information_Source']; ?></td>
			<td><?php echo $row['reason']; ?></td>
			<td>
				<a href="display.php?edit=<?php echo $row['id'] ;?>">Detail</a>
			</td>
			
		</tr>
  <?php 
	} 
   ?>
                    
</tbody>					
</table>  
<br>

<a href="delete.php"><button style="float:right" type="submit" name="update" class="btn-danger btn-lg">Delete</button></a>
<a href="indexForDailyData.php"><button style="float:right" class=" btn-primary btn-lg ">Add</button></a>
				
 </div>  
 </div> 

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
                          url:"logfilter.php",  
                          method:"POST",  
                          data:{from_date:from_date, to_date:to_date},  
                          success:function(data)  
                          {  
                               $('#BTS_data').html(data);  
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
