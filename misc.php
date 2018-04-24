<?php 

$con = mysqli_connect('localhost','root','','qubee') or die("Error in DB connection");
if (isset($_POST['submit'])) {
	$package=$_POST['package'];
	$peak_bw=$_POST['peak_bw'];
	$avg_bw=$_POST['avg_bw'];
	$down = $_POST['95%down'];
	$available_bw=$_POST['available_bw'];
  $date = $_POST['date'];
	$query="INSERT into misc VALUES('','$package','$peak_bw','$avg_bw','$down','$available_bw','$date')";
	$result = mysqli_query($con,$query);
	mysqli_close($con);
}



 ?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="loginStyle.css">

    <title>Admin page</title>
  </head>
  <body>
    <?php include 'menu2.php'; ?>
    <div class="container2">
  
  <div class="collapse navbar-collapse ">
    <ul class="list-inline text-center">
      <li><a href="miscInsert.php"><strong>Misc Insert</strong></a></li>     
      <li><a href="miscInfo.php"><strong>MISC Info</strong> </a></li>  
    </ul>
        
  </div><!-- /.nav-collapse -->
 
</div>
    <div class="wrapper">
      <div class="form">
    <form class="form-signin" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">       
      <h2 class="form-signin-heading">MISC Info</h2>
   <label for="package"><strong>Department: </strong></label>
    <select name="package"  class="form-control">
    <option selected="selected">Select Department</option>
    <option value="DMBWU">Dhaka Mango BW Utilization</option>
    <option value="DFBWU">Dhaka F@H BW Utilization</option>
    <option value="DECBWU">Dhaka Earth-Communication BW Utilization</option>
    <option value="DMBWU">Dhaka Mango BW Utilization</option>
    <option value="DFBWU">Dhaka F@H BW Utilization</option>
  </select><br>
      <input type="text" class="form-control" name="peak_bw" placeholder="PEAK BW ( Down)[Mbps]" required="" autofocus="" /><br>
      <input type="text" class="form-control" name="avg_bw" placeholder="AVG BW ( Down)[Mbps]" required=""/><br>
      <input type="text" class="form-control" name="95%down" placeholder="95 % Down[Mbps]" required=""/><br>
      <input type="text" class="form-control" name="available_bw" placeholder="Available BW" required=""/><br>
      <input type="hidden" name="date" value="<?php echo date('Y-m-d'); ?>">
      <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Submit</button>   
    </form>
  </div>
</div>

  <footer>
      <h4>&copy; Copyright 2018, QUBEE</h4>
    </footer>
  

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

  </body>
</html>
