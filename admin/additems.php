<!DOCTYPE html>
<html lang="sv">
<head>
	<meta charset="utf-8">
	<title>TechyBox Admin Welcome</title>
	<link rel="stylesheet" type="text/css" href="techybox.css">
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

	?>
	<!-- Admin sessions -->
	<?php //include ('admin_session.php'); ?>
</head>
<body>
	<header>
		<?php include('adminheader.php'); ?>
	</header>

	<div class="contain-all">
		<h1 id="logout-button"><a href="logout.php">Logga ut</a></h1>
		<h2>Lägg till en ny vara</h2>

		<!-- fält där man kan lägga till nya items -->
		<div class="second_container">
			<form method="post">
				<table>
					<tr>
						<td><label for="name">Namn:</label></td>
						<td><input type="text" name="name" pattern="{4,40}" required id="name"></td>
					</tr>
					<tr>
						<td><label for="price">Pris:</label></td>
						<td><input type="text" name="price" pattern=".{1,5}" required id="price"></td>
					</tr>
					<tr>
						<td><label for="image">Bild:</label></td>
						<td><input type="text" name="image" required id="image"></td>
					</tr>
				</table>
				<br>
				<input type="submit" name="add" value="Lägg till"> 
			</form>
		</div> <!-- End #alterItem -->

		<?php
			if($_SERVER["REQUEST_METHOD"] == "POST") {

			    // To get secure inputs, prevents Cross-Side Scripting (XSS)
				function test_input($dataIn) {
					$dataIn = trim($dataIn);
					$dataIn = stripslashes($dataIn);
				 	$dataIn = htmlspecialchars($dataIn);
				  	return $dataIn;
				}

			    // mysqli_real_escape prevents mySQL Injections. 
				$Name = mysqli_real_escape_string($conn, test_input($_POST['name']));
				$Price = mysqli_real_escape_string($conn, test_input($_POST['price'])); 
				$Image = mysqli_real_escape_string($conn, test_input($_POST['image']));

				// Update values in customer table
				$sql = "INSERT INTO Items (Name, Price, Image) VALUES ('$Name', '$Price', '$Image')";

				if ($conn->query($sql) === TRUE) {
				  	//$message = "Varan har lagts till";
				    //echo "<script>function varuPopup(){alert($message);}</script>";
				    ?>
				    <script>
						// When the user clicks on submit, open the popup alert box
						function varuPopup() {
						     alert("Varan har lagts till!");
						}
					</script>
				<?php } else {
				    echo "Error: " . $sql . "<br>" . $conn->error;
				}

			$conn->close();
			}
		?>
	</div> <!-- End contain-all-->
</body>