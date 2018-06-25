<?php 

include 'outageGraphProcess.php';

$dataSet = array();

if (isset($_POST['submit'])) {
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];
    $dataSet = getOutageDataType($fromDate, $toDate);
} else {
    $dt = new DateTime("now", new DateTimeZone('Asia/Dhaka'));
    $toDate = $dt->format('Y-m-d');

    $dt->modify('-6 day');
    $fromDate = $dt->format('Y-m-d');

    $dataSet = getOutageDataType($fromDate, $toDate);
    
}

 ?>



<!DOCTYPE html>
<html>
<head>
<title></title>
<!-- <script type="text/javascript"> 
window.onload = function () {
$.getJSON("data.php", function (result) {
var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  title:{
    text: "Weekly Report"
  },  
  axisY: {
    title: "User No",
    titleFontColor: "#4F81BC",
    lineColor: "#4F81BC",
    labelFontColor: "#4F81BC",
    tickColor: "#4F81BC"
  },
  axisY2: {
    /*title: "Millions of Barrels/day",*/
    titleFontColor: "#C0504E",
    lineColor: "#C0504E",
    labelFontColor: "#C0504E",
    tickColor: "#C0504E"
  },  
  toolTip: {
    shared: true
  },
  legend: {
    cursor:"pointer",
    itemclick: toggleDataSeries
  },
  data: [{
    type: "column",
    name: "User Impacted during Off peak Hour",
    legendText: "User Impacted during Off peak Hour",
    indexLabel:"{y}",
    showInLegend: true, 
    dataPoints:result[0],
  },
  {
    type: "column", 
    name: "User Impacted during Busy Hour",
    legendText: "User Impacted during Busy Hour",
    axisYType: "secondary",
    indexLabel:"{y}",
    showInLegend: true,
    dataPoints: result[1],},
    {
    type: "column", 
    name: "User Impacted during Busy Hour",
    legendText: "User Impacted during Busy Hour",
    axisYType: "secondary",
    indexLabel:"{y}",
    showInLegend: true,
    dataPoints: result[2],
    },
    {
    type: "column", 
    name: "Impacted BTS",
    legendText: "Impacted BTS",
    axisYType: "secondary",
    indexLabel:"{y}",
    showInLegend: true,
    dataPoints: result[3],
/*    type: "column",
    name: "Proven Oil Reserves (bn)",
    legendText: "Proven Oil Reserves",
    showInLegend: true, 
    dataPoints:result[1]*/
  }]
});
chart.render();
document.getElementById("exportChart").addEventListener("click",function(){
      chart.exportChart({format: "jpg"});
    });
function toggleDataSeries(e) {
  if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
    e.dataSeries.visible = false;
  }
  else {
    e.dataSeries.visible = true;
  }
  chart.render();
}
});
}
</script> -->

</head>
<body>
<?php include 'menu2.php'; ?>
<br>
<div class="container2">
  
	<div class="collapse navbar-collapse js-navbar-collapse">
		<ul class="list-inline text-center">
			<li><a href="indexForDailyData.php"><strong>Insert Outage</strong></a></li>			
			<li><a href="viewOutage.php"><strong>View Outage</strong> </a></li>			
			<li><a href="planedOutage.php"><strong>Planned/Unplanned Outage</strong> </a></li>			
			<!-- <li><a href="outageGraph.php"><strong>Outage Minute Graph</strong> </a></li>			 -->
			<li><a href="userImpact.php"><strong>User Imapct Graph</strong> </a></li>			
		</ul>
        
	</div><!-- /.nav-collapse -->
	</div>
<br/>

        <div>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" >
                <label>From Date:</label>
                <input type="date" name="fromDate" value="<?php echo $fromDate;?>" required >
                <label>To Date:</label>
                <input type="date" name="toDate" value="<?php echo $toDate;?>" required>
                <button class="btn btn-success" name="submit" value="submit">Submit</button>
            </form>
        </div>
<br/>
<br/>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<br/>
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
                text: "Weekly Report"
            },
            axisX: {
                //interval: 1,
                //intervalType: "year",
                valueFormatString: "Y-m-d"
            },
            axisY: {
    title: "User No",
    titleFontColor: "#4F81BC",
    lineColor: "#4F81BC",
    labelFontColor: "#4F81BC",
    tickColor: "#4F81BC"
  },
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
                            type: "column",
                            name: "User Impacted during Off peak Hour",
                            legendText: "User Impacted during Off peak Hour",
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
                            type: "column",
                            name: "User Impacted during Busy Hour",
                            legendText: "User Impacted during Busy Hour",
                            axisYType: "secondary",
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
                            type: "column",
                            name: "User Impacted during very Busy Hour",
                            legendText: "User Impacted during very Busy Hour",
                            axisYType: "secondary",
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
                            type: "column",
                            name: "Impacted BTS",
                            legendText: "Impacted BTS",
                            axisYType: "secondary",
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