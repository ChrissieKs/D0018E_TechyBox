<!DOCTYPE html>
<html lang="sv">
<head>
	<meta charset="utf-8">
	<title>Orderbekräftelse</title>
	<link rel="stylesheet" type="text/css" href="techybox.css">
</head>
<body>
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
		//to get the customers items from shoppingcart
		$sqlcart = "SELECT * FROM Shoppingcart WHERE Customer_ID = '$cusID'";
		$cart = mysqli_query($conn, $sqlcart);
		$c2 = mysqli_fetch_assoc($cart);
		//echo $c2['ID'];
	?>
	<?php
			// Get the ID value from varukorg.php
			$shop = $_GET['id'];
			//echo '<br>';
			//echo 'Shop:';
			//echo $shop;
			// Hämta datum
			$date = date("d-m-Y H:i:s");
			$address = $row['Address'];
			// För att lägga till varukorg till shipment.
			$addShop = "INSERT INTO Shipment (Date_Time, Address, Customer_ID)
			VALUES ('$date', '$address', '$cusID')";

			$sqlship = mysqli_query($conn, "SELECT ID FROM Shipment WHERE Customer_ID = '$cusID' AND Date_Time = '$date'");
			$ship = mysqli_fetch_array($sqlship, MYSQLI_ASSOC);


			if ($conn->query($addShop) === TRUE) {
			} else {
			    echo "Error: " . $addShop . "<br>" . $conn->error;
			}

		?>

	<a href="http://utbweb.its.ltu.se/~rebmat-5/welcome.php"><img src="TechyBox_logga.png" alt="logga" height="50" width="50"></a>
	<h1>Orderbekräftelse</h1>
	<h2>Tack för din beställning!</h2>
	Din order behandlas och du kan se detaljerna nedan. Vid frågor är ni välkomna att kontakta oss på 0XX-XXXXXX.
	<br>
	<hr>
	<br>
	<table>    	
		<div>
			<tr>
				<th><h3>Dina kunduppgifter</h3></th>
			</tr>
			<tr>
				<td><p>Ordernummer: </p></td>
				<td><p><?php echo $shop; echo '<br>' ; ?> </p></td>
			</tr>
			<tr>
				<td><p>Kundnummer: </p></td>
				<td><p><?php echo $row['ID']; echo '<br>' ; ?> </p></td>
			</tr>
			<tr>
				<td><p>Namn: </p></td>
				<td><p><?php echo $row['Name']; echo '<br>' ; ?> </p></td>
			</tr>
			<tr>
				<td><p>Adress: </p></td>
				<td><p><?php echo $row['Address']; echo '<br>' ; ?> </p></td>
			</tr>
			<tr>
				<td><p>Telefonnummer: </p></td>
				<td><p><?php echo $row['Phone_number']; echo '<br>' ; ?> </p></td>
			</tr>
			<tr>
				<td><p>Email: </p></td>
				<td><p><?php echo $row['Email']; echo '<br>' ; ?> </p></td>
			</tr>
		</div>
	</table> 
	<br>
	<hr>
	<br>

	<div id="main"> 
		<table id="varukorg-tabell">
	        	
	<?php 
		$sum = 0;
		mysqli_data_seek($cart, 0);
		while($c = mysqli_fetch_assoc($cart)){ 
			$itemsID = $c['Items_ID'];
			$cartID = $c['ID'];
			$sqlitem = "SELECT Image, Name FROM Items WHERE ID = '$itemsID'";
			$item = mysqli_query($conn, $sqlitem);
			$i = mysqli_fetch_assoc($item); 
			$shipID = $ship['ID']; ?>

			<tr>
				<td><p>Varunummer </p></td>
				<td><p><?php echo $c['Items_ID']; echo '<br>' ; ?> </p></td>
				<td><img src="<?php echo $i['Image']; ?>" height="50" width="50"></td>
				<td><p><?php echo $i['Name']; echo '<br>' ; ?> </p></td>
				<td><p><?php echo $c['Price'];echo " Kr"; ?> </p></td>
			
			</tr>
			<?php $sum = $sum + $c['Price'];

			$shipshop = "INSERT INTO Ship_shop (Shoppingcart_ID, Shipment_ID) VALUES ('$cartID', '$shipID')";
			if ($conn->query($shipshop) === TRUE) {
			} else {
			    echo "Error: " . $addShop . "<br>" . $conn->error;
			}
		} ?>
	<tr>
		<td><h3>Summa: </h3></td>
		<td><p><?php echo $sum;  ?> Kr</p></td>
			
	</tr>
</table>
	        
    </div><!--end main-->

</body>