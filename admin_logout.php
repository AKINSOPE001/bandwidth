<?php
session_start();

$e = $_SESSION['email'];


		$_SESSION = array(); // Clear the variables.
		session_destroy(); // Destroy the session itself.
		setcookie ('PHPSESSID', '', time()-3600,'/', '', 0, 0); // Destroy the cookie.
		header("location: admin.php");

?>