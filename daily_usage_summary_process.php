<?php

function getDBConnection() {
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $dbname = "qubee";
    $connection = mysqli_connect($hostname, $username, $password, $dbname) or die("Failed to connect database.");
    return $connection;
}

function getSpeedList($packageType) {
    $speedList = array();
    $connection = getDBConnection();
    $query = "SELECT speed FROM speed_report WHERE package_type = '$packageType'";
    $result = mysqli_query($connection, $query);
    if (!mysqli_error($connection)) {
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($speedList, $row['speed']);
        }
    } else {
        echo 'Error occured in query execution: ' . mysqli_error($connection);
    }
    mysqli_close($connection);
    return $speedList;
}

function getSumOfUsage($result) {
    $totalUser = 0;
    $totalUsage = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $totalUser = $totalUser + $row['user'];
        $totalUsage = $totalUsage + $row['total'];
    }
    return array($totalUser, $totalUsage);
}

function getPostpaidUsageDetails() {
    $postpaidUsageData = array();
    $connection = getDBConnection();
    $postPaidSpeedList = getSpeedList('postpaid');
    foreach ($postPaidSpeedList as $postPaidSpeed) {

        $query = "SELECT `PLANNAME`,COUNT(`USERID`) as user, SUM(`usage_in_mb`)/1024 as total "
                . "FROM `detail_report` GROUP BY PLANNAME "
                . "HAVING PLANNAME like '01st_$postPaidSpeed%' "
                . "OR PLANNAME LIKE '05th_$postPaidSpeed%' "
                . "OR PLANNAME LIKE '15th_$postPaidSpeed%'";

        $result = mysqli_query($connection, $query);

        if (!mysqli_error($connection)) {
            $data = getSumOfUsage($result);
            array_unshift($data, $postPaidSpeed);
            array_push($postpaidUsageData, $data);
        } else {
            echo 'Error occured in query execution: ' . mysqli_error($connection);
        }
    }
    mysqli_close($connection);
    return $postpaidUsageData;
}

function getPrepaidUsageDetails() {
    $prepaidUsageData = array();
    $connection = getDBConnection();
    $prepaidSpeedList = getSpeedList('prepaid');
    foreach ($prepaidSpeedList as $prepaidSpeed) {

        $query = "SELECT `PLANNAME`,COUNT(`USERID`) as user, SUM(`usage_in_mb`)/1024 as total "
                . "FROM `detail_report` GROUP BY PLANNAME "
                . "HAVING PLANNAME like '$prepaidSpeed%'";

        $result = mysqli_query($connection, $query);

        if (!mysqli_error($connection)) {
            $data = getSumOfUsage($result);
            array_unshift($data, $prepaidSpeed);
            array_push($prepaidUsageData, $data);
        } else {
            echo 'Error occured in query execution: ' . mysqli_error($connection);
        }
    }
    mysqli_close($connection);
    return $prepaidUsageData;
}

function getOtherUsageDetails() {
    $otherUsageData = array();
    $connection = getDBConnection();
    $otherSpeedList = getSpeedList('other');
    foreach ($otherSpeedList as $otherSpeed) {

        $query = "SELECT `PLANNAME`,COUNT(`USERID`) as user, SUM(`usage_in_mb`)/1024 as total "
                . "FROM `detail_report` GROUP BY PLANNAME "
                . "HAVING PLANNAME like '$otherSpeed%'";

        $result = mysqli_query($connection, $query);

        if (!mysqli_error($connection)) {
            $data = getSumOfUsage($result);
            array_unshift($data, $otherSpeed);
            array_push($otherUsageData, $data);
        } else {
            echo 'Error occured in query execution: ' . mysqli_error($connection);
        }
    }
    mysqli_close($connection);
    return $otherUsageData;
}

function getDailyUsagePattern() {
    $usagePatternData = array();

    $postpaidData = getPostpaidUsageDetails();
    foreach ($postpaidData as $data) {
        array_push($usagePatternData, $data);
    }

    $prepaidData = getPrepaidUsageDetails();
    foreach ($prepaidData as $data) {
        array_push($usagePatternData, $data);
    }

    $otherData = getOtherUsageDetails();
    foreach ($otherData as $data) {
        array_push($usagePatternData, $data);
    }

    return $usagePatternData;
}

function getSummaryData($detailData) {
    $totalUser = 0;
    $totalUsage = 0;
    foreach ($detailData as $data) {
        $totalUser = $totalUser + $data[1];
        $totalUsage = $totalUsage + $data[2];
    }
    $totalUsage = ($totalUsage/1024);
    $avgUsage = ($totalUsage * 1024) / $totalUser;
    return array($totalUser, $totalUsage, $avgUsage);
}
