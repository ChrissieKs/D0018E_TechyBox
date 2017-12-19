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


	// Get item row
	$sqlitem = mysqli_query($conn, "SELECT Quantity FROM Shoppingcart WHERE (Items_ID = '$Item_ID' AND Customer_ID = '$cusID')");
	$q = mysqli_fetch_array($sqlitem, MYSQLI_ASSOC);

	// För att lägga till items till databasen.
	if($q['Quantity'] == 0) {
		$addItem = "INSERT INTO Shoppingcart (Price, Customer_ID, Items_ID, Quantity)
	VALUES ('$Price', '$cusID' , '$Item_ID', 1)";
		if ($conn->query($addItem) === TRUE) {
		    header("Location: varukorg.php");
		} else {
		    echo "Error: " . $addItem . "<br>" . $conn->error;
		}
	} else {
		$num = $q['Quantity'];
		$num = $num + 1;
		$price = $Price * $num;
		$updateItem = "UPDATE Shoppingcart SET Quantity = '$num', Price = '$price' WHERE (Customer_ID = '$cusID' AND Items_ID = '$Item_ID')";
		if ($conn->query($updateItem) === TRUE) {
		    header("Location: varukorg.php");
		} else {
		    echo "Error: " . $updateItem . "<br>" . $conn->error;
		}
	}


	$conn->close();

	
?> 





