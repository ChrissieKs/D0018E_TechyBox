<!DOCTYPE html>
<html lang="sv">
<head>
	<meta charset="utf-8">
	<title>TechyBox Admin Welcome</title>
	<link rel="stylesheet" type="text/css" href="techybox.css">
	<?php
		$servername = "utbweb.its.ltu.se";
		$username = "rebmat-5";
		$password = "D0018E";

		//Create connection
		$conn = mysqli_connect($servername, $username,$password, "rebmat5db");

		//Check connection
		if (!$conn) {
			die("Connection failed: " .mysqli_connect_error());
		}

		//echo "Connection successfully";
	?>
	
	<!-- Admin sessions -->
	<?php //include ('admin_session.php'); ?>
</head>
<body>
	<header>
		<?php include('adminheader.php'); ?>
	</header>
	<div class="contain-all">
		<h1 id="logout-button"><a href="logout.php">Logga ut</a></h1>
		<!-- sökfält där man skriver in customer id och får all info om customer --> 
		<h2>Hitta information om Kundens uppgifter och ordrar</h2>
		<div class="sokCustomer">
			<fieldset class= "adminsokcustomer">
			<form method="GET" action="search_customer.php" name="myform">
				<!-- hidden input with admin id, for security reasons??? -->
				<label for="Kundnummer">Kundnummer:</label>
				<input type="text" name="Customer_ID" pattern=".{4,5}" required autofocus id="Kundnummer"><br>
				<input type="submit" value="Hitta">
			</form>
			</fieldset>

		</div> <!-- End .adminsokcustomer -->
	</div> <!-- End .contain-all -->	
</body>