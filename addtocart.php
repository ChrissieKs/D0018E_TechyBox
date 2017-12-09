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

echo "Connection successfully";



include('session.php');
// To get the Customer ID
$sqlq = mysqli_query($conn, "SELECT ID FROM Customer WHERE Email = '$user_check' ");
$row = mysqli_fetch_array($sqlq,MYSQLI_ASSOC);
$cusID= $row['ID'];
echo $cusID;

// Get the ID value from prenumerera.php
$Item_ID = $_GET['id'];
echo '<br>';
echo 'Item ID:';
echo $Item_ID;

// Get the ID value from prenumerera.php

//echo '<br>';
//echo 'Price:';
echo $_GET['price'];
$Price = $_GET['price'];

// För att lägga till items till databasen.
$addItem = "INSERT INTO Shoppingcart (Price, Customer_ID, Items_ID)
VALUES ('$Price', '$cusID' , '$Item_ID')";

if ($conn->query($addItem) === TRUE) {
    echo "New record created successfully";
    header("Location: prenumerera.php");
} else {
    echo "Error: " . $addItem . "<br>" . $conn->error;
}

$conn->close();

// Skicka Shoppingcart_ID till varukorg.php???
//<input type="hidden" name="id" value="<?php echo $r['ID']:
	
?> 





