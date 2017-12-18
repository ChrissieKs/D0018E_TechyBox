<!DOCTYPE html>
<html lang="sv">
<head>
	<meta charset="utf-8">
	<title>TechyBox Tidigare Boxar</title>
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

	echo "Connection successfully";

	?>

	<div class="contain-all">
		<?php
			include('session.php');

			// To get the Customer ID
			$sqlcus = mysqli_query($conn, "SELECT ID FROM Customer WHERE Email = '$user_check' ");
			$row = mysqli_fetch_array($sqlcus, MYSQLI_ASSOC);
			$cusID= $row['ID'];
		?>
		
		<h1>Recensioner</h1>

		<p>Upptäck produkter från tidigare boxar och låta andra få veta vad just du tycker om den.</p>
		<p>Omdömerna skickas in och granskas innan de läggs upp.</p>

		<?php
			// Skriver ut varor med fält för stjärnor och kommentarer
			$sqlitems = mysqli_query($conn, "SELECT * FROM Items");
			$counter = 1;

			// Calculating average rating
			while($items = mysqli_fetch_array($sqlitems, MYSQLI_ASSOC)) { 
				if($items['Visible'] == 'True') {
				$iID = $items['ID'];
				$sqlrev = mysqli_query($conn, "SELECT * FROM Review WHERE Items_ID = '$iID' ");
				$total = 0; 
				$rows = 0;
				while($r = mysqli_fetch_array($sqlrev, MYSQLI_ASSOC)) {
					$numStars = $r["Rating"];
					// Calculate average rating
					$total += $numStars;
					$rows++;
				}
				if($rows > 0) {
					$average = round(($total / $rows), 2);
					if($items['Rating'] != $average) {
						$updateAverge = mysqli_query($conn, "UPDATE Items SET Rating = '$average' WHERE ID = '$iID'");
					}
				} else {
					$average = "Inga recensioner";
				}

		?>
				<div class="items">
					<fieldset class = "contain-items">
						<form method='POST'>
							<input type="hidden" name="id" value="<?php echo $items['ID']; ?>">
							<img src="<?php echo $items['Image']; ?>" alt="<?php echo $items['Name'] ?>" height="250" width="250">
							<h3><?php echo $items['Name']; echo '<br>' ; echo $items['Price'];echo " Kr"; echo '<br>'; echo "Medelbetyg: $average"; ?></h3>
							<fieldset>
								<div class="stars">
									<input id="star<?php echo $counter;?>" type="radio" name="star" value="5">
									<label class="star star5" for="star<?php echo $counter;?>"></label>
									<?php $counter++;?>

									<input id="star<?php echo $counter;?>" type="radio" name="star" value="4">
									<label class="star star4" for="star<?php echo $counter;?>"></label>
									<?php $counter++;?>

									<input id="star<?php echo $counter;?>" type="radio" name="star" value="3">
									<label class="star star3" for="star<?php echo $counter;?>"></label>
									<?php $counter++;?>

									<input id="star<?php echo $counter;?>" type="radio" name="star" value="2">
									<label class="star star2" for="star<?php echo $counter;?>"></label>
									<?php $counter++;?>

									<input id="star<?php echo $counter;?>" type="radio" name="star" value="1">
									<label class="star star1" for="star<?php echo $counter;?>"></label>
									<?php $counter++;?>
								</div>
							</fieldset>
							<br>

							<textarea rows="5" cols="40" maxlength="250" name="comment" required></textarea>
							<br>

							<input type="submit" value="Skicka in" onclick="varuPopup()">
							<input type="reset" value="Reset">

							<script>
								// When the user clicks on submit, open the popup alert box
								function varuPopup() {
								     alert("Tack! Din kommentar har nu skickats in.");
								}
							</script>

						</form>
						<!-- Skriva ut recensioner -->
						
						<?php
						mysqli_data_seek($sqlrev, 0);
						while($r = mysqli_fetch_array($sqlrev, MYSQLI_ASSOC)) { ?>
							<table class="review">
								<?php 
									$cID = $r['Customer_ID'];
									$sqlname = mysqli_query($conn, "SELECT Name FROM Customer WHERE ID = '$cID' ");
									$name = mysqli_fetch_array($sqlname, MYSQLI_ASSOC);
									$countStars = $r["Rating"];
								?>
								<th>
									<p><?php echo $name["Name"]; ?></p>
								</th>
								<tr>
									<td><p>Betyg: </p></td>
									<td><p>
									<?php while($countStars > 0) { ?>
										★ 
										<?php $countStars--; ?>
									<?php } ?>
									</p></td>
								</tr>
								<tr>
									<td><p>Kommentar: </p></td>
									<td><p><?php echo $r["Comment"]; ?></p></td>
								</tr>
							</table>
							
						<?php } ?>
					</fieldset><!-- End contain-items -->
				</div><!-- End items -->
			<?php }} ?><!-- End if and while-loop -->

		<?php
			if($_SERVER["REQUEST_METHOD"] == "POST") {
				$comment = $_POST["comment"];
				$rating = $_POST["star"];
				$itemID = $_POST["id"];

				// Insert into table.
				$addReview = "INSERT INTO Review (Comment, Rating, Items_ID, Customer_ID) VALUES ('$comment', '$rating', '$itemID', '$cusID')";

				if ($conn->query($addReview) === TRUE) {
				    //echo "New record created successfully";
				} else {
				    echo "Error: " . $addReview . "<br>" . $conn->error;
				}
				$conn->close();
		 	} ?>
	</div><!-- end contain-all-->
	<footer>
		<?php include('footer.php');?>
	</footer>
</body>