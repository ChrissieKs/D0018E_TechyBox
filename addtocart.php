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

// Get the ID value from prenumerera.php
$Item_ID = $_GET['id'];

// Get the price from prenumerera.php
$Price = $_GET['price'];

// Get quantity from prenumerera.php
$quantity = $_GET['quantity'];

// Get item row
$sqlitem = mysqli_query($conn, "SELECT Quantity, Visible FROM Shoppingcart WHERE (Items_ID = '$Item_ID' AND Customer_ID = '$cusID' AND Visible = 'True')");
If($q = mysqli_fetch_array($sqlitem, MYSQLI_ASSOC)){
	$num = $q['Quantity'];
	$quantity = $num + $quantity;
	$price = $Price * $quantity;
	$updateItem = "UPDATE Shoppingcart SET Quantity = '$quantity', Price = '$price' WHERE (Customer_ID = '$cusID' AND Items_ID = '$Item_ID' AND Visible = 'True')";
	if ($conn->query($updateItem) === TRUE) {
	    header("Location: prenumerera.php");
	} else {
	    echo "Error: " . $updateItem . "<br>" . $conn->error;
	}
} else {
	$addItem = "INSERT INTO Shoppingcart (Price, Customer_ID, Items_ID, Quantity) VALUES ('$Price', '$cusID' , '$Item_ID', '$quantity')";
	if ($conn->query($addItem) === TRUE) {
	    header("Location: prenumerera.php");
	} else {
	    echo "Error: " . $addItem . "<br>" . $conn->error;
	}
}

$conn->close();

// Skicka Shoppingcart_ID till varukorg.php???
//<input type="hidden" name="id" value="<?php echo $r['ID']:
	
?> 





