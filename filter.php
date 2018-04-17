<?php 	
if (isset($_POST["down_date"])) {
		$con = mysqli_connect("localhost","root","","test");
		$output='';
		$in_Date=$_POST["down_date"];
		$query = "SELECT * FROM info where Down_Date<='$in_Date' and Up_Date >='$in_Date'";
		$result = mysqli_query($con,$query);

		$output.='<table class="table table-bordered table-hovor">
				
		                <tr class="alert-success">
		                  <th>SL</th>
		                  <th>Site</th>
		                  <th>Down Date</th>
		                  <th>Down Time</th>
		                  <th>Up Date</th>
		                  <th>Up Time</th>
		                  <th>Total Down Time (Minutes)</th>
		                  <th>Planned/Unplanned</th>
		                  <th>Reason</th>
		                </tr>
            		';
		if (mysqli_num_rows ($result)> 0){
		        $serial=0;
		            while ($row=mysqli_fetch_array($result)) {
		                
		                $serial++;  
		                $output.='
		                  <tr>
		                  	<td>'.$serial.'</td>
		                    <td>'.$row['Site'].'</td>
		                    <td>'.$row['Down_Date'].'</td>
		                    <td>'.$row['Down_Time'].'</td>
		                    <td>'.$row['Up_Date'].'</td>
		                    <td>'.$row['Up_Time'].'</td>
		                    <td>'.$row['Duration_of_Outage_Mins'].'</td>
		                    <td>Planned</td>
		                    <td>'.$row['ReasonCategory'].'</td>
		                  </tr>';
		              }
		            }
		            else
		            {
						$output .= '  
						<tr>  
							<td colspan="5">No Order Found</td>  
						</tr>  
						';  
		             } 
				      $output .= '</table>';  
				      echo $output; 

}


?>