<?php
		$admin_check = $_SESSION['login_admin'];
		   
		$ad_ses_sql = mysqli_query($conn,"SELECT Email FROM Admin WHERE Email = '$admin_check' ");
		// To get the row where the users email is stored.
		$_admin_row = mysqli_fetch_array($ad_ses_sql,MYSQLI_ASSOC);

		$login_session = $row['Email'];

		// If the session login_user is not set, relocate to index to log in.
		if(!isset($_SESSION['login_admin'])){
		  header("location: index.php");
		}
	?> 