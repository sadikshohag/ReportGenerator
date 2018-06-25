<?php 
include 'session.php';
chk_Session(1); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>User information</title>
<!--   <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css"  href="loginStyle.css">
<link rel="stylesheet" type="text/css"  href="style.css"> -->
<style>
* {
  box-sizing: border-box;
}

#myInput {

  background-position: 10px 10px;
  background-repeat: no-repeat;
  width: 20%;
  font-size: 16px;
  padding: 6px 10px 6px 20px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
  margin-left: 10px;
}

#myTable{

  margin-left:10px;
  margin-right:10px;
  float:center;
}


</style>

</head>
<body>
	<?php 
include 'menu2.php';
 ?>
  <br/>  
    <div class="container2">
  
  <div class="collapse navbar-collapse js-navbar-collapse">
    <ul class="list-inline text-center">
      <li class="active"><a href="createUser.php"><strong>Create User</strong></a></li>      
      <li><a href="userInfo.php"><strong>View User Info</strong> </a></li>      
    
    </ul>
        
  </div><!-- /.nav-collapse -->
 
</div>
 <div class="page-header text-center">
   
 <h2>User's Information</h2>
 </div>
 
 <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search By names.." title="Type in a name">
 
 <div class="table-reponsive">
   
   <table id="myTable" class="table table-bordered table-hover table-striped">
     
     <thead>
       <tr class="alert-success">
         <th>User Name</th>
         <th>Email</th>
         <th>Phone</th>
         <th>Permissions</th>
         <th>Update</th>
         <th>Delete</th>
       </tr>
     </thead>
 
     <tbody>
       
       <?php 
 
       $dbc=mysqli_connect('localhost','root','','qubee')
 or die('Error connecting to database');
 
         $query="SELECT * FROM user ORDER BY user_id DESC";
         $result = mysqli_query($dbc,$query);
         while($row=mysqli_fetch_array($result)) {
        ?>
 
        <tr>
          <td><?php echo $row['username']; ?></td>
          <td><?php echo $row['email']; ?></td>
          <td><?php echo $row['phone']; ?></td>
 
          <td>
 
          <?php
          $id = $row['user_id'];
        $buttonperm=array();
          $sql="SELECT *FROM user_perm WHERE userid='$id'";
          $res=mysqli_query($dbc,$sql);
          while($rows=mysqli_fetch_array($res)){
 
            $per=$rows['permid'];
 
            $sqls="SELECT *FROM permissions WHERE perm_id='$per'";
            $resu=mysqli_query($dbc,$sqls);
 
            while($perm=mysqli_fetch_array($resu)){
 
            array_push($buttonperm,$perm['perm_desc']);
 
            }
 
          }
 
           ?>
            <select name="select" id="perm">
              <option selected="selected"><strong>check permissions</strong></option>
              <?php foreach ($buttonperm as $permission) {
                
               ?>
              <option value=""><?php echo $permission ?></option>
 
              <?php } ?>
            </select>
 
          </td>
          <td><a href="userUpdate.php?id=<?php echo $row['user_id']; ?>">Update</a></td>
          <td><a href="userDelete.php?id=<?php echo $row['user_id']; ?>">Delete</a></td>
        </tr>
 
        <?php } ?>
     </tbody>
   </table>
 </div>
 
 <script>
 function myFunction() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
 }
 </script> 