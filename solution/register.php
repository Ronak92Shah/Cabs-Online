		<!--	Assignment1, Register Page, StudentID - 4949773, Name - Ronak Shah	 -->
		     <!--Main function of this page is to register the user successfully-->
							<!--Head of register page-->
<! DOCTYPE html>
	<html lang = en>
		<head>
		
			<meta charset = "utf-8"/>
			<meta name = "description"		content = "Register Page of CabsOnline"/>
			<meta name = "keywords"			content = "CabsOnline,cabs, book cabs online, cabs online"/>
			<meta name = "author"			content = "Ronak Shah"/>
			<title>CabsOnline</title>
		
		</head>
		
		<body>
		
			<header> 
			
				<h1> Register to CabsOnline </h1>
				
			</header>
						<!--Form to register the customer-->
			<section>
					<p> Please fill the fields below to complete your registration </p>
					
						<form id = "submit" method = "post" action = "<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
							
							<p><label for = "name">Name:</label>
							<input type = "text" id = "name" name = "custname" required = "required"/></p>
							
							<p><label for = "password">Password:</label>
							<input type = "password" id = "password" name = "custpassword" required = "required"></p>
							
							<p><label for = "confirmpassword">Confirm Password:</label>
							<input type = "password" id = "confirmpassword" name = "custconfirmpassword" required = "required"/></p>
							
							<p><label for = "email">Email:</label>
							<input type = "email" id = "email" name = "custemail" required = "required"/></p>
							
							<p><label for = "phone">Phone:</label>
							<input type = "tel" id = "phone" name = "custphone" required = "required"/></p>
							
							<p><input type = "submit" value = "Register" name = "register"/></p>
						
						</form>
						
							<p> Already registered?<a href = "login.php">Login here</a></p>
						
			</section>
			
			<?php
					
					// Execute only if register is clicked.
			
					if(isset($_POST['register']))
					{
										// Store the values entered by customer in variable.
										
									$cust_email 	= trim($_POST["custemail"]);
									$cust_name 		= trim($_POST["custname"]);
									$cust_pwd 		= trim($_POST["custpassword"]);
									$cust_conpwd	= trim($_POST["custconfirmpassword"]);
									$cust_phoneno 	= trim($_POST["custphone"]);
										
										// Declare Variable to store error message.
										
										$errMsg = " ";
										$result = true;
										
										// Check name have only alphabets.
										
										if(!preg_match("/^[a-zA-Z ]*$/", $cust_name))
										{
											$errMsg = $errMsg."<p>Name should not have numbers</p>";	
										}
										
										// Validate Password and Confirm Password.
										
										if($cust_pwd != $cust_conpwd)
										{
										$errMsg = $errMsg."<p>Your Password do not match</p>";
										$errMsg = $errMsg."<p>Please Enter Password again</p>";
										$result = false;
										}
										
										// Validate e-mail.
										
										if(strlen($cust_email) > 30)
										{	
										$errMsg = $errMsg."<p>Email address is too long to fit.</p>";
										$result = false;
										}
										if (!filter_var($cust_email, FILTER_VALIDATE_EMAIL)) 
										{
										$errMsg = $errMsg."<p>Email address is not Valid</p>";
										$result = false;
										}
										
										// Validate PhoneNo, check length and allow user to enter only integers.
									
										if(preg_match('/^[0-9]/',$cust_phoneno))
										{
										$phone_no = strlen($cust_phoneno);
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
										
										//If users enter invalid data then it will be displayed to him/her.
										
										if($result == false){
											echo "<p> Sorry Registration failed !!!</p>";
											echo "<p> $errMsg  </p>";
										}
										else{
											// Connect to database
											
											include_once ("connect.php");
											
												$db_connection = @mysqli_connect($host, $user, $pwd, $db);
					
													// Check whether the database connection exist.
					
														if(!$db_connection)
														{
														echo "<p>Unable to connect to database</p>";
														}
														else{
															
													// Create Customer table to store the registered customer. 
												
													$query_create = "CREATE TABLE CUSTOMER(
														Cust_email				VARCHAR(30) NOT NULL PRIMARY KEY,
														Cust_name				VARCHAR(20) NOT NULL,
														Cust_password			VARCHAR(20) NOT NULL,
														Cust_phoneno			INT(10) NOT NULL
														)";
															
														// Check whether table is being created or not
														
															$result_create = @mysqli_query($db_connection, $query_create);
															
															if(!$result_create)
															{
																//echo "<p>Unable to create table</p>";
															}
															else
															{														
																//echo "<p>Table created successfully</p>";
															}
															
															// Check whether email address already exist.
															
															$query_select_email = "SELECT 1 FROM CUSTOMER WHERE (Cust_email = '".$cust_email."')"; 
									
															$result_email = mysqli_query($db_connection, $query_select_email);
									
															$row = mysqli_fetch_assoc($result_email);
															
															if($row > 0)
															{
															echo "<p>This email address is already being registered</p>";
															echo "<p>If you already have Register then, Please Login</p>";
															}
															
															else{
																// If everything works fine then User is registered and data is being entered.
																
																$query_insert = "INSERT INTO CUSTOMER(Cust_email, Cust_name,Cust_password,Cust_phoneno) 
																				VALUES('$cust_email', '$cust_name', '$cust_pwd', '$cust_phoneno')";
							
							
																$result_insert = mysqli_query($db_connection, $query_insert);
							
																if ($result_insert)
																	{
																		echo "New record created successfully";
																		mysqli_close($db_connection);
																		// Once registered User should be transferred to booking page and also email is attached to it. 
																		header("Location: https://mercury.ict.swin.edu.au/cos80021/s4949773/Assignment1/booking.php? email=".$cust_email);
																		
																	}
																		else 
																	{
																		echo "Unable to insert the new record";
																		
																	}

																	
															}
															mysqli_close($db_connection);
															
														}
											
											
										}
					
			}
			
			?>
			
			<?php
	
