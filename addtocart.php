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

// Get item row
$sqlitem = mysqli_query($conn, "SELECT Quantity FROM Items WHERE ID = '$Item_ID'");
$q = mysqli_fetch_array($sqlitem, MYSQLI_ASSOC);

// För att lägga till items till databasen.
if($q['Quantity'] == 0) {
	$addItem = "INSERT INTO Shoppingcart (Price, Customer_ID, Items_ID, Quantity)
VALUES ('$Price', '$cusID' , '$Item_ID', 1)";
	if ($conn->query($addItem) === TRUE) {
	    header("Location: prenumerera.php");
	} else {
	    echo "Error: " . $addItem . "<br>" . $conn->error;
	}
} else {
	$q = $q+1;
	$price = $Price * $q;
	$updateItem = "UPDATE Shoppingcart SET Quantity = '$q', Price = '$price' WHERE (Customer_ID = '$cusID', Items_ID = '$Item_ID')";
	if ($conn->query($updateItem) === TRUE) {
	    header("Location: prenumerera.php");
	} else {
	    echo "Error: " . $addItem . "<br>" . $conn->error;
	}
}


$conn->close();

// Skicka Shoppingcart_ID till varukorg.php???
//<input type="hidden" name="id" value="<?php echo $r['ID']:
	
?> 





