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
	<?php
		if($_SERVER["REQUEST_METHOD"] == "GET") {
			// To get secure inputs, prevents Cross-Side Scripting (XSS)
				function test_input($dataIn) {
				  $dataIn = trim($dataIn);
				  $dataIn = stripslashes($dataIn);
				  $dataIn = htmlspecialchars($dataIn);
				  return $dataIn;
				}

			// mysqli_real_escape prevents mySQL Injections. 
			// to get Customer information
			$customer_ID = mysqli_real_escape_string($conn, test_input($_GET['Customer_ID']));	
			$customer_resultat = mysqli_query($conn, "SELECT Name, Email, Address, Phone_number FROM Customer WHERE ID = '$customer_ID'" );	
			$customer_row = mysqli_fetch_assoc($customer_resultat);


			// mysqli_real_escape prevents mySQL Injections. 
			// to get Shipment information
			$shipment_resultat = mysqli_query($conn, "SELECT ID, Date_Time, Address FROM Shipment WHERE Customer_ID = '$customer_ID'" );
	
			
		}
		
	?>
	<?php
		if($_SERVER["REQUEST_METHOD"] == "POST") {
			$cus_ID = $_POST['customer'];
			$delete_customer = mysqli_query($conn, "DELETE FROM Customer WHERE ID = '$cus_ID'");
			header("location: welcomeadmin.php");	
			
		}
		
	?>
	<script>
		window.onload = function() {
	        document.myform.action = unhideTable();
	    }

		function unhideTable() {
			document.getElementById('contain-info-table').hidden = false;}

		function del_cus() {
			alert("Kunden är borttagen!");
		}
	</script>
</head>
<body>
	<header>
		<?php include('adminheader.php'); ?>
	</header>
	<div class="contain-all">
		<h1 id="logout-button"><a href="logout.php">Logga ut</a></h1>
		<div id="contain-info-table">
			<table class="customer-tabell">
					<tr align="left">
						<th><p>Kundnummer </p></th>
						<th><p>Kundnamn </p></th>
						<th><p>Email </p></th>
						<th><p>Adress </p></th>
						<th><p>Telefon </p></th>
						<th><p>Ta bort Kund</p></th>
					</tr>
					<tr>
						<td><p><?php echo $customer_ID; echo '<br>' ; ?> </p></td>
						<td><p><?php echo $customer_row['Name']; echo '<br>' ; ?> </p></td>
						<td><p><?php echo $customer_row['Email']; echo '<br>' ; ?> </p></td>
						<td><p><?php echo $customer_row['Address']; echo '<br>' ; ?> </p></td>	
						<td><p><?php echo $customer_row['Phone_number']; echo '<br>' ; ?> </p></td>
						<td>
							<form method="POST">
								<input type="hidden" name="customer" value="<?php echo $customer_ID; ?>">
								<input type="submit" value="Ta bort Kund" onclick="del_cus()">
							</form>
						</td>
					</tr>
			</table>

			<table class="shipment-tabell">
					<tr align="left">
						<th><p>Ordernummer </p></th>
						<th><p>Datum </p></th>
						<th><p>Adress </p></th>
						<th><p>Kundnummer </p></th>
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
		</div> <!-- End #contain-info-table -->
	</div> <!-- End .contain-all -->
</body>