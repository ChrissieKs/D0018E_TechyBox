<!DOCTYPE html>
<html lang="sv">
<head>
	<meta charset="utf-8">
	<title>TechyBox Varukorg</title>
	<link rel="stylesheet" type="text/css" href="techybox.css">
</head>
<body>
	<header>
		<?php include('header.php');?>
	</header>
	
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
		$sqlcus = mysqli_query($conn, "SELECT ID FROM Customer WHERE Email = '$user_check' ");
		$row = mysqli_fetch_array($sqlcus,MYSQLI_ASSOC);
		$cusID= $row['ID'];
		//to get the customers items from shoppingcart
		$sqlcart = "SELECT * FROM Shoppingcart WHERE Customer_ID = '$cusID'";
		$cart = mysqli_query($conn, $sqlcart);
	?>
	
	<div class="contain-all">
	<div id="container"> 
		<h1>Varukorg</h1>
        <div id="main"> 
        	<table class="varukorg-tabell">
				<tr align="left">
					<th><p>ID</p></th>
					<th></th>
					<th><p>Produkt</p></th>
					<th><p>Pris</p></th>
					<th><p>Antal</p></th>
					<th>Ta bort</th>
				</tr>
				        	
				<?php 
					$sum = 0;
					mysqli_data_seek($cart, 0);
					while($c = mysqli_fetch_assoc($cart)){ 
						$itemsID = $c['Items_ID'];
						$cartID = $c['ID'];
						$sqlitem = "SELECT * FROM Items WHERE ID = '$itemsID'";
						$item = mysqli_query($conn, $sqlitem);
						$i = mysqli_fetch_array($item, MYSQLI_ASSOC); 
						$q = $c["Quantity"];
						if(($i['Visible'] == 'True' and $c['Visible'] == 'True')) { ?>
							
							<tr>
								<td><p><?php echo $c['Items_ID']; echo '<br>' ; ?></p></td>
								<td><img src="<?php echo $i['Image']; ?>" height="50" width="50"></td>
								<td><p><?php echo $i['Name']; echo '<br>' ; ?> </p></td>
								<td><p><?php echo $c['Price'];echo " Kr"; ?> </p></td>
								<!-- Change quantity -->
								<td>
									<form action="changeQuantity.php?id=<?php echo $cartID; ?>" method='GET'>
										<input type="hidden" name="id" value="<?php echo $cartID; ?>">
										<input type="number" name="quantity" value="<?php echo $q ?>" min="0" max="99" required>
										<input type="submit" value="Ändra">
									</form>
								</td> 
								<!-- Delete row -->
								<td>
									<form action="delCartRow.php?<?php echo $cartID; ?>" method='GET'>
										<input type="hidden" name="id" value="<?php echo $cartID; ?>">	
										<input type="submit" value="Ta bort" id="delete_button">
									</form>
								</td>
							</tr>
							<?php $sum = $sum + ($c['Price'] * $q); ?>
						<?php }
					} ?>
				<tr>
					<td><h3>Summa: </h3></td>
					<td><p><?php echo $sum;  ?> Kr</p></td>
						
				</tr>
			</table>
			<form action="shipment.php">
			<!-- Godkänna villkor innan man skickar vidare beställningen -->
	        <input type="submit" value="Bekräfta beställning" id="shipment_button" onclick="up_quant()">
	        
	        <script>
				function up_quant() {
				    var input = document.getElementById('<?php echo $c['ID']; ?>');
					input.setAttribute('value', input.value);
				}
			</script>
        </div><!--end main-->
        </form>
        <div id="sidebar"> 
              
        </div><!--end sidebar-->
  
    </div><!--end container-->

	</div> <!-- End .contain-all -->
	<footer>
		<?php include('footer.php');?>
	</footer>
</body>