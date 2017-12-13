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
	<header><a href="alteritems.php">Varor</a><a href="altercustomer.php">Kund</a></header>
	<div class="contain-all">
		<h1 id="logout-button"><a href="logout.php">Logga ut</a></h1>

		<!-- sökfält där man skriver in customer id och får all info om customer --> 
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
			// to get Customer information
			$customer_ID = mysqli_real_escape_string($conn, test_input($_POST['Customer_ID']));	
			$customer_resultat = mysqli_query($conn, "SELECT Name, Email, Address, Phone_number FROM Customer WHERE ID = '$customer_ID'" );	
			$customer_row = mysqli_fetch_assoc($customer_resultat);


			// mysqli_real_escape prevents mySQL Injections. 
			// to get Shipment information
			$shipment_resultat = mysqli_query($conn, "SELECT ID, Date_Time, Address FROM Shipment WHERE Customer_ID = '$customer_ID'" );	
			echo $shipment_resultat['ID'];


			// to delete Customer 
			//$remove_customer_ID = mysqli_real_escape_string($conn, test_input($_POST['Remove_Customer_ID']));	
			//$remove_customer_resultat = mysqli_query($conn, "DELETE FROM Customer WHERE ID = '$remove_customer_ID'" );	
			//$remove_customer_row = mysqli_fetch_assoc($customer_resultat);
			//echo $customer_row['Name'];
		}
		?>
		<h2>Hitta information om Kundens uppgifter och ordrar</h2>
		<div class="sokCustomer">
			<fieldset class= "adminsokcustomer">
			<form method="POST">
				<!-- hidden input with admin id, for security reasons??? 
				<input type="hidden" name="id" value="<?php /* echo $row['ID']; */ ?>"> -->
				<label for="Kundnummer">Kundnummer:</label>
				<input type="text" name="Customer_ID" pattern=".{4,5}" required autofocus id="Kundnummer"><br>
				<input type="submit" name="inlogg" value="Hitta">
			</form>
			</fieldset>

		</div>

		<table class="customer-tabell" >
				<tr align="left">
					<th><p>Kundnummer: </p></th>
					<th><p>Kundnamn: </p></th>
					<th><p>Email: </p></th>
					<th><p>Adress: </p></th>
					<th><p>Telefon: </p></th>
				</tr>
				<tr>
					<td><p><?php echo $customer_ID; echo '<br>' ; ?> </p></td>
					<td><p><?php echo $customer_row['Name']; echo '<br>' ; ?> </p></td>
					<td><p><?php echo $customer_row['Email']; echo '<br>' ; ?> </p></td>
					<td><p><?php echo $customer_row['Address']; echo '<br>' ; ?> </p></td>	
					<td><p><?php echo $customer_row['Phone_number']; echo '<br>' ; ?> </p></td>
				</tr>
		</table>

		<table class="shipment-tabell" >
				<tr align="left">
					<th><p>Ordernummer: </p></th>
					<th><p>Datum: </p></th>
					<th><p>Adress: </p></th>
					<th><p>Kundnummer: </p></th>
				</tr>
				<?php while($shipment_row = mysqli_fetch_assoc($shipment_resultat)){ ?>
				<tr>
					<td><p><?php echo $shipment_row['ID']; echo '<br>' ; ?> </p></td>
					<td><p><?php echo $shipment_row['Date_Time']; echo '<br>' ; ?> </p></td>
					<td><p><?php echo $shipment_row['Address']; echo '<br>' ; ?> </p></td>
					<td><p><?php echo $customer_ID; echo '<br>' ; ?> </p></td>	
				</tr>
				<?php } ?>
		</table>
	</div> <!-- End .contain-all -->

</body>