/*
 Author:Parag Mahajan
 Title: add_customers.php
 
 file is to add customer information table.
 */
 
 
 
	session_start();
	if(isset($_POST['fname']))
	{
		require_once ("setting.php"); //connection info 
		$conn = @mysqli_connect($host, $user, $pwd, $sql_db); 
		// Checks if connection is successful
		if (!$conn) {
			// Displays an error message, avoid using die() or exit() as this terminates the execution
			// of the PHP script
			echo "<p>Database connection failure</p>";  //Would not show in a production script 
		} else {
			// Upon successful connection
			
			// Get data from the customer reg form
			$fname	= trim($_POST["fname"]);
			$lname	= trim($_POST["lname"]);
			$dob	= trim($_POST["dob"]);
			$emailid	= trim($_POST["email"]);
			$mobileno	= trim($_POST["phone"]);
			
			$bil_st	= trim($_POST["bil-st-addr"]);
			$bil_suburb	= trim($_POST["bil-sub-addr"]);
			$bil_state	= trim($_POST["bil-state"]);
			$bil_postcode	= trim($_POST["bil-postcode"]);
			
			$del_st	= trim($_POST["del-st-addr"]);
			$del_suburb	= trim($_POST["del-sub-addr"]);
			$del_state	= trim($_POST["del-state"]);
			$del_postcode	= trim($_POST["del-postcode"]);
						
			$sql_table="customers";
			
			// check: if table does not exist, create it
			$query = "show tables like '$sql_table'";  // another alternative is to just use 'create table if not exists ...'
			$result = @mysqli_query($conn, $query);
			// checks if any tables of this name
			if(mysqli_num_rows($result)==0) {
			
				$fieldDefinition="cust_id INT AUTO_INCREMENT
								, fname VARCHAR(25) NOT NULL
								, lname VARCHAR(25) NOT NULL
								, bod DATE 
								, bil_st VARCHAR(25) NOT NULL
								, bil_suburb VARCHAR(25) NOT NULL
								, bil_state VARCHAR(25) NOT NULL
								, bil_postcode INT(10) NOT NULL
								, del_st VARCHAR(25) NOT NULL
								, del_suburb VARCHAR(25) NOT NULL
								, del_state VARCHAR(25) NOT NULL
								, del_postcode INT(10) NOT NULL
								, email VARCHAR(40) NOT NULL
								, phone VARCHAR(10) NOT NULL
								,PRIMARY KEY(cust_id)
								";
				echo "<p>Table does not exist - create table $sql_table</p>"; // Might not show in a production script 
				$query = "create table " . $sql_table . "(" . $fieldDefinition . ") ENGINE=InnoDB"; 
				
				$result2 = @mysqli_query($conn, $query);
				// checks if the table was created
				if($result2===false) {
					echo "<p class=\"wrong\">Unable to create Table $sql_table.". msqli_errno($conn) . ":". mysqli_error($conn) ." </p>"; //Would not show in a production script 
				} else {
				// display an operation successful message
				echo "<p class=\"ok\">Table $sql_table created OK</p>"; //Would not show in a production script 
				} // if successful query operation

			} else {
				// display an operation successful message
				echo "<p>Table  $sql_table already exists</p>"; //Would not show in a production script 
			} // if successful query operation
			// Set up the SQL command to add the data into the table
			$query = "insert into $sql_table values" ."(
														null
														,'$fname'
														, '$lname'
														, '$dob'
														, '$bil_st'
														, '$bil_suburb'
														, '$bil_state'
														, '$bil_postcode'
														, '$del_st'
														, '$del_suburb'
														, '$del_state'
														, '$del_postcode'
														, '$emailid'
														, '$mobileno'
														)";
			// execute the query
			$result = mysqli_query($conn, $query);
			// checks if the execution was successful
			if(!$result) {
				echo "<p class=\"wrong\">Something is wrong with ",	$query, "</p>";  //Would not show in a production script 
			} else {
				// display an operation successful message
				echo "<p class=\"ok\">Successfully added New member</p>";
			} // if successful query operation
				
			$query = "SELECT max(cust_id) as cust_id 
						FROM $sql_table 
						";
			
			// execute the query and store result into the result pointer
			$result = mysqli_query($conn, $query);
			if ($row = mysqli_fetch_assoc($result)){
			 $_SESSION['cust_id'] = $row["cust_id"];
			}
			
			// close the database connection
			mysqli_close($conn);
			
			header("location:select.php");
				

		} 
	}


?>		
		</body>
		
	</html>