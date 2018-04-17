<?php include('server.php');
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
	$id = $record['id'];
	
	?>
	
	 <!DOCTYPE html>  
 <html>  
      <head>  
           <title></title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
           <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>            
           <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" /> 
			<link rel="stylesheet" type="text/css"  href="style.css">		   
      </head>  
      <body>  
           <div class="container1">
  
    
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
	</div><!-- /.nav-collapse -->
 
</div>
	  <br>
           <div class="container2">
  
	<div class="collapse navbar-collapse js-navbar-collapse">
		<ul class="nav navbar-nav">
			<li><a href="down.php"><strong>Insert Outage</strong></a></li>			
			<li><a href="outagereport.php"><strong>View Outage</strong> </a></li>			
			<li><a href="#"><strong>Planned/Unplanned Outage</strong> </a></li>			
			<li><a href="#"><strong>Outage Minute Graph</strong> </a></li>			
			<li><a href="#"><strong>User Imapct Graph</strong> </a></li>			
		</ul>
        
	</div><!-- /.nav-collapse -->
 
</div>


           <div class="container">  
                <h3 align="center">BTS Outage Data</h3>  
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
                                    <td bgcolor="#72e5bf">Delete</td>
                                    
                                    
  
                               </tr>  
                          </thead> 
				<tbody>						  
                         <?php 
while ($row = mysqli_fetch_array($result)){ ?>
		<tr>
			
			
			<td><?php echo $row['category'];?></td>
			<td><?php echo $row['down_Date_Time'];?></td>
			<td><?php echo $row['up_Date_Time']; ?></td>
			<td><?php echo $row['site']; ?></td>
			<td><?php echo $row['sector']; ?></td>
			<td><?php echo $row['fiber_Vendor']; ?></td>
			<td><?php echo $row['link_Between']; ?></td>
			<td><?php echo $row['information_Source']; ?></td>
			<td><?php echo $row['reason']; ?></td>
			<td>
				<a href="delete.php?del=<?php echo $row['id'] ;?>">Delete</a>
			</td>
			
		</tr>
  <?php 
	} 
   ?>
                    
</tbody>					
</table>  
<br>

		
					 
					
 </div>  
 </div> 
</body>
</html> 