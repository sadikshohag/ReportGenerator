<?php

function getDBConnection() {
    $con = mysqli_connect("localhost", "root", "", "qubee");


    if (mysqli_connect_errno($con)) {
        echo "Failed to connect to DataBase: " . mysqli_connect_error();
    }
    return $con;
}

function getMiscDataType($fromDate, $toDate) {

    $con = getDBConnection();
    // var_dump($fromDate);var_dump($toDate);die();
    $data_points = array();
    $result = mysqli_query($con, "SELECT `id`, date,`package`,`peak_bw`, `avg_bw`, `95%Down`, `available_bw` FROM `misc` where date between '".$fromDate."' and '".$toDate."'");
    while ($row = mysqli_fetch_array($result)) {
        $data_points[]=$row;
    }
    // echo "<pre>";
    // print_r($data_points1);die();


    return $data_points;
}
