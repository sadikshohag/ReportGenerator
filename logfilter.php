<?php 	
if (isset($_POST["from_date"],$_POST["to_date"])) {
		$con = mysqli_connect("localhost","root","","qubee");
		$output='';
		$in_Date=$_POST["from_date"];
		$to_date=$_POST["to_date"];
		$query = "SELECT * FROM info where Down_Date>='$in_Date' and Down_Date <='$to_date'";
		$result = mysqli_query($con,$query);

		$output.='<table class="table table-bordered table-hovor">
 
                               <tr>  
                                    <td >Category</td> 
                                    <td >Down Date Time</td>  
                                    <td >Up Date Time</td>  
									<td >Site</td>  
                                    <td >Sector</td>  
                                    <td >Fiber vendor</td>  
                                    <td >Link between</td>  
                                    <td >Information source</td>  
                                    <td >Reason</td>
                                    <td >Detail</td>

                               </tr>   
            		';
		if (mysqli_num_rows ($result)> 0){

		            while ($row=mysqli_fetch_array($result)) {

		                $output.='
		                  <tr>
		                  	<td>'.$row['category'].'</td>
		                    <td>'.$row['Down_Date'].'</td>
		                    <td>'.$row['Down_Time'].'</td>
		                    <td>'.$row['Site'].'</td>
		                    <td>'.$row['sector'].'</td>
		                    <td>'.$row['fiber_Vendor'].'</td>
		                    <td>'.$row['link_Between'].'</td>
		                    <td>'.$row['information_Source'].'</td>
		                    <td>'.$row['reason'].'</td>
		                    <td><a href="display.php?edit='.$row['id'].'">Detail</a></td>
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