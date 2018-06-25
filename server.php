<?php
 $category = "";
 $down_Date_Time="";
 $up_Date_Time="";
 $site = "";
 $sector = "";
 $fiber_Vendor = "";
 $link_Between = "";
 $information_Source = "";
 $outage_type = "";
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
 $edit_state = false;


$conn = mysqli_connect('localhost','root','','qubee');

//save
if(isset($_POST['save'])){
 $category = $_POST['category'];
 $down_Date_Time = $_POST['down_Date_Time'];
 $d_date = $down_Date_Time;
 $d_time = $down_Date_Time;
 if(empty($_POST['up_Date_Time'])){
 	$up_Date_Time=NULL;
 }
 else{
 	$up_Date_Time = $_POST['up_Date_Time'];
 }
 
 $u_date = $up_Date_Time;
 $u_time = $up_Date_Time;
 //var_dump($u_time);die;
$datetime1 = strtotime($down_Date_Time);
$datetime2 = strtotime($up_Date_Time);
if($datetime2!=null)
{
	$interval  = abs($datetime2 - $datetime1);
	$minutes   = round($interval / 60);
}
else
{
	$minutes = NULL;
}

// echo 'Diff. in minutes is: '.$minutes;
// die();
 $site = $_POST['site'];
 $sector = $_POST['sector'];
 $fiber_Vendor = $_POST['fiber_Vendor'];
 $link_Between = $_POST['link_Between'];
 $information_Source = $_POST['information_Source'];
 $outage_type = $_POST['outage_type'];
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
 //
 $last_ModifiedDT =$_POST['last_ModifiedDT'];
 $comment =$_POST['comment'];
	
$query ="INSERT INTO info(category,Down_Date,Down_Time,Up_Date,Up_Time,Duration_of_Outage_Mins,Site,sector,fiber_Vendor,link_Between,information_Source,outage_type,reason,specific_reason,inform_time,inform_type,informed_Vendor,incident_Time,informOfType,informed_Person,inform_TimeonResolve,Type_Of_inform,informedToPerson,noc_DutyEngineer,last_ModifiedBy,last_ModifiedDT,comment)VALUES('$category','$d_date','$d_time','$u_date','$u_time',
'$minutes','$site','$sector','$fiber_Vendor','$link_Between','$information_Source','$outage_type','$reason','$specific_reason','$inform_time','$inform_type','$informed_Vendor','$incident_Time', '$informOfType','$informed_Person','$inform_TimeonResolve','$Type_Of_inform','$informedToPerson','$noc_DutyEngineer','$last_ModifiedBy','$last_ModifiedDT','$comment')";
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