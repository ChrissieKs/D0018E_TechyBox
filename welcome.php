<!DOCTYPE html>
<html lang="sv">
<head>
	<meta charset="utf-8">
	<title>TechyBox Välkommstsida</title>
	<link rel="stylesheet" type="text/css" href="techybox.css">
	
</head>
<body>
	<header>
		<?php include('header.php');?>
	</header>
	<?php include('session.php'); ?>
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
		include ('session.php');
		// To get the Customer ID
		$sqlcus = mysqli_query($conn, "SELECT * FROM Customer WHERE Email = '$user_check' ");
		$row = mysqli_fetch_array($sqlcus,MYSQLI_ASSOC);
		$cusID= $row['ID'];

		$sqlship = mysqli_query($conn, "SELECT * FROM Shipment WHERE Customer_ID = '$cusID'");
	?>

	<div class="contain-all">
		<h1 id="logout-button"><a href="logout.php">Logga ut</a></h1>
	<fieldset class="img">
		<!-- Picture to the left. Jag har fått friheten att använda alla bilder (från pexels.com). -->
		<img src="https://static.pexels.com/photos/190930/pexels-photo-190930.jpeg" alt="Black Box" height="290" width="500">
	</fieldset>
	
	<h1>Mina Sidor</h1>
	<hr>
	<h3>Mina uppgifter</h3>
	<?php 
		echo 'Namn: ';
		echo $row['Name'];
		echo '<br>';
		echo 'Adress: ';
		echo $row['Address'];
		echo '<br>';
		echo 'Telefonnummer: ';
		echo $row['Phone_number'];
		echo '<br>';
	?>
	<hr>
	<h3>Ordrar</h3>
	<table>
		<tr>
			<th><?php echo 'Ordernummer: '; ?></th>
			<th><?php echo 'Adress: '; ?></th>
			<th><?php echo 'Datum: '; ?></th>
		</tr>
		<?php while($rowShip = mysqli_fetch_assoc($sqlship)) { ?>
			<tr>
				<td><?php echo $rowShip['ID'];?></td>
				<td><?php echo $rowShip['Address'];?></td>
				<td><?php echo $rowShip['Date_Time'];?></td>
			</tr>
		<?php } ?>
		
	</table>

	</div> <!-- End .contain-all -->
	<footer>
		<?php include('footer.php');?>
	</footer>
</body>