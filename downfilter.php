<?php 	
if (isset($_POST["from_date"],$_POST["to_date"])) {
		$con = mysqli_connect("localhost","root","","qubee");
		$output='';
		$in_Date=$_POST["from_date"];
		$to_date=$_POST["to_date"];
		$query = "SELECT * FROM info where Down_Date>='$in_Date' and Down_Date <='$to_date' and Up_Date='0000-00-00'";
		$result = mysqli_query($con,$query);

		$output.='<table class="table table-bordered table-hovor">
				
		                <tr class="alert-success">
		                  <th>SL</th>
		                  <th>Site</th>
		                  <th>Down Date</th>
		                  <th>Down Time</th>
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
		                    <td>'.$row['outage_type'].'</td>
		                    <td>'.$row['reason'].'</td>
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