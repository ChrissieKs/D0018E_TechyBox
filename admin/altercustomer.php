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
</head>
<body>
<!--  to update customer information -->
	<div id="alterCustomer">
	<form method="post">
		<table>
			<tr>
				<td><label for="Name">Namn:</label></td>
				<td><input type="text" name="Name" pattern="{5,40}" required placeholder="Förnamn Efternamn" id="Name">*</td>
			</tr>
			<tr>
				<td><label for="mejl">Email:</label></td>
				<td><input type="text" name="Mejl" pattern=".{9,30}" required id="mejl">*</td>
			</tr>
			<tr>
				<td><label for="adress">Adress:</label></td>
				<td><input type="text" name="Address" pattern=".{12,40}" required id="adress">*</td>
			</tr>
			<tr>
				<td><label for="telefon">Telefon:</label></td>
				<td><input type="number" name="Phone_number" required id="telefon" placeholder="07XXXXXXXX">*</td>
			</tr>
		</table>
		<br>
		<input type="submit" name="change" value="Change"> 
	</form>
	</div> <!-- End #alterCustomer -->

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
			$Name = mysqli_real_escape_string($conn, test_input($_POST['Name']));
			$Email = mysqli_real_escape_string($conn, test_input($_POST['Mejl'])); 
			$Address = mysqli_real_escape_string($conn, test_input($_POST['Address']));
			$Phone_number = mysqli_real_escape_string($conn, test_input($_POST['Phone_number']));
			
			// Update values in customer table
			$updateTable = mysqli_query("UPDATE Customers SET Name = '$Name', Email = '$Email', Address = '$Address', Phone_number = 'Phone_number' WHERE ID = '$customer_ID'");
		}
	?>
 </body>
