			<!--	Assignment1, Login Page, StudentID - 4949773, Name - Ronak Shah	 -->
			   <!--Main function of this page is to Login the user successfully-->
							<!--Head of login page-->

<! DOCTYPE html>
	<html lang = en>
		<head>
		
			<meta charset = "utf-8"/>
			<meta name = "description"		content = "Login Page of CabsOnline"/>
			<meta name = "keywords"			content = "CabsOnline,cabs, book cabs online, cabs online"/>
			<meta name = "author"			content = "Ronak Shah"/>
			<title>CabsOnline</title>
		
		</head>
		
		<body>
		
			<header> 
			
				<h1> Login to CabsOnline </h1>
				
			</header>
		
			<section>
					<p> please fill the fields below to complete your registration </p>
							
							<!--Form to Login the customer-->
							
						<form id = "register" method = "post">
						
							<p><label for = "email">Email</label></p>
							<input type = "email" id = "email" name = "custemail" required = "required"/>
							
							<p><label for = "password">Password</label></p>
							<input type = "password" id = "password" name = "custpassword" required = "required">
							
							<p><input type = "submit" name = "Log In"></p>
						
						</form>
						
							<p> New member? <a href = "register.php">Register now</a></p>
						
			</section>
		
		<?php
						// Execute only if login is clicked.
						
				if(isset($_POST['custemail']) && isset($_POST['custpassword'])){
					
					$email = trim($_POST["custemail"]);
					$pass = trim($_POST["custpassword"]);
					
					include_once ("connect.php");
											
					$db_connection = @mysqli_connect($host, $user, $pwd, $db);
					
					// Check whether the database connection exist.
					
					if(!$db_connection)
					{
					echo "<p>Unable to connect to database</p>";
					}
					else{					
					
					// Check whether customer with this email id and password exist.
					
					$query = "SELECT * FROM CUSTOMER WHERE (Cust_email = '".$email."' AND Cust_password = '".$pass."')";
					
					$query_select = mysqli_query($db_connection, $query);
					
						$result_query = mysqli_fetch_assoc($query_select);
						
						if($result_query > 0)
						{
							mysqli_close($db_connection);
							// Once user login they are directed to booking page and email is stored.
							header("Location: https://mercury.ict.swin.edu.au/cos80021/s4949773/Assignment1/booking.php? email=".$email);
							
						}else{
							echo "<p> Login failed</p>";
							echo "Email_Id or password does not exist.";
							
						}
					mysqli_close($db_connection);
					}
					
				}
		
		
		?>
		
		
		</body>
		
	</html>	