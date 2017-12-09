<!DOCTYPE html>
<html lang="sv">

<head>
<meta charset="utf-8">
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
	$sqlad = "SELECT ID FROM Admin WHERE Email = '$Mejl' and Password = '$Password'";
	$result = mysqli_query($conn,$sqlad);
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$active = $row['active'];
	$count = mysqli_num_rows($result);

	// If result matched $Mejl and $Password, table row must be 1 row
	if($count == 1) {
 	session_start();
 	$_SESSION['login_user'] = $Mejl;

 	header("location: welcomeadmin.php");
	}else {
	 echo "Your email or Password is invalid";
	}
}

?>

<link rel="stylesheet" type="text/css" href="techybox.css">

</head>
<body>
	<header>
		<?php include('header.php');?>
	</header>
	
	<div class="contain-all">

	<!-- Bilden till vänster -->
	<fieldset class="allt">
	<img src="https://cdn.shopify.com/s/files/1/0063/5942/products/18092_zoom_grande.jpg?v=1479301552" alt="Test Box" height="300" width="400">
	</fieldset>


	<fieldset class= "inlogg">

	<div id="loggain">
		<br>
		<form method="post" action="">
		<label for="Email">Email:</label>
		<input type="text" name="Mejl" pattern=".{9,40}" required autofocus id="Email"><br>
		<label for="Password">Lösenord:</label>
		<!-- (?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,} -->
		<!-- title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" -->
		<input type="password" name="Password" pattern=".{8,40}" required id="Password"><br>
		<input type="submit" name="inlogg" value="Logga in">
		</form>

	</div>
	
	</fieldset>
	
	</div> <!-- End .contain-all -->
	<footer>
		<?php include('footer.php');?>
	</footer>
	
</body>