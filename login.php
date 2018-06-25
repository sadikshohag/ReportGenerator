<?php
session_start();
$dbc=mysqli_connect('localhost','root','','qubee')
or die('Error for establishing connection');

if (isset($_POST['submit'])) {
 	
 	  $username = mysqli_real_escape_string($dbc,$_POST['username']);
      $password = mysqli_real_escape_string($dbc,$_POST['password']);

 	$query="SELECT user_id FROM user WHERE username = '$username'AND password='$password'"
 	or die('error querying to database');
 	$_SESSION['uname'] = $username;
 	$result = mysqli_query($dbc,$query);
 	$count=mysqli_num_rows($result);
 	if($count==1){
		$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
     	$id=$row['user_id'];
 		$_SESSION['user']=$id;
 		$query1="SELECT * FROM `user_perm` where userid='$id'";
 		$permissionResult = mysqli_query($dbc,$query1);

 		$permissionList = array();
 		while($row1=mysqli_fetch_assoc($permissionResult)){
 			array_push($permissionList, $row1['permid']);
 		}
 		
 		$_SESSION['permissions'] = $permissionList;



 		// $_SESSION['u_per']=$row1['permid'];
 		// var_dump($_SESSION['u_per']);die();
 		header('location: home.php');
 	}else{

 		echo 'Invalid username or password';
 	}

 } 
    mysqli_close($dbc);


 ?>