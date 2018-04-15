<?php
 $category = "";
 $down_Date_Time="";
 $up_Date_Time="";
 $site = "";
 $sector = "";
 $fiber_Vendor = "";
 $link_Between = "";
 $information_Source = "";
 $reason = "";
 $specific_reason = "";
 $inform_time ="";
 $inform_type = "";
 $informed_Vendor = "";
 $incident_Time ="";
 $informOfType ="";
 $informed_Person = "";
 $inform_TimeonResolve = "";
 $Type_Of_inform = "";
 $informedToPerson = "";
 $noc_DutyEngineer = "";
 $last_ModifiedBy = "";
 $last_ModifiedDT = "";
 $comment = "";
 $id = 0;


$conn = mysqli_connect('localhost','root','','qubee');

//update
if(isset($_POST['update'])){
	
 $category = $_POST['category'];
 $down_Date_Time = $_POST['down_Date_Time'];
 $up_Date_Time = $_POST['up_Date_Time'];
 $site = $_POST['site'];
 $sector = $_POST['sector'];
 $fiber_Vendor = $_POST['fiber_Vendor'];
 $link_Between = $_POST['link_Between'];
 $information_Source = $_POST['information_Source'];
 $reason = $_POST['reason'];
 $specific_reason = $_POST['specific_reason'];
 $inform_time = $_POST['inform_time'];
 $inform_type = $_POST['inform_type'];
 $informed_Vendor = $_POST['informed_Vendor'];
 $incident_Time = $_POST['incident_Time'];
 $informOfType = $_POST['informOfType'];
 $informed_Person = $_POST['informed_Person'];
 $inform_TimeonResolve = $_POST['inform_TimeonResolve'];
 $Type_Of_inform = $_POST['Type_Of_inform'];
 $informedToPerson = $_POST['informedToPerson'];
 $noc_DutyEngineer = $_POST['noc_DutyEngineer'];
 $last_ModifiedBy = $_POST['last_ModifiedBy'];
 $last_ModifiedDT = $_POST['last_ModifiedDT'];
 $comment =$_POST['comment'];
 $id = $_POST['id'];
 

 $query = "UPDATE info SET category='$category',down_Date_Time='$down_Date_Time',up_Date_Time='$up_Date_Time',site='$site',sector='$sector',fiber_Vendor='$fiber_Vendor',link_Between='$link_Between',
 information_Source='$information_Source',reason='$reason',specific_reason='$specific_reason',inform_time='$inform_time',inform_type='$inform_type',informed_Vendor='$informed_Vendor',
 incident_Time='$incident_Time',inform_type='$inform_type',informed_Vendor='$informed_Vendor',incident_Time='$incident_Time',informOfType='$informOfType',
 informed_Person='informed_Person',inform_TimeonResolve='$inform_TimeonResolve',Type_Of_inform='$Type_Of_inform',informedToPerson='$informedToPerson',
 noc_DutyEngineer='$noc_DutyEngineer',last_ModifiedBy='$last_ModifiedBy',last_ModifiedDT='$last_ModifiedDT',comment='$comment' WHERE id=$id";

 
 
 mysqli_query($conn,$query);
 header('location:down.php');

}

//delete
if(isset($_GET['del'])){
	$id = $_GET['del'];
	mysqli_query($conn,"DELETE FROM info WHERE id = $id");
	header('location:delete.php');
}

$result = mysqli_query($conn,"select * from info"); 
?>