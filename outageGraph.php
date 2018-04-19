
<!DOCTYPE html>
<html>
<head>
<title></title>
<script type="text/javascript"> 
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
</script>
</head>
<body>
<?php include 'menu2.php'; ?>
<div class="container2">
  
	<div class="collapse navbar-collapse js-navbar-collapse">
		<ul class="list-inline text-center">
			<li><a href="down.php"><strong>Insert Outage</strong></a></li>			
			<li><a href="viewOutage.php"><strong>View Outage</strong> </a></li>			
			<li><a href="planedOutage.php"><strong>Planned/Unplanned Outage</strong> </a></li>			
			<li><a href="outageGraph.php"><strong>Outage Minute Graph</strong> </a></li>			
			<li><a href="userImpact.php"><strong>User Imapct Graph</strong> </a></li>			
		</ul>
        
	</div><!-- /.nav-collapse -->
	</div>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<br/>
<button id="exportChart" style="margin-left:auto;margin-right:auto;display:block;margin-bottom:0%" class="btn btn-success">Export Chart</button>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</body>
</html>