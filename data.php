<?php

header('Content-Type: application/json');

// $con = mysqli_connect("localhost", "root", "", "qubee");



//     // echo "<pre>";
//     // print_r($data_points);
//     // die();


// // Check connection
// if (mysqli_connect_errno($con))
// {
//     echo "Failed to connect to DataBase: " . mysqli_connect_error();
// }else
// {
//     $data_points = array();
//     $data_points1 = array();
//     $data_points2 = array();
//     $data_points3 = array();
//     $data_points4 = array();
    
//     /*$result = mysqli_query($con, "SELECT Date, SUM(low_Impact_outage_Mins)as LIOM,sum(High_Impact_outage_Mins) as HIOM,Sum(Very_High_Impact_outage_Mins) as VHIOM,COUNT(Site) as user FROM weekly_reports group by Date");*/
//     $result = mysqli_query($con, "SELECT Down_Date, SUM(Duration_of_Outage_Mins)as LIOM FROM info where Down_Time between '$from_peak_time' and '$to_peak_time' group by Down_Date");
    
//     while($row = mysqli_fetch_array($result))
//     {        
//         $point = array("label" => $row['Down_Date'] , "y" => $row['LIOM']);
        
//         array_push($data_points1, $point);        
//     }
//     $result1 = mysqli_query($con, "SELECT Down_Date, SUM(Duration_of_Outage_Mins)as HIOM FROM info where Down_Time between '$from_busy_time' and '$to_busy_time' group by Down_Date");
//         while($row = mysqli_fetch_array($result1))
//     {        
//         $point = array("label" => $row['Down_Date'] , "y" => $row['HIOM']);
        
//         array_push($data_points2, $point);        
//     }
//     $result2 = mysqli_query($con, "SELECT Down_Date, SUM(Duration_of_Outage_Mins)as VHIOM FROM info where Down_Time between '$from_very_busy_time' and '$to_very_busy_time' group by Down_Date");
//     while($row = mysqli_fetch_array($result2))
//     {        
//         $point = array("label" => $row['Down_Date'] , "y" => $row['VHIOM']);
        
//         array_push($data_points3, $point);        
//     }
//     $result3 = mysqli_query($con, "SELECT Date, COUNT(Site) as user FROM weekly_reports group by Date");
//     while($row = mysqli_fetch_array($result3))
//     {        
//         $point = array("label" => $row['Date'] , "y" => $row['user']);
        
//         array_push($data_points4, $point);        
//     }
//     array_push($data_points,$data_points1);
//     array_push($data_points,$data_points2);
//     array_push($data_points,$data_points3);
//     array_push($data_points,$data_points4);
//     // echo "<pre>";
//     // print_r($data_points);
//     // die();
//     echo json_encode($data_points, JSON_NUMERIC_CHECK);
// }
// mysqli_close($con);


function getDBConnection() {
    $con = mysqli_connect("localhost", "root", "", "qubee");


    if (mysqli_connect_errno($con)) {
        echo "Failed to connect to DataBase: " . mysqli_connect_error();
    }
    return $con;
}

function getOutageDataType($fromDate, $toDate) {

    $con = getDBConnection();

    $dataSet = array();
    $all_data = mysqli_query($con, "SELECT Site,Down_Date,Down_Time,Up_Date,Up_Time  FROM info where Down_Date >='$fromDate' or Up_Date <='$toDate'");

    while ($row = mysqli_fetch_assoc($all_data)) {

        array_push($dataSet, [
            'bts_id' => $row['Site'],
            'down_date' => $row['Down_Date'],
            'down_time' => $row['Down_Time'],
            'up_date' => $row['Up_Date'],
            'up_time' => $row['Up_Time']
        ]);
    }


    $finalData = array();

    array_push($finalData, getPeakTimeData($fromDate, $toDate, $dataSet));
    array_push($finalData, getBusyTimeData($fromDate, $toDate, $dataSet));
    array_push($finalData, getVeryBusyTimeData($fromDate, $toDate, $dataSet));
    array_push($finalData, getBtsData($fromDate, $toDate, $dataSet));

    echo json_encode($finalData, JSON_NUMERIC_CHECK);
}

function getPeakTimeData($fromDate, $toDate, $dataSet) {
    $peakTimeData = array();
    $dateCounter = $fromDate;

    while (strtotime($dateCounter) <= strtotime($toDate)) {
        array_push($peakTimeData, [
            "label" => $dateCounter,
            "y" => getPeakTimePerDay($dataSet, $dateCounter)]
        );
        $date = strtotime("+1 day", strtotime($dateCounter));
        $dateCounter = date("Y-m-d", $date);
    }

    return $peakTimeData;
}

