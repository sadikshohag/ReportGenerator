<?php 
include 'session.php';
chk_Session(1); ?>
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
    <!-- <div class="wrapper"> -->
    <div class="wrapper">
		<div class="container2">
  
	<div class="collapse navbar-collapse js-navbar-collapse">
		<ul class="list-inline text-center">
			<li><a href="createUser.php"><strong>Create User</strong></a></li>			
			<li><a href="userInfo.php"><strong>View User Info</strong> </a></li>			
		
		</ul>
        
	</div><!-- /.nav-collapse -->
 
</div>
      <div class="form">
    <form class="form-signin" action="permissions.php" method="post">       
      <h2 class="form-signin-heading">Create User</h2>
      <input type="text" class="form-control" name="username" placeholder="Username" required="" autofocus="" /><br>
      <input type="text" class="form-control" name="phone" placeholder="phone no" required=""/><br>
      <input type="email" class="form-control" name="email" placeholder="Email address" required=""/><br>
      <label for="department"><strong>Department: </strong></label>
    <select name="department"  class="form-control">
    <option selected="selected">Select Department</option>
    <option value="NOC">NOC</option>
    <option value="CCD">CCD </option>
    <option value="Employee">Admin</option>
  </select><br>
      <input type="text" class="form-control" name="designation" placeholder="Enter designation" required=""/><br>
      <input type="password" class="form-control" name="password" placeholder="Password" required=""/>
      <input type="password" class="form-control" name="re-password" placeholder="re-type Password" required=""/>    
      <button class="btn btn-lg btn-primary btn-block" type="submit" name="create">Create user</button>   
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
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
  </body>
</html>
