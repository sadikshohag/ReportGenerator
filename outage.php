
<?php 
$conn = mysqli_connect('localhost','root','','qubee');
	$rec = mysqli_query($conn,"SELECT * FROM info"); ?>




<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css"  href="style.css">
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
			<li><a href="down.php"><strong>Insert Outage</strong></a></li>			
			<li><a href="viewOutage.php"><strong>View Outage</strong> </a></li>			
			<li><a href="planedOutage.php"><strong>Planned/Unplanned Outage</strong> </a></li>			
			<li><a href="outageGraph.php"><strong>Outage Minute Graph</strong> </a></li>			
			<li><a href="userImpact.php"><strong>User Imapct Graph</strong> </a></li>			
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
                                    <td bgcolor="#72e5bf">Detail</td>
                                    
                                    
  
                               </tr>  
                          </thead> 
				<tbody>						  
                         <?php 
while ($row = mysqli_fetch_array($rec)){ ?>
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
				<a href="display.php?edit=<?php echo $row['id'] ;?>">Detail</a>
			</td>
			
		</tr>
  <?php 
	} 
   ?>
                    
</tbody>					
</table>  
<br>
<a href="indexForDailyData.php"><button style="float:right" class=" btn-primary btn-lg ">Add</button></a>
				
 </div>  
 </div> 
