<?php
if(isset($_POST['submit_rating']))
{
	$servername = "utbweb.its.ltu.se";
	$username = "rebmat-5";
	$password = "D0018E";
	//Create connection
	$conn = mysqli_connect($servername, $username,$password, "rebmat5db");


	$itemrating = $_POST['itemrating'];
	$insert = mysqli_query("INSERT into Review VALUES ('$itemrating')");

}