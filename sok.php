<!DOCTYPE html>
<html lang="sv">
<head>
	<title>TechyBox Startsida</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="techybox.css">	
</head>
<body>
	<header>
			<?php include('header.php');?>
	</header>
	<?php
	$servername = "utbweb.its.ltu.se";
	$username = "rebmat-5";
	$password = "D0018E";
	$database = "rebmat5db";

	//Create connection to database
	$conn = mysqli_connect($servername, $username,$password, $database);

	//Check connection
	if (!$conn) {
		die("Connection failed: " .mysqli_connect_error());
	}

	//echo "Connection successfully";

	?>

	<div class="contain-all">

		<?php
			if (isset($_GET['search'])) {
				$search = $_GET['search'];
				$sql = "SELECT * FROM Items WHERE Name = '$search'";
				$res = mysqli_query($conn, $sql);

				$count = mysqli_num_rows($res);
			  
				// If result matched $Mejl and $Password, table row must be 1 row
				if($count == 1) {
			
					echo "Vi hittade ", $count, " vara för sökordet: ", $search, "!";
					echo "<br>";
					echo "<br>";
				 
				 
				}else {
					echo "Vi hittade inga varor för sökordet: ", $search, "!";
				}
			}
		?>

		<?php while($row = mysqli_fetch_assoc($res)){ ?>
			<div class="items">
				<fieldset>
					<form action="addtocart.php?id=<?php echo $row['ID']; ?>&price=<?php echo $row['Price']; ?>" method='GET'>
					<input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
					<input type="hidden" name="price" value="<?php echo $row['Price']; ?>">
					<img src="<?php echo $row['Image']; ?>" alt="<?php echo $row['Name'] ?>" height="250" width="250">
					<h3><?php echo $row['Name']; echo '<br>' ; echo $row['Price'];echo " Kr"; ?></h3>
					<input type="submit" value="Lägg till i varukorgen" id="addtocart_button" onclick="varuPopup()">
					</form>
				</fieldset>
				<script>
					// When the user clicks on submit, open the popup alert box
					function varuPopup() {
					     alert("Din vara har lagts till i varukorgen!");
					}
				</script>
			</div>
		<?php } ?>

	</div> <!-- End .containAll -->
	<footer>
		<?php include('footer.php');?>
	</footer>
</body>