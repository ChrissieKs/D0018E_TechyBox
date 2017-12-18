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

	?>
	<!-- Admin sessions -->
	<?php //include ('admin_session.php'); ?>
</head>
<body>
	<header>
		<?php include('adminheader.php'); ?>
	</header>
<!--  to update customer information -->
	<div id="alterCustomer" class="contain-all">
	<h1 id="logout-button"><a href="logout.php">Logga ut</a></h1>
	<h2>Uppdatera varuinformationen genom att fylla i alla fält.</h2>
	<div class="second_container">
		<form method="post">
			<table>
					<tr>
						<td><label for="name">Namn:</label></td>
						<td><input type="text" name="name" pattern="{4,40}" required id="name"></td>
					</tr>
					<tr>
						<td><label for="price">Pris:</label></td>
						<td><input type="text" name="price" pattern=".{1,5}" required id="price"></td>
					</tr>
					<tr>
						<td><label for="image">Bild:</label></td>
						<td><input type="text" name="image" required id="image"></td>
					</tr>
				</table>
			<br>
			<input type="submit" name="change" value="Ändra"> 
		</form>
	</div> <!-- End .second_Container -->
	<?php
		if($_SERVER["REQUEST_METHOD"] == "POST") {

		    // To get secure inputs, prevents Cross-Side Scripting (XSS)
			function test_input($dataIn) {
				$dataIn = trim($dataIn);
				$dataIn = stripslashes($dataIn);
			 	$dataIn = htmlspecialchars($dataIn);
			  	return $dataIn;
			}

		    // mysqli_real_escape prevents mySQL Injections. 
		    $item_ID = $_GET['id'];
			$Name = mysqli_real_escape_string($conn, test_input($_POST['name']));
			$Price = mysqli_real_escape_string($conn, test_input($_POST['price'])); 
			$Image = mysqli_real_escape_string($conn, test_input($_POST['image']));
			
			// Update values in customer table
			$updateTable = mysqli_query($conn, "UPDATE Items SET Name = '$Name', Price = '$Price', Image = '$Image' WHERE ID = '$item_ID'");
			header('alteritems.php');
		}
	?>
	</div> <!-- End #alterCustomer -->
 </body>
