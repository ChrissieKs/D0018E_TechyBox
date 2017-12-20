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
		<h2>Sök efter en vara</h2>
		<!-- ruta för att söka efter item som man sedan kan ändra/tabort -->
		<div class="second_container">

			<br>
			
			<fieldset class= "adminsokitems">
				<label for="sokitems">Varunummer: </label>
				<form method="post" id="sokform"><input type="text" name="hittaID" placeholder="Sök.." id="sokitems"></form>
				</br>
				<!--<input type="submit" name="sok" value="Sök"> -->
			</fieldset>
		</div>
		

		<?php

			if(isset($_POST['hittaID'])) {
				$search = $_POST['hittaID'];
				$sql = "SELECT * FROM Items WHERE ID = '$search'";
				$res = mysqli_query($conn, $sql);

				$count = mysqli_num_rows($res);
			  
				// If item is found
				if($count == 1) {

					$getItem = mysqli_query($conn, "SELECT * FROM Items WHERE ID = $search");
					$item_row = mysqli_fetch_assoc($getItem); ?>
					<table class="item-tabell">
						<?php while($row = mysqli_fetch_assoc($res)){ ?>
							<tr align="left">
								<th><p>Varunummer </p></th>
								<th><p>Namn </p></th>
								<th><p>Pris </p></th>
								<th><p>Bildadress </p></th>
								<th><p>Synlighet </p></th>
								<th><p>Visa/dölj varan </p></th>
								<th><p>Ändra varuinformation </p></th>
							</tr>
							<tr>
								<td><p><?php echo $item_row['ID']; echo '<br>' ; ?> </p></td>
								<td><p><?php echo $item_row['Name']; echo '<br>' ; ?> </p></td>
								<td><p><?php echo $item_row['Price']; echo '<br>' ; ?> </p></td>
								<td><p><?php echo $item_row['Image']; echo '<br>' ; ?> </p></td>
								<td><p><?php echo $item_row['Visible']; echo '<br>' ; ?> </p></td>
								<td>
									<form action="deleteRow.php?<?php echo $search; ?>" method='GET'>
									<input type="hidden" name="id" value="<?php echo $search; ?>">	
									<input type="submit" value="Ändra synlighet" id="delete_button" onclick="del()">
									</form>
								</td>
								<td>
									<form action="updateitems.php?<?php echo $search; ?>" method='GET'>
									<input type="hidden" name="id" value="<?php echo $search; ?>">	
									<input type="submit" value="Ändra" id="change_button">
									</form>
								</td>
								</tr>
						
					<?php } ?>
				 	</table>
						<script>
							// When the user clicks on submit, open the popup alert box
							function del() {
							     alert("Synligheten har ändrats!");
							}
						</script>
				<?php }else {
					echo "Vi hittade inga varor med ID ", $search, "!";
				}

			}
		?>
	</div><!-- End contain-all -->
</body>