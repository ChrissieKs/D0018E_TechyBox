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

		session_start();
	?>

	<?php

		// username and password sent from login form
		if($_SERVER["REQUEST_METHOD"] == "POST") {

		    // To get secure inputs, prevents Cross-Side Scripting (XSS)
			function test_input($dataIn) {
			  $dataIn = trim($dataIn);
			  $dataIn = stripslashes($dataIn);
			  $dataIn = htmlspecialchars($dataIn);
			  return $dataIn;
			}

		    // mysqli_real_escape prevents mySQL Injections. 
			$Mejl = mysqli_real_escape_string($conn, test_input($_POST['Mejl']));
			$Password = mysqli_real_escape_string($conn, test_input($_POST['Password'])); 
			$sql = "SELECT ID FROM Customer WHERE Email = '$Mejl' and Password = '$Password'";
			$result = mysqli_query($conn,$sql);
			$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
			$active = $row['active'];
			$count = mysqli_num_rows($result);
		  
			// If result matched $Mejl and $Password, table row must be 1 row
			if($count == 1) {
			 session_start();
			 $_SESSION['login_user'] = $Mejl;
			 
			 header("location: welcome.php");
			}else {
			 echo "Your email or Password is invalid";
			}
		}

	?>

	<!-- JavaScript functions that hides and show elements by their ID -->
	<script> 
		function flikloggain() {
			document.getElementById('loggain').hidden = false;
			document.getElementById('skapaID').hidden = true;}

		function flikskapaID() {
			document.getElementById('skapaID').hidden = false;
			document.getElementById('loggain').hidden = true;}
	</script>

	<div class="contain-all">
		<fieldset class="img">
			<!-- Picture to the left. Jag har fått friheten att använda bilden från pexels.com. -->
			<img src="https://static.pexels.com/photos/190930/pexels-photo-190930.jpeg" alt="Black Box" height="290" width="500">
		</fieldset>

		<fieldset class= "inlogg">
			<!-- När man klickar kallas Js funktionen som gömmer ett element och visar ett annat. -->
			<button class="buttonskapaID" onclick='flikskapaID()'>Skapa Användare</button>

			<button class="buttonloggain" onclick='flikloggain()' autofocus>Logga In</button>

			<div id="loggain">
				<form method="POST">
					<table>
						<tr>
							<td><label for="Email">Email:</label></td>
							<td><input type="text" name="Mejl" pattern=".{9,40}" required id="loginEmail"></td>
						</tr>
						<tr>
							<td><label for="Password">Lösenord:</label></td>
							<!-- (?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,} -->
							<!-- title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" -->
							<td><input type="password" name="Password" pattern=".{8,40}" required id="loginPassword"></td>
						</tr>
					</table>
					<br>
					<input type="submit" name="inlogg" value="Logga in">
				</form>
				
			</div> <!-- End #loggain -->

			<div id="skapaID" hidden>
				<form method="post" action="action_skapaID.php">
					<table>
						<tr>
							<td><label for="Namn">Namn:</label></td>
							<td><input type="text" name="Name" pattern="{5,40}" required placeholder="Förnamn Efternamn" id="Namn">*</td>
						</tr>
						<tr>
							<td><label for="Email">Email:</label></td>
							<td><input type="text" name="Mejl" pattern=".{9,30}" required id="Email">*</td>
						</tr>
						<tr>
							<td><label for="Adress">Adress:</label></td>
							<td><input type="text" name="Address" pattern=".{12,40}" required id="Adress">*</td>
						</tr>
						<tr>
							<td><label for="telefon">Telefon:</label></td>
							<td><input type="number" name="Phone_number" required id="telefon" placeholder="07XXXXXXXX">*</td>
						</tr>
						<tr>
							<td><label for="Password">Lösenord:</label></td>
							<td><input type="password" name="Password" pattern=".{8,40}" required id="Password">*</td>
						</tr>
					</table>
					<br>
					<input type="submit" name="skapa" value="Spara" onclick="varuPopup()"> 
				</form>
			</div> <!-- End #skapaID -->
		</fieldset>
		<script>
			// When the user clicks on submit, open the popup alert box
			function varuPopup() {
			     alert("Din användare är nu skapad! Testa att logga in!");
			}
		</script>

	<div id="Contain-help">
		<fieldset>
			<p>Välkommen till TechyBox!</p>
			<p>Varje månad får du välja mellan fyra nya produkter som skickas i en vacker box!</p>
			<p>Kom igång med att tre enkla steg:</p>
			<ol>
				<li>Kika in bland våra <a href="http://utbweb.its.ltu.se/~rebmat-5/prenumerera.php">varor.</a></li>
				<li>Skapa en användare eller logga in.</li>
				<li>Nu ska du kunna köpa varor!</li>
			</ol>
		</fieldset>
	</div> <!-- End #contain-help -->
	</div> <!-- End .containAll -->
	<footer>
		<?php include('footer.php');?>
	</footer>
</body>