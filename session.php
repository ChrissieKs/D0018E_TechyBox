<?php
$servername = "utbweb.its.ltu.se";
$username = "rebmat-5";
$password = "D0018E";

//Create connection
$conn = mysqli_connect($servername, $username,$password, "rebmat5db");

session_start();
$user_check = $_SESSION['login_user'];
   
$ses_sql = mysqli_query($conn,"SELECT Email FROM Customer WHERE Email = '$user_check' ");
// To get the row where the users email is stored.
$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

$login_session = $row['Email'];

// If the session login_user is not set, relocate to index to log in.
if(!isset($_SESSION['login_user'])){
  header("location: index.php");
}
?> 

