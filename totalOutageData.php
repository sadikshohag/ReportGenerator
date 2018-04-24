<?php

header('Content-Type: application/json');

$con = mysqli_connect("localhost", "root", "", "test");


// Check connection
if (isset($_POST['submit']))
{
    // 
    $toDate=$_POST['toDate'];
    $formDate=$_POST['fromDate'];
    $data_points = array();
    $data_points1 = array();
    $data_points2 = array();
    $data_points3 = array();
    $data_points4 = array();
    
    /*$result = mysqli_query($con, "SELECT Date, SUM(low_Impact_outage_Mins)as LIOM,sum(High_Impact_outage_Mins) as HIOM,Sum(Very_High_Impact_outage_Mins) as VHIOM,COUNT(Site) as user FROM weekly_reports group by Date");*/
    $result = mysqli_query($con, "SELECT Down_Date,SUM(Duration_of_Outage_Mins)as Res FROM `info` WHERE ReasonCategory='Fiber problem' GROUP BY Down_Date having Down_Date between '".$toDate."' and '".$formDate."'");
    
    while($row = mysqli_fetch_array($result))
    {        
        $point = array("label" => $row['Down_Date'] , "y" => $row['Res']);
        
        array_push($data_points1, $point);        
    }
    $result1 = mysqli_query($con, "SELECT Down_Date,SUM(Duration_of_Outage_Mins)as Res FROM `info` WHERE ReasonCategory='Battery problem' GROUP BY Down_Date having Down_Date between '".$toDate."' and '".$formDate."'");
        while($row = mysqli_fetch_array($result1))
    {        
        $point = array("label" => $row['Down_Date'] , "y" => $row['Res']);
        
        array_push($data_points2, $point);        
    }

    $result2 = mysqli_query($con, "SELECT Down_Date,SUM(Duration_of_Outage_Mins)as Res FROM `info` WHERE ReasonCategory='Access Problem'  GROUP BY Down_Date having Down_Date between '".$toDate."' and '".$formDate."'");
    while($row = mysqli_fetch_array($result2))
    {        
        $point = array("label" => $row['Down_Date'] , "y" => $row['Res']);
        
        array_push($data_points3, $point);        
    }
    $result3 = mysqli_query($con, "SELECT Down_Date,SUM(Duration_of_Outage_Mins)as Res FROM `info` WHERE ReasonCategory='Flapped' GROUP BY Down_Date having Down_Date between '".$toDate."' and '".$formDate."'");
    while($row = mysqli_fetch_array($result3))
    {        
        $point = array("label" => $row['Down_Date'] , "y" => $row['Res']);
        
        array_push($data_points4, $point);        
    }
    array_push($data_points,$data_points1);
    array_push($data_points,$data_points2);
    array_push($data_points,$data_points3);
    array_push($data_points,$data_points4);
    echo json_encode($data_points, JSON_NUMERIC_CHECK);
header('location: userImpact.php');
}else
{
    $dt = new DateTime("now", new DateTimeZone('Asia/Dhaka'));
    $toDate = $dt->format('Y-m-d');

    $dt->modify('-7 day');
    $formDate=$dt->format('Y-m-d');
    $data_points = array();
    $data_points1 = array();
    $data_points2 = array();
    $data_points3 = array();
    $data_points4 = array();
    
    /*$result = mysqli_query($con, "SELECT Date, SUM(low_Impact_outage_Mins)as LIOM,sum(High_Impact_outage_Mins) as HIOM,Sum(Very_High_Impact_outage_Mins) as VHIOM,COUNT(Site) as user FROM weekly_reports group by Date");*/
    $result = mysqli_query($con, "SELECT Down_Date,SUM(Duration_of_Outage_Mins)as Res FROM `info` WHERE ReasonCategory='Fiber problem' GROUP BY Down_Date having Down_Date between '".$formDate."' and '".$toDate."'");
    
    while($row = mysqli_fetch_array($result))
    {        
        $point = array("label" => $row['Down_Date'] , "y" => $row['Res']);
        
        array_push($data_points1, $point);        
    }
    $result1 = mysqli_query($con, "SELECT Down_Date,SUM(Duration_of_Outage_Mins)as Res FROM `info` WHERE ReasonCategory='Battery problem' GROUP BY Down_Date having Down_Date between '".$formDate."' and '".$toDate."'");
        while($row = mysqli_fetch_array($result1))
    {        
        $point = array("label" => $row['Down_Date'] , "y" => $row['Res']);
        
        array_push($data_points2, $point);        
    }

    $result2 = mysqli_query($con, "SELECT Down_Date,SUM(Duration_of_Outage_Mins)as Res FROM `info` WHERE ReasonCategory='Access Problem'  GROUP BY Down_Date having Down_Date between '".$formDate."' and '".$toDate."'");
    while($row = mysqli_fetch_array($result2))
    {        
        $point = array("label" => $row['Down_Date'] , "y" => $row['Res']);
        
        array_push($data_points3, $point);        
    }
    $result3 = mysqli_query($con, "SELECT Down_Date,SUM(Duration_of_Outage_Mins)as Res FROM `info` WHERE ReasonCategory='Flapped' GROUP BY Down_Date having Down_Date between '".$formDate."' and '".$toDate."'");
    while($row = mysqli_fetch_array($result3))
    {        
        $point = array("label" => $row['Down_Date'] , "y" => $row['Res']);
        
        array_push($data_points4, $point);        
    }
    array_push($data_points,$data_points1);
    array_push($data_points,$data_points2);
    array_push($data_points,$data_points3);
    array_push($data_points,$data_points4);
    echo json_encode($data_points, JSON_NUMERIC_CHECK);
}
mysqli_close($con);

?>
