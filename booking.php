							<!--	Assignment1, Booking Page, StudentID - 4949773, Name - Ronak Shah	 -->
								 <!--Main function of this page is to book the user successfully-->
												<!--Head of Booking page-->

<! DOCTYPE html>
	<html lang = en>
		<head>
		
			<meta charset = "utf-8"/>
			<meta name = "description"		content = "Booking Page of CabsOnline"/>
			<meta name = "keywords"			content = "CabsOnline,cabs, book cabs online, cabs online"/>
			<meta name = "author"			content = "Ronak Shah"/>
			<title>CabsOnline</title>
		
		</head>
		
		<body>
		
			<header> 
			
				<h1> Booking a Cab</h1>
				
			</header>
		
			<section>
					<p> Please fill the fields below to book a cab </p>
					
									<!--Form to Book the customer-->
									
						<form id = "register" method = "post">
							
							<p><label for = "name">Passenger name:</label>
							<input type = "text" id = "name" name = "cust_passengername" required = "required"/></p>
							
							<p><label for = "contact">Contact phone of the passenger:</label>
							<input type = "tel" id = "contact" name = "cust_contactphone" required = "required"></p>
							
							Pick up address:
							
							<p><label for = "unitno">Unit number:</label>
							<input type = "text" id = "unitno" name = "cust_unitno"/></p>
							
							<p><label for = "streetno">Street number:</label>
							<input type = "text" id = "streetno" name = "cust_streetno" required = "required"/></p>
							
							<p><label for = "streetname">Street name:</label>
							<input type = "text" id = "streetname" name = "cust_streetname" required = "required"/></p>
							
							<p><label for = "suburb">Suburb:</label>
							<input type = "text" id = "suburb" name = "cust_suburb" required = "required"/></p>
							
							<p><label for = "destinationsuburb">Destination Suburb:</label>
							<input type = "text" id = "destinationsuburb" name = "cust_destinationsuburb" required = "required"/></p>
							
							<p><label for = "pickupdate">Pickup date:</label>
							<input type = "date" id = "pickupdate" name = "cust_pickupdate" required = "required"/></p>
							
							<p><label for = "pickuptime">Pickup time:</label>
							<input type = "time" id = "pickuptime" name = "cust_pickuptime" required = "required"/> (24 hr format)</p>
							
							<p><input type = "submit" value = "Book" name = "submit"/></p>
						
						</form>
						
			</section>
			
			<?php
			
						// Execute only if submit is clicked.
			
					if(isset($_POST['submit'])){
						
						// Store the values entered by customer in variable.
						
						$pass_name = trim($_POST["cust_passengername"]);
						$pass_no = trim($_POST["cust_contactphone"]);
						
						// Get email from the header that was defined in login and register page.
						
						$pass_email = trim($_GET["email"]);
						$unit_no = trim($_POST["cust_unitno"]); 
						$street_no = trim($_POST["cust_streetno"]); 
						$street_name = trim($_POST["cust_streetname"]);
						$suburb = trim($_POST["cust_suburb"]); 
						$dest_suburb = trim($_POST["cust_destinationsuburb"]);
					    $pick_up_date = trim($_POST["cust_pickupdate"]);
						$pick_up_time = trim($_POST["cust_pickuptime"]);
					
						// Declare Variable to store error message.
					
						$errMsg = " ";
						$result = true;
						
						// set the default time-zone and store in the variable.
						
						date_default_timezone_set('Australia/Melbourne');
						$curr_date = date('d-m-Y');
						
						// Data entered by user should at-least be 1 hour more then the current time.
						
						$add = strtotime("+1 hours");
						$curr_time = date("H:i", $add);
						
						//echo "<p>$pick_up_time</p>";
						
						//To compare date they are being converted into same format.
						
						$today = strtotime($curr_date);
						$pick = strtotime($pick_up_date);
						$today_time = strtotime($curr_time);
						$pick_time = strtotime($pick_up_time);
						
						//echo "$curr_date";
					
							// Check name have only alphabets.
						
							if(!preg_match("/^[a-zA-Z ]*$/", $pass_name))
							{
							$errMsg = $errMsg."<p>Name should have only letters and white space.</p>";	
							}
							
							// Validate PhoneNo, check length and allow user to enter only integers.
							
							if(preg_match('/^[0-9]/',$pass_no))
							{
							$phone_no = strlen($pass_no);
							if(!($phone_no == 10))
							{
								$errMsg = $errMsg."<p>Phone no must be 10 digits</p>";
								$result = false;
							}}
							else
							{
							$errMsg = $errMsg."<p>Phone no must have only integer</p>";
							$result = false;
							}
							
							// Validate unit no, only numbers can be inserted.
							
							if($unit_no != 0){
							if(!preg_match('/^[0-9]/',$unit_no))
							{
								$errMsg = $errMsg."<p>Unit no must have only integer</p>";
								$result = false;
							}
							}
							
							// Validate street no, only numbers can be inserted.
							
							if(!preg_match('/^[0-9]/',$street_no))
							{
								$errMsg = $errMsg."<p>Street no must have only integer</p>";
								$result = false;
							}
							
							// Validate street name, only alphabets can be inserted.
							
							if(!preg_match("/^[a-zA-Z ]*$/", $street_name))
							{
							$errMsg = $errMsg."<p>Street name should only have letters and white space allowed</p>";	
							$result = false;
							}
							
							// Validate suburb, only alphabets can be inserted.
							
							if(!preg_match("/^[a-zA-Z ]*$/", $suburb))
							{
							$errMsg = $errMsg."<p>Suburb should only have letters and white space allowed</p>";	
							$result = false;
							}
							
							// Validate Destination suburb, only alphabets can be inserted.
							
							if(!preg_match("/^[a-zA-Z ]*$/", $dest_suburb))
							{
							$errMsg = $errMsg."<p>Destination suburb should only have letters and white space allowed</p>";	
							$result = false;
							}
							
							// Date entered is invalid
							
							if($pick < $today){
								
							$errMsg = $errMsg."<p>Pick up date is invalid please check.</p>";
							$result = false;
							}
							
							// Time entered is invalid
							
							if($pick = $today){
								if($pick_time < $today_time)
								{
							$errMsg = $errMsg."<p>Pick up time is invalid please check.</p>";
							$result = false;
							}
							}
							
								// If users enter invalid data then it will be displayed to him/her.
							
								if ($result == false){
								
									echo "<p> Sorry Booking failed !!!</p>";
									echo "<p> $errMsg  </p>";
								}
								else
								{
									include_once ("connect.php");
											
												$db_connection = @mysqli_connect($host, $user, $pwd, $db);
					
													// Check whether the database connection exist.
					
														if(!$db_connection)
														{
														echo "<p>Unable to connect to database</p>";
														}
														else{
															
													// Create Customer table to store the registered customer. 
												
													$query_create = "CREATE TABLE BOOKING(
														Pass_book_num			INT(6) PRIMARY KEY,
														Pass_book_email 		VARCHAR(30) NOT NULL,
														Pass_name				VARCHAR(20) NOT NULL,
														Pass_phoneno			INT(10) NOT NULL,
														Pass_unit_no			INT(10),
														Pass_street_no			INT(10) NOT NULL,
														Pass_street_name		VARCHAR(20) NOT NULL,
														Pass_suburb				VARCHAR(20) NOT NULL,
														Pass_dest_suburb		VARCHAR(20) NOT NULL,
														Pass_pick_up_date		DATE NOT NULL,
														Pass_pick_up_time		TIME NOT NULL,
														Status					VARCHAR(20),
														FOREIGN KEY (Pass_book_email) REFERENCES CUSTOMER(Cust_email)
														)";
											
														// Generate an random booking number.
														
													$refer_number = rand();
													
													$result_create = @mysqli_query($db_connection, $query_create);
															
															if(!$result_create)
															{
																//echo "<p>Unable to create table</p>";
															}
															else
															{														
																//echo "<p>Table created successfully</p>";
															}
															
																// If every thing is perfect insert the value in the table.
																
															$query_insert = "INSERT INTO BOOKING(Pass_book_num, Pass_book_email, Pass_name, Pass_phoneno, Pass_unit_no, Pass_street_no, Pass_street_name, Pass_suburb, Pass_dest_suburb, Pass_pick_up_date, Pass_pick_up_time, Status) 
																				VALUES('$refer_number','$pass_email', '$pass_name', '$pass_no', '$unit_no', '$street_no', '$street_name', '$suburb', '$dest_suburb', '$pick_up_date', '$pick_up_time', 'Unassigned')";
							
							
																$result_insert = mysqli_query($db_connection, $query_insert);
							
																if ($result_insert)
																	{
																		// Once Data stored give an confirmation message to the customer. 
																		
																		echo "<p>Thank You !!!</p>";
																		echo "<p>Your booking reference number is: $refer_number</p>";
																		echo "<p>We will pick up the passengers in front of your provided address at $pick_up_time on $pick_up_date</p>";
																		
																		// Even send the confirmation email to the user.
																		
																		$to = $pass_email;
																		$subject = "Your booking request with CabsOnline!";
																		$message = "Dear $pass_name, Thanks for booking with CabsOnline! Your booking reference number is $refer_number. We will pick up the passengers in front of your provided address at $pick_up_time on $pick_up_date.";
																		$headers = "From booking@cabsonline.com.au";
																		
																		mail($to, $subject, $message, $headers, "-r 4949773@student.swin.edu.au");
																	}
																		else 
																	{
																		echo "Not able to insert";
																		
																	}
															
															
															mysqli_close($db_connection);

								}
								
							}
							
					}
			
			
			?>
			
		
		</body>
		
	</html>	