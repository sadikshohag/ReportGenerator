<?php

header('Content-Type: application/json');

$con = mysqli_connect("localhost", "root", "", "test");

// Check connection
if (mysqli_connect_errno($con))
{
    echo "Failed to connect to DataBase: " . mysqli_connect_error();
}else
{
    $data_points = array();
    $data_points1 = array();
    $data_points2 = array();
    $data_points3 = array();
    $data_points4 = array();
    
    /*$result = mysqli_query($con, "SELECT Date, SUM(low_Impact_outage_Mins)as LIOM,sum(High_Impact_outage_Mins) as HIOM,Sum(Very_High_Impact_outage_Mins) as VHIOM,COUNT(Site) as user FROM weekly_reports group by Date");*/
    $result = mysqli_query($con, "SELECT Date, SUM(low_Impact_outage_Mins)as LIOM FROM weekly_reports group by Date");
    
    while($row = mysqli_fetch_array($result))
    {        
        $point = array("label" => $row['Date'] , "y" => $row['LIOM']);
        
        array_push($data_points1, $point);        
    }
    $result1 = mysqli_query($con, "SELECT Date, sum(High_Impact_outage_Mins) as HIOM FROM weekly_reports group by Date");
        while($row = mysqli_fetch_array($result1))
    {        
        $point = array("label" => $row['Date'] , "y" => $row['HIOM']);
        
        array_push($data_points2, $point);        
    }
    $result2 = mysqli_query($con, "SELECT Date, Sum(Very_High_Impact_outage_Mins) as VHIOM FROM weekly_reports group by Date");
    while($row = mysqli_fetch_array($result2))
    {        
        $point = array("label" => $row['Date'] , "y" => $row['VHIOM']);
        
        array_push($data_points3, $point);        
    }
    $result3 = mysqli_query($con, "SELECT Date, COUNT(Site) as user FROM weekly_reports group by Date");
    while($row = mysqli_fetch_array($result3))
    {        
        $point = array("label" => $row['Date'] , "y" => $row['user']);
        
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