function getPeakTimePerDay($dataSet, $date) {
    $peakMinuteOfADay = 0;
    foreach ($dataSet as $data) {
        if (( ($data['up_date'] == "0000-00-00") ||
                (strtotime($data['up_date']) > strtotime($date)) ||
                ((strtotime($data['up_date']) == strtotime($date)) && (strtotime($data['up_time']) >= strtotime("07:59:59")))
                ) && (
                (strtotime($data['down_date']) < strtotime($date)) ||
                ((strtotime($data['down_date']) == strtotime($date)) && (strtotime($data['down_time']) <= strtotime("01:00:00")))
                )) {
            $peakMinuteOfADay = $peakMinuteOfADay + 420;
        } elseif (((strtotime($data['down_date']) == strtotime($date)) && (strtotime($data['down_time']) <= strtotime("01:00:00"))) &&
                ((strtotime($data['up_date']) == strtotime($date)) && (strtotime($data['up_time']) < strtotime("07:59:59")))
        ) {
            $peakMinuteOfADay = $peakMinuteOfADay + getTimeDifferenceInMinute("01:00:00", $data['up_time']);
        } elseif (((strtotime($data['down_date']) == strtotime($date)) && (strtotime($data['down_time']) > strtotime("01:00:00"))) &&
                (((strtotime($data['up_date']) == strtotime($date)) && (strtotime($data['up_time']) >= strtotime("07:59:59"))) || ($data['up_date'] == "0000-00-00") )
        ) {
            $peakMinuteOfADay = $peakMinuteOfADay + getTimeDifferenceInMinute($data['down_time'], "07:59:59");
        } elseif (((strtotime($data['down_date']) == strtotime($date)) && (strtotime($data['down_time']) > strtotime("01:00:00"))) &&
                ((strtotime($data['up_date']) == strtotime($date)) && (strtotime($data['up_time']) < strtotime("07:59:59")))
        ) {
            $peakMinuteOfADay = $peakMinuteOfADay + getTimeDifferenceInMinute($data['down_time'], $data['up_time']);
        }
    }
    return $peakMinuteOfADay;
}

function getBusyTimeData($fromDate, $toDate, $dataSet) {
    $busyTimeData = array();
    $dateCounter = $fromDate;

    while (strtotime($dateCounter) <= strtotime($toDate)) {
        array_push($busyTimeData, [
            "label" => $dateCounter,
            "y" => getBusyTimePerDay($dataSet, $dateCounter)]
        );
        $date = strtotime("+1 day", strtotime($dateCounter));
        $dateCounter = date("Y-m-d", $date);
    }
    return $busyTimeData;
}

function getBusyTimePerDay($dataSet, $date) {
    $busyMinuteOfADay = 0;
    foreach ($dataSet as $data) {
        if (( ($data['up_date'] == "0000-00-00") ||
                (strtotime($data['up_date']) > strtotime($date)) ||
                ((strtotime($data['up_date']) == strtotime($date)) && (strtotime($data['up_time']) >= strtotime("19:59:59")))
                ) && (
                (strtotime($data['down_date']) < strtotime($date)) ||
                ((strtotime($data['down_date']) == strtotime($date)) && (strtotime($data['down_time']) <= strtotime("08:00:00")))
                )) {
            $busyMinuteOfADay = $busyMinuteOfADay + 720;
        } elseif (((strtotime($data['down_date']) == strtotime($date)) && (strtotime($data['down_time']) <= strtotime("08:00:00"))) &&
                ((strtotime($data['up_date']) == strtotime($date)) && (strtotime($data['up_time']) < strtotime("19:59:59")))
        ) {
            $busyMinuteOfADay = $busyMinuteOfADay + getTimeDifferenceInMinute("08:00:00", $data['up_time']);
        } elseif (((strtotime($data['down_date']) == strtotime($date)) && (strtotime($data['down_time']) > strtotime("08:00:00"))) &&
                (((strtotime($data['up_date']) == strtotime($date)) && (strtotime($data['up_time']) >= strtotime("19:59:59"))) || ($data['up_date'] == "0000-00-00") )
        ) {
            $busyMinuteOfADay = $busyMinuteOfADay + getTimeDifferenceInMinute($data['down_time'], "19:59:59");
        } elseif (((strtotime($data['down_date']) == strtotime($date)) && (strtotime($data['down_time']) > strtotime("08:00:00"))) &&
                ((strtotime($data['up_date']) == strtotime($date)) && (strtotime($data['up_time']) < strtotime("19:59:59")))
        ) {
            $busyMinuteOfADay = $busyMinuteOfADay + getTimeDifferenceInMinute($data['down_time'], $data['up_time']);
        }
    }
    return $busyMinuteOfADay;
}

function getVeryBusyTimeData($fromDate, $toDate, $dataSet) {
    $veryBusyTimeData = array();
    $dateCounter = $fromDate;

    while (strtotime($dateCounter) <= strtotime($toDate)) {
        array_push($veryBusyTimeData, [
            "label" => $dateCounter,
            "y" => getVeryBusyTimePerDay($dataSet, $dateCounter)]
        );
        $date = strtotime("+1 day", strtotime($dateCounter));
        $dateCounter = date("Y-m-d", $date);
    }
    return $veryBusyTimeData;
}

