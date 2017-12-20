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
$delRow = mysqli_query($conn, "DELETE FROM Shoppingcart WHERE ID = '$cartID'");

header("location: varukorg.php");

?>