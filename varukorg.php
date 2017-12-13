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
		$c2 = mysqli_fetch_assoc($cart);
		//echo $c2['ID'];

	?>
	
	<div class="contain-all">
	<div id="container"> 
		<h1>Varukorg</h1>
  		<form action="shipment.php?id=<?php echo $c2['ID']; ?>" method="GET">
        <div id="main"> 
        	<input type="hidden" name="id" value="<?php echo $c2['ID']; ?>">
        	
        	<?php include('itemtable.php');?>
			<!-- Godkänna villkor innan man skickar vidare beställningen -->
	        <input type="submit" value="Bekräfta beställning" id="shipment_button">
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