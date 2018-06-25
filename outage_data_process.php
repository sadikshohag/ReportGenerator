<?php

function getDBConnection() {
    $con = mysqli_connect("localhost", "root", "", "qubee");


    if (mysqli_connect_errno($con)) {
        echo "Failed to connect to DataBase: " . mysqli_connect_error();
    }
    return $con;
}

function getOutageDataType($fromDate, $toDate) {

    $con = getDBConnection();

    // $result = mysqli_query($con, "SELECT Down_Date,SUM(Duration_of_Outage_Mins)as Res FROM `info` WHERE ReasonCategory='Fiber problem' GROUP BY Down_Date between '".$formDate."' and '".$toDate."'");

    $data_points = array();
    $data_points1 = array();
    $data_points2 = array();
    $data_points3 = array();
    $data_points4 = array();

    /* $result = mysqli_query($con, "SELECT Date, SUM(low_Impact_outage_Mins)as LIOM,sum(High_Impact_outage_Mins) as HIOM,Sum(Very_High_Impact_outage_Mins) as VHIOM,COUNT(Site) as user FROM weekly_reports group by Date"); */
    $result = mysqli_query($con, "SELECT SUM(Duration_of_Outage_Mins)as Res FROM `info` WHERE reason='Power problem' AND Down_Date between '" . $fromDate . "' and '" . $toDate . "'");
    $duration = 0;
    while ($row = mysqli_fetch_array($result)) {

        $duration = $duration + $row['Res'];

        // $point = array("label" => $row['Down_Date'], "y" => $row['Res']);

        // array_push($data_points1, $point);
    }



     $point = array("label" => $fromDate. " To ".$toDate, "y" => $duration);
     array_push($data_points1, $point);


    $result1 = mysqli_query($con, "SELECT SUM(Duration_of_Outage_Mins)as Res FROM `info` WHERE reason='Battery problem' AND Down_Date between '" . $fromDate . "' and '" . $toDate . "'");
    $duration = 0;
    while ($row = mysqli_fetch_array($result1)) {
        $duration = $duration + $row['Res'];
        // $point = array("label" => $row['Down_Date'], "y" => $row['Res']);

        // array_push($data_points2, $point);
    }
      $point = array("label" => $fromDate. " To ".$toDate, "y" => $duration);
     array_push($data_points2, $point);


    $result2 = mysqli_query($con, "SELECT SUM(Duration_of_Outage_Mins)as Res FROM `info` WHERE reason='Fiber problem' AND Down_Date between '" . $fromDate . "' and '" . $toDate . "'");
    $duration = 0;
    while ($row = mysqli_fetch_array($result2)) {
        $duration = $duration + $row['Res'];
        // $point = array("label" => $row['Down_Date'], "y" => $row['Res']);

        // array_push($data_points3, $point);
    }
    $point = array("label" => $fromDate. " To ".$toDate, "y" => $duration);
     array_push($data_points3, $point);

    $result3 = mysqli_query($con, "SELECT SUM(Duration_of_Outage_Mins)as Res FROM `info` WHERE reason='Equipment problem' AND Down_Date between '" . $fromDate . "' and '" . $toDate . "'");
    $duration = 0;
    while ($row = mysqli_fetch_array($result3)) {
        $duration = $duration + $row['Res'];
        // $point = array("label" => $row['Down_Date'], "y" => $row['Res']);

        // array_push($data_points4, $point);
    }
    $point = array("label" => $fromDate. " To ".$toDate, "y" => $duration);
     array_push($data_points4, $point);

    array_push($data_points, $data_points1);
    array_push($data_points, $data_points2);
    array_push($data_points, $data_points3);
    array_push($data_points, $data_points4);
    // echo "<pre>";
    // print_r($data_points);
    // die();

    return $data_points;
}
