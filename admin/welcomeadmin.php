<!DOCTYPE html>
<html lang="sv">
<body>
	<!-- sökfält där man skriver in customer id och får all info om customer --> 

	<fieldset class= "inlogg">

	<div id="loggain">
		<br>
		<form method="POST">
		<label for="Email">Email:</label>
		<input type="text" name="Mejl" pattern=".{9,40}" required autofocus id="Email"><br>
		<label for="Password">Lösenord:</label>
		<!-- (?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,} -->
		<!-- title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" -->
		<input type="password" name="Password" pattern=".{8,40}" required id="Password"><br>
		<input type="submit" name="inlogg" value="Logga in">
		</form>

	</div>
	
	</fieldset>
<!--
	<fieldset class= "inlogg">

	<div id="loggain">
		<br>
		<form method="POST">
		<label for="Email">Email:</label>
		<input type="text" name="Mejl" pattern=".{9,40}" required autofocus id="Email"><br>
		<label for="Password">Lösenord:</label>

		<input type="password" name="Password" pattern=".{8,40}" required id="Password"><br>
		<input type="submit" name="inlogg" value="Logga in">
		</form>

	</div>
	
	</fieldset>

	<fieldset class= "inlogg">

	<div id="loggain">
		<br>
		<form method="POST">
		<label for="Email">Email:</label>
		<input type="text" name="Mejl" pattern=".{9,40}" required autofocus id="Email"><br>
		<label for="Password">Lösenord:</label>
		<input type="password" name="Password" pattern=".{8,40}" required id="Password"><br>
		<input type="submit" name="inlogg" value="Logga in">
		</form>

	</div>
	
	</fieldset>
-->

</body>