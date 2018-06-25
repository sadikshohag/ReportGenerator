<?php
include 'outage_data_process.php';

$dataSet = array();

if (isset($_POST['submit'])) {
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];
    $dataSet = getOutageDataType($fromDate, $toDate);
} else {
    $dt = new DateTime("now", new DateTimeZone('Asia/Dhaka'));
    $toDate = $dt->format('Y-m-d');

    $dt->modify('-7 day');
    $fromDate = $dt->format('Y-m-d');

    $dataSet = getOutageDataType($fromDate, $toDate);
    
}
//echo '<pre>';
//print_r($dataSet[0]);
//echo '</pre>';
//die;
?>

<!DOCTYPE html>
<html>
    <head>
        <title>User Impacted</title>
    </head>
    <body>
        <?php include 'menu2.php'; ?>
        <br/>
        <div class="container2">

            <div class="collapse navbar-collapse js-navbar-collapse">
                <ul class="list-inline text-center">
                    <li><a href="indexForDailyData.php"><strong>Insert Outage</strong></a></li>
                    <li><a href="outage.php"><strong>Outage Log</strong></a></li>           
                    <li><a href="viewOutage.php"><strong>View Daily Outage</strong> </a></li>
                    <li><a href="outageData.php"><strong>Outage Data</strong></a></li>                      
                    <li><a href="planedOutage.php"><strong>Planned/Unplanned Outage</strong> </a></li>          
                    <!-- <li><a href="outageGraph.php"><strong>Outage Minute Graph</strong> </a></li>            -->
                    <li><a href="userImpact.php"><strong>User Imapct Graph</strong> </a></li>           
                </ul>

            </div><!-- /.nav-collapse -->

        </div>
        <br>
        <div>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" >
                <label>From Date:</label>
                <input type="date" name="fromDate" required >
                <label>To Date:</label>
                <input type="date" name="toDate" required>
                <button class="btn btn-success" name="submit" value="submit">Submit</button>
            </form>
        </div>
        .<br/>
        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
        <button id="exportChart" style="margin-left:auto;margin-right:auto;display:block;margin-bottom:0%" class="btn btn-success">Export Chart</button>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>	
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    </body>
</html>
<script type="text/javascript">

    window.onload = function () {

        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            title: {
                text: "Total Outage"
            },
            axisX: {
                //interval: 1,
                //intervalType: "year",
                valueFormatString: "Y-m-d"
            },
            // axisY: {
            // 	minimum:50,
            // 	maximum:500,
            // },
            toolTip: {
                shared: true
            },
            legend: {
                reversed: true,
                verticalAlign: "center",
                horizontalAlign: "right"
            },
            data:
                    [
                        {
                            type: "stackedColumn100",
                            name: "Power Problem", 
                            indexLabel: "{y}",
                            showInLegend: true,
                            dataPoints: [
<?php
foreach ($dataSet[0] as $data) {
    echo '{ y :' . $data['y'] . ', label: "' . $data['label'] . '"},';
}
?>
                            ]

                        },
                        {
                            type: "stackedColumn100",
                            name: "Battery problem",
                            indexLabel: "{y}",
                            showInLegend: true,
                            dataPoints: [
<?php
foreach ($dataSet[1] as $data) {
    echo '{ y :' . $data['y'] . ', label: "' . $data['label'] . '"},';
}
?>
                            ]

                        },
                        {
                            type: "stackedColumn100",
                            name: "Fiber Problem",
                            indexLabel: "{y}",
                            showInLegend: true,
                            dataPoints: [
<?php
foreach ($dataSet[2] as $data) {
    echo '{ y :' . $data['y'] . ', label: "' . $data['label'] . '"},';
}
?>
                            ]

                        },
                        {
                            type: "stackedColumn100",
                            name: "Equipment problem",
                            indexLabel: "{y}",
                            showInLegend: true,
                            dataPoints: [
<?php
foreach ($dataSet[3] as $data) {
    echo '{ y :' . $data['y'] . ', label: "' . $data['label'] . '"},';
}
?>
                            ]

                        }
                    ]
        });

        chart.render();
        document.getElementById("exportChart").addEventListener("click", function () {
            chart.exportChart({format: "jpg"});
        });
    }
</script>