function getVeryBusyTimePerDay($dataSet, $date) {
    $veryBusyMinuteOfADay = getVeryBusyTimeAM($dataSet, $date) + getVeryBusyTimePM($dataSet, $date);
    return $veryBusyMinuteOfADay;
}

function getVeryBusyTimeAM($dataSet, $date) {
    $veryBusyMinuteAM = 0;
    foreach ($dataSet as $data) {
        if (( ($data['up_date'] == "0000-00-00") ||
                (strtotime($data['up_date']) > strtotime($date)) ||
                ((strtotime($data['up_date']) == strtotime($date)) && (strtotime($data['up_time']) >= strtotime("00:59:59")))
                ) &&
                (strtotime($data['down_date']) < strtotime($date))
        ) {
            $veryBusyMinuteAM = $veryBusyMinuteAM + 60;
        } elseif ((strtotime($data['down_date']) < strtotime($date)) &&
                ((strtotime($data['up_date']) == strtotime($date)) && (strtotime($data['up_time']) < strtotime("00:59:59")))
        ) {
            $veryBusyMinuteAM = $veryBusyMinuteAM + getTimeDifferenceInMinute("00:00:00", $data['up_time']);
        } elseif (((strtotime($data['down_date']) == strtotime($date)) && (strtotime($data['down_time']) > strtotime("00:00:00"))) &&
                (((strtotime($data['up_date']) == strtotime($date)) && (strtotime($data['up_time']) >= strtotime("00:59:59"))) || ($data['up_date'] == "0000-00-00") )
        ) {
            $veryBusyMinuteAM = $veryBusyMinuteAM + getTimeDifferenceInMinute($data['down_time'], "00:59:59");
        } elseif (((strtotime($data['down_date']) == strtotime($date)) && (strtotime($data['down_time']) > strtotime("00:00:00"))) &&
                ((strtotime($data['up_date']) == strtotime($date)) && (strtotime($data['up_time']) < strtotime("00:59:59")))
        ) {
            $veryBusyMinuteAM = $veryBusyMinuteAM + getTimeDifferenceInMinute($data['down_time'], $data['up_time']);
        }
    }
    return $veryBusyMinuteAM;
}

function getVeryBusyTimePM($dataSet, $date) {
    $veryBusyMinutePM = 0;
    foreach ($dataSet as $data) {
        if (( ($data['up_date'] == "0000-00-00") ||
                (strtotime($data['up_date']) > strtotime($date))
                ) && (
                (strtotime($data['down_date']) < strtotime($date)) ||
                ((strtotime($data['down_date']) == strtotime($date)) && (strtotime($data['down_time']) <= strtotime("20:00:00")))
                )) {
            $veryBusyMinutePM = $veryBusyMinutePM + 240;
        } elseif (((strtotime($data['down_date']) == strtotime($date)) && (strtotime($data['down_time']) <= strtotime("20:00:00"))) &&
                ((strtotime($data['up_date']) == strtotime($date)) && (strtotime($data['up_time']) < strtotime("23:59:59")))
        ) {
            $veryBusyMinutePM = $veryBusyMinutePM + getTimeDifferenceInMinute("20:00:00", $data['up_time']);
        } elseif (((strtotime($data['down_date']) == strtotime($date)) && (strtotime($data['down_time']) > strtotime("20:00:00"))) &&
                ( (strtotime($data['up_date']) > strtotime($date)) || ($data['up_date'] == "0000-00-00") )
        ) {
            $veryBusyMinutePM = $veryBusyMinutePM + getTimeDifferenceInMinute($data['down_time'], "23:59:59");
        } elseif (((strtotime($data['down_date']) == strtotime($date)) && (strtotime($data['down_time']) > strtotime("20:00:00"))) &&
                ((strtotime($data['up_date']) == strtotime($date)) && (strtotime($data['up_time']) < strtotime("23:59:59")))
        ) {
            $veryBusyMinutePM = $veryBusyMinutePM + getTimeDifferenceInMinute($data['down_time'], $data['up_time']);
        }
    }
    return $veryBusyMinutePM;
}

function getBtsData($fromDate, $toDate, $dataSet) {
    $btsData = array();
    $dateCounter = $fromDate;

    while (strtotime($dateCounter) <= strtotime($toDate)) {
        array_push($btsData, [
            "label" => $dateCounter,
            "y" => getBtsDataPerDay($dataSet, $dateCounter)]
        );
        $date = strtotime("+1 day", strtotime($dateCounter));
        $dateCounter = date("Y-m-d", $date);
    }
    return $btsData;
}

function getBtsDataPerDay($dataSet, $date) {
    $btsCount = 0;
    foreach ($dataSet as $data) {
        if ((strtotime($data['down_date']) <= strtotime($date)) &&
                strtotime($data['up_date']) >= strtotime($date)) {
            $btsCount++;
        }
    }
    return $btsCount;
}

function getTimeDifferenceInMinute($from_time, $to_time) {
    $datetime1 = strtotime($from_time);
    $datetime2 = strtotime($to_time);
    $interval = abs($datetime2 - $datetime1);
    $minutes = round($interval / 60);
    return $minutes;
}

 ?>
