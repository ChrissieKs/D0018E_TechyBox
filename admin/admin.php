<!DOCTYPE html>
<html lang="sv">
<head>
	<meta charset="utf-8">
	<title>TechyBox Adminlogin</title>
	<link rel="stylesheet" type="text/css" href="techybox.css">
</head>
<body>
	<?php
		$servername = "utbweb.its.ltu.se";
		$username = "rebmat-5";
		$password = "D0018E";
		$database = "rebmat5db";

		//Create connection to database
		$conn = mysqli_connect($servername, $username,$password, $database);

		//Check connection
		if (!$conn) {
			die("Connection failed: " .mysqli_connect_error());
		}

		//echo "Connection successfully";

		session_start();
	?>

	<?php
		// username and password sent from login form
		if($_SERVER["REQUEST_METHOD"] == "POST") {

		    // To get secure inputs, prevents Cross-Side Scripting (XSS)
			function test_input($dataIn) {
			  $dataIn = trim($dataIn);
			  $dataIn = stripslashes($dataIn);
			  $dataIn = htmlspecialchars($dataIn);
			  return $dataIn;
			}

		    // mysqli_real_escape prevents mySQL Injections. 
			$Mejl = mysqli_real_escape_string($conn, test_input($_POST['Mejl']));
			$Password = mysqli_real_escape_string($conn, test_input($_POST['Password'])); 
			$sqlad = "SELECT ID, Password FROM Admin WHERE Email = '$Mejl'";
			$result = mysqli_query($conn,$sqlad);
			$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
			$count = mysqli_num_rows($result);

			// If result matched $Mejl and $Password, table row must be 1 row
			if(password_verify($Password, $row['Password'])) {
		 		session_start();
		 		$_SESSION['login_user'] = $Mejl;

		 		header("location: welcomeadmin.php");
			}else {
			 	echo "Your email or Password is invalid";
			}
		}

	?>

	<div class="contain-all">
	<fieldset class="img">
		<!-- Picture to the left. Jag har fått friheten att använda bilden från pexels.com. -->
		<img src="https://static.pexels.com/photos/190930/pexels-photo-190930.jpeg" alt="Black Box" height="290" width="500">
	</fieldset>


	<fieldset class= "inlogg">

	<div id="loggain">
		<form method="POST">
			<table>
				<tr>
					<td><label for="Email">Email:</label></td>
					<td><input type="text" name="Mejl" pattern=".{9,40}" required autofocus id="Email"></td>
				</tr>
				<tr>
					<td><label for="Password">Lösenord:</label></td>
					<td><input type="password" name="Password" pattern=".{8,40}" required id="Password"></td>
				</tr>
			</table>
		<input type="submit" name="inlogg" value="Logga in">
		</form>
	</div>
	
	</fieldset>
	
	</div> <!-- End .contain-all -->
	<footer>
		<hr>
	</footer>
	
</body>