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

$cartID = $_GET['id'];
$value = $_GET['quantity'];

$updateQuantity = mysqli_query($conn, "UPDATE Shoppingcart SET Quantity = '$value' WHERE ID = '$cartID'");

header("location: varukorg.php");

?>