							<!--	Assignment1, Connect Page, StudentID - 4949773, Name - Ronak Shah	 -->
								<!--Main function of this page is to connect to database successfully-->			

<?php
// Just helps to connect to the database.
	$host = "localhost";
	$user = "root";
	$pwd  = "";
	$db = "theflowercharm";
	$db_connection = @mysqli_connect($host, $user, $pwd, $db); 

?>