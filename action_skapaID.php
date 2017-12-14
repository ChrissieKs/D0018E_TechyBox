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

// mysqli_real_escape prevents mySQL Injections. 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $Name = mysqli_real_escape_string($conn, test_input($_POST["Name"]));
  $Mejl = mysqli_real_escape_string($conn, test_input($_POST["Mejl"]));
  $Phone_number = mysqli_real_escape_string($conn, test_input($_POST["Phone_number"]));
  $Address = mysqli_real_escape_string($conn, test_input($_POST["Address"]));
  $Password = password_hash(mysqli_real_escape_string($conn, test_input($_POST["Password"])), PASSWORD_DEFAULT);
  //echo $Password;
}

// To get secure inputs. To prevent Cross-Side Scripting (XSS)
function test_input($dataIn) {
  $dataIn = trim($dataIn);
  $dataIn = stripslashes($dataIn);
  $dataIn = htmlspecialchars($dataIn);
  return $dataIn;
}



// Insert into table.
$sql = "INSERT INTO Customer (Name, Email, Address, Phone_number, Password)
VALUES ('$Name', '$Mejl', '$Address', '$Phone_number', '$Password')";


//echo "<br>", $Name, "<br>", $Mejl, "<br>", $Address, "<br>", $Phone_number, "<br>", $Password;
if ($conn->query($sql) === TRUE) {
  $message = "Din användare är nu skapad! Testa att logga in!";
    echo "<script>function varuPopup(){alert($message);}</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?> 
<?php header("Location: welcome.php"); ?>

