<?php 
function chk_Session($page_permission)
{
  session_start();

  // $page_permission = 1;

 // var_dump(in_array();die;

  if(isset($_SESSION['user'])){
    if(in_array($page_permission,$_SESSION['permissions'])){

    }else{
      header("location: home.php");
    }

  }else{
    header("location: index.php");
  }
}
 ?>