<!DOCTYPE html>
<html lang="sv">
<head>
	<meta charset="utf-8">
	<title>TechyBox Information</title>
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
	
	<div class="contain-all">
	
	<h1>Om</h1>
	<p>TechyBox är ett projekt för unga som är intresserade av teknik</p>
	<p>Syftet med webbplatsen är att intressera fler unga för teknik samt att för en liten peng kunna få en överraskning i brevlådan en gång i månaden. Det blir som en periodisk julafton med spännande innehåll på boxarna samt med ett vackert motiv.</p>
	<hr>
	<h1>Vanliga Frågor</h1>
	<br>
	<h2>Hur beställer jag en box?</h2>
	<p>Kontakta vår kundtjänst på 07XXXXXXXX så kan de hjälpa dig.</p>
	<h2>Varför har jag inte fått en orderbekräftelse?</h2>
	<p>Kontakta vår kundtjänst på 07XXXXXXXX så kan de hjälpa dig.</p>
	<h2>Det går inte att logga in! Vad ska jag göra?</h2>
	<p>Kontakta vår kundtjänst på 07XXXXXXXX så kan de hjälpa dig.</p>
	<h2>Hur ändrar jag mina uppgifter?</h2>
	<p>För att ändra dina uppgifter så kan man kontakta vår kundtjänst på 07XXXXXXXX så kan de hjälpa dig.</p>
	<hr>
	<h1>Användarvillkor</h1>
	<p>Användarvillkoren läser ingen och därför står det inte mycket här än en text utan någon mening. Det är bara slöseri med tid att läsa vidare. Texten blir inte bättre av att fortsätta läsa, inte heller meningsfullare. </p>

	</div> <!-- End .contain-all -->
	<footer>
		<?php include('footer.php');?>
	</footer>
</body>