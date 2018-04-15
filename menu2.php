<?php 
session_start();
$user_id=$_SESSION['user'];

$dbc=mysqli_connect('localhost','root','','qubee')
or die('Error for establishing connection');
$query="SELECT permid FROM user_perm WHERE userid='$user_id'";
$result = mysqli_query($dbc,$query);
$row=array();
 while($rows=mysqli_fetch_array($result)){

     array_push($row,$rows['permid']);
 }
 
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Qubee</title>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css"  href="style.css">
<!------ Include the above in your HEAD tag ---------->
</head>
<body>

<div class="container1">
  
    
		<a class="navbar-brand" href="menu2.php">Qubee</a>
	
	
	<div class="collapse navbar-collapse js-navbar-collapse">
		<ul class="nav navbar-nav">
			<li><a href="menu2.php"><strong>Home </strong></a></li>			
			<li><a href="outage.php"><strong>Outage</strong> </a></li>			
			<li><a href="topUser.php"><strong>Top Users</strong> </a></li>			
			<li><a href="bts.php"><strong>BTS</strong> </a></li>			
			<li><a href="misc.php"><strong>MISC</strong> </a></li>	
			<?php if(in_array(1, $row)){ ?>		
			<li><a href="adminOperation.php"><strong>Admin Operations </strong></a></li>	
			<?php } ?>				
            <li><a href="about.php"><strong>About</strong></a></li>
            <li><a href="#"><strong>Contact Us</strong></a></li>
		</ul>
        <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="logout.php"><strong>LOGOUT</strong></a></li>
      </ul>
	</div><!-- /.nav-collapse -->
 
</div>
</body>
</html>



