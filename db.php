<?php
	$db = mysql_connect("localhost", "root", "") or die(mysql_error());
	
	mysql_select_db("bandwidth", $db) or die(mysql_error($db));
?>