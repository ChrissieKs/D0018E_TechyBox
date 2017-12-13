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

	$search = $_GET['id'];
	$del = mysqli_query($conn, "DELETE FROM Items WHERE ID = '$search'");
	header("location: alteritems.php");
?>
