<?php
session_start();
include 'db.php';
$e = $_SESSION['email'];


			$q = "UPDATE user SET status='not_gen' WHERE email='$e'";
			
			$r = mysql_query($q) or die(mysql_error());
		$_SESSION = array(); // Clear the variables.
		session_destroy(); // Destroy the session itself.
		setcookie ('PHPSESSID', '', time()-3600,'/', '', 0, 0); // Destroy the cookie.
		header("location: user_login.php");

?>