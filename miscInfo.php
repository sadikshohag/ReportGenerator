<?php 
include 'miscDataProcess.php';

$dataSet = array();

if (isset($_POST['submit'])) {
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];
    $dataSet = getMiscDataType($fromDate, $toDate);
} else {
    $dt = new DateTime("now", new DateTimeZone('Asia/Dhaka'));
    $toDate = $dt->format('Y-m-d');

    $dt->modify('-4 day');
    $fromDate = $dt->format('Y-m-d');

    $dataSet = getMiscDataType($fromDate, $toDate);
    // echo "<pre>";
    // print_r($dataSet);die();
}


 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Top user Dhaka</title>

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css"  href="style.css">
</head>
<body>
<?php include 'menu2.php'; ?>

<br>
	<div class="container2">
  
 
  <div class="collapse navbar-collapse ">
    <ul class="list-inline text-center">
      <li><a href="miscInsert.php"><strong>Misc Insert</strong></a></li>     
      <li><a href="miscInfo.php"><strong>MISC Info</strong> </a></li>  
    </ul>
        
  </div><!-- /.nav-collapse -->
 
</div>
<br>
	<div class="wrapper">
      <div class="page-header text-center">
        <h1>MISC Info</h1>
      </div>

        <div>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" >
                <label>From Date:</label>
                <input type="date" name="fromDate" required="" value="<?php echo $fromDate; ?>">
                <label>To Date:</label>
                <input type="date" name="toDate" required value="<?php echo $toDate; ?>">
                <button class="btn btn-success" name="submit" value="submit">Submit</button>
            </form>
        </div>
        <br>
      <div class="container">
        <div class="table-responsive">
        <table id="mytable" class="table table-bordered table-hover">
            <thead>
                <tr class="alert-success">
                  <th>Date</th>
                  <th>Package</th>
                  <!-- <th>Date</th> -->
                  <th>PEAK BW ( Down)[Mbps]</th>
                  <th>AVG BW ( Down)[Mbps]</th>
                  <th>95 % Down[Mbps]</th>
                  <th>Available BW</th>
                </tr>
            </thead>
            <tbody>
              <?php
                if (!empty($dataSet)) :
                  foreach ($dataSet as $Oneuser) :
                    ?>
                  <tr>
                    <td><?php echo $Oneuser['date']; ?></td>
                    <td><?php echo $Oneuser['package'];?></td>
                    <!-- <td><?php echo $Oneuser['date'];?></td> -->
                    <td><?php echo $Oneuser['peak_bw'];?></td>
                    <td><?php echo $Oneuser['avg_bw'];?></td>
                    <td><?php echo $Oneuser['95%Down'];?></td>
                    <td><?php echo $Oneuser['available_bw'];?></td>
                  </tr>
                    <?php
                   
                  endforeach;
                endif;
              ?>
            </tbody>
        </table>
        </div>
    </div>
   </div>

	
</body>
</html>