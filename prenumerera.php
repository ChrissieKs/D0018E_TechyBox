<!DOCTYPE html>
<html lang="sv">
<head>
	<meta charset="utf-8">
	<title>TechyBox Varor</title>
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

	//Create connection
	$conn = mysqli_connect($servername, $username,$password, "rebmat5db");

	//Check connection
	if (!$conn) {
		die("Connection failed: " .mysqli_connect_error());
	}

	//echo "Connection successfully";
	?>
	<?php
		$sql = "SELECT * FROM Items";
		$res = mysqli_query($conn, $sql);
	?>

	<div class="contain-all">
		<?php
		while($r = mysqli_fetch_assoc($res)){ ?>
		<div class="items">
		<fieldset>
			<form action="addtocart.php?id=<?php echo $r['ID']; ?>&price=<?php echo $r['Price']; ?>" method='GET'>
			<input type="hidden" name="id" value="<?php echo $r['ID']; ?>">
			<input type="hidden" name="price" value="<?php echo $r['Price']; ?>">
			<img src="<?php echo $r['Image']; ?>" alt="<?php echo $r['Name'] ?>" height="250" width="250">
			<h3><?php echo $r['Name']; echo '<br>' ; echo $r['Price'];echo " Kr"; ?></h3>
			<input type="submit" value="Lägg till i varukorgen" id="addtocart_button" onclick="varuPopup()">

			</form>
		</fieldset>
		</div><!-- End items -->
		<script>
			// When the user clicks on submit, open the popup alert box
			function varuPopup() {
			     alert("Din vara har lagts till i varukorgen!");
			}
		</script>
		<?php } ?>
	</div> <!-- End .contain-all -->
	<footer>
		<?php include('footer.php');?>
	</footer>
</body>