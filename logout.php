<?php
session_start();
   // When a session is destroyed, the user is relocated to the start page.
session_destroy();
header("Location: index.php");
?>