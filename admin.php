						<!--	Assignment1, Admin Page, StudentID - 4949773, Name - Ronak Shah	 -->
					   <!--Main function of this page is to help the admin to perform few functions-->
												<!--Head of Admin page-->
<! DOCTYPE html>
	<html lang = en>
		<head>
		
			<meta charset = "utf-8"/>
			<meta name = "description"		content = "Admin Page of CabsOnline"/>
			<meta name = "author"			content = "Ronak Shah"/>
			<title>CabsOnline</title>
		
		</head>
		
		<body>
		
			<h1> Admin page of CabsOnline </h1>
					
						<!--Form to list all customer who have booked cab and about to travel in 2 hours time.-->
					
					<form id = "submit" method = "post" >
				
				<p><strong>1. Click below button to search for all unassigned booking requests with a pick-up time within 2 hours</strong></p>
					
					<p><input type = "submit" value = "List All" name = "list"/></p>
					
					<?PHP
					
					// Execute only if List all is clicked.
					
					if(isset($_POST['list'])){
						
						// Store the default time zone in a variable later on to compare.
						
						date_default_timezone_set('Australia/Melbourne');    
						$add = strtotime("+2 hours");
						$real_time = date("H:i");
						$modified_time = date("H:i", $add);
						$date = date("Y-m-d");
						
						// Connect to the database.
						
						include_once ("connect.php");
											
												$db_connection = @mysqli_connect($host, $user, $pwd, $db);
					
													// Check whether the database connection exist.
					
														if(!$db_connection)
														{
														echo "<p>Unable to connect to database</p>";
														}
														else{				
														
																// An complex select statement with the inner-join. 
																
																$select_query = "SELECT * from BOOKING
																				INNER JOIN CUSTOMER
																				ON Cust_email = Pass_book_email
																				WHERE (Pass_pick_up_date = '$date') 
																				AND ((Pass_pick_up_time < '$modified_time') 
																				AND (Pass_pick_up_time > '$real_time'))";
																
																// To check whether its execute or not and to check for errors.
																
																$query_result = @mysqli_query($db_connection, $select_query)
																or die("<p>Unable to execute the query.</p>"
																. "<p>Error code " . mysqli_errno($db_connection)
																. ": " . mysqli_error($db_connection) . "</p>");
																//echo "<p>Successfully executed the query.</p>";
																$numRows = mysqli_num_rows($query_result);
																
																// Create the table to store the value.
																
																if ($numRows != 0 ) {
																	
																	echo "<table border=\"1\">"; 
																	echo "<tr>" 
																 ."<th scope=\"col\">reference #</th>"
																 ."<th scope=\"col\">customer name</th>" 
																 ."<th scope=\"col\">passenger name</th>" 
																 ."<th scope=\"col\">Passenger contact phone</th>" 
																 ."<th scope=\"col\">pick-up address</th>" 
																 ."<th scope=\"col\">destination suburb</th>" 
																 ."<th scope=\"col\">pick-time</th>"  
																 ."</tr>";
																 
																// retrieve current record pointed by the result pointer 
												 
														 while ($row = mysqli_fetch_assoc($query_result)){ 
															 echo "<tr>"; 
															 echo "<td>",$row["Pass_book_num"],"</td>";
															 echo "<td>",$row["Cust_name"],"</td>"; 
															 echo "<td>",$row["Pass_name"],"</td>"; 
															 echo "<td>",$row["Pass_phoneno"],"</td>"; 
															 echo "<td>",$row["Pass_unit_no"],"/", $row["Pass_street_no"], " ", $row["Pass_street_name"], ", ", $row["Pass_suburb"],"</td>"; 
															 echo "<td>",$row["Pass_dest_suburb"],"</td>"; 
															 echo "<td>",$row["Pass_pick_up_date"]," ",$row["Pass_pick_up_time"],"</td>"; 
															  
															 echo "</tr>"; 
															}
															echo "</table>";
																
															}
																else {
																echo "<p>Your query returned no results.</p>";
																}
														}
																mysqli_close($db_connection);
															
					}
						?>
						
						</form >
						
							<!--Form to assign cab to the customer-->
						
						<p> <strong>2. Input a reference number below and click "update" button to assign a taxi to that request</strong></p>
						
						<form id = "submit" method = "post" >
						
						<p><label for = "ref">Reference Number:</label>
							<input type = "text" id = "ref" name = "ref_no"/>
							
						<input type = "submit" value = "Update" name = "update"/></p>
						
						<?PHP
								// Execute only if Update is clicked.
								
								if(isset($_POST['update'])){
									
									// Store the value in variable
									
									$reference_no = trim($_POST["ref_no"]);
									
									//Connect to the database.
									
									include_once ("connect.php");
											
												$db_connection = @mysqli_connect($host, $user, $pwd, $db);
					
													// Check whether the database connection exist.
					
														if(!$db_connection)
														{
														echo "<p>Unable to connect to database</p>";
														}
														else{
													
													//Select the Value equal to the reference number.
													
															$select_query2 = "SELECT * from BOOKING
																			  WHERE Pass_book_num = '$reference_no'";
																			
																$query_result2 = @mysqli_query($db_connection, $select_query2)
																or die("<p>Unable to execute the query.</p>"
																. "<p>Error code " . mysqli_errno($db_connection)
																. ": " . mysqli_error($db_connection) . "</p>");
																
																$numRows2 = mysqli_num_rows($query_result2);
																
																if($numRows2 != 0)
																{
																	
																// Update the Status if the booking number is valid
																	
															$update_query = ("UPDATE BOOKING
																			SET Status = 'assigned'
																			WHERE Pass_book_num = '$reference_no'");
																			
																
																$result_query = mysqli_query($db_connection, $update_query);
																
																$rows4 = mysqli_affected_rows($db_connection);
																
																// Check whether Taxi is already assigned or not, show appropriate message. 
																
																if($rows4 == 1){
																
																	echo "<p>The Booking request $reference_no has been properly assigned.</p>";		
																}
																else{
																	
																	echo "<p> Taxi is already assigned to $reference_no .</p>";
																	
																}
														}
														else{
															
															echo "<p>The Booking reference number $reference_no does not exist.</p>";
															
														}
														}
										mysqli_close($db_connection);
													
								}
						?>
						
						
						</form>	
						
		</body>
		
	</html>	