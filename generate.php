<?php
	session_start();
	
	include 'db.php';
	
	function checkLogin()
	{
		if( !isset( $_SESSION['id'] ) )
		{
			header("location: index.php");
		}
	}
	
	if( isset( $_POST['submitted'] ) )
	{
		$error = array();

		// check password
		if( !empty($_POST['email']) )
		{
			$e = mysql_real_escape_string($_POST['email']);

			$q = "SELECT * FROM user WHERE email='$e'";
			
			$r = mysql_query($q) or die(mysql_error());
			
			if(mysql_num_rows($r) < 1)
			{
				$error[] = "Email address does not exist.";
			}
print_r($e);
		}
		else
		{
			$error[] = 'please enter your email';
		}
		
		// if everything is OK
		if( empty($error) )
		{
			$key = mt_rand(1111, 9999);

			$q = "UPDATE user SET status='gen' WHERE email='$e'";
			
			$r = mysql_query($q) or die(mysql_error());

			$q1 = "UPDATE user SET file_key=$key WHERE email='$e'";
			
			$r1 = mysql_query($q1) or die(mysql_error());
			
			if($r)
			{
				echo '<p class="succ">KEY GENERATED:  ';
				echo '<strong>'.$key.'</strong><br/>';
				echo '<a href="actions.php">back</a></p>';
				
			}
		}
		else
		{
			
			foreach($error as $msg)
			{
				echo '<p class="err">'.$msg.'</p>';
			}

		}
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<style>
body {
		background-color: #4e2c13;
	}

	div {
		width: 100%;
	}
	
	div h3 {
		width:100%;
		text-align:center;
		font-family: "Tahoma";
		color: #ccc;
		font-weight: bold;
		text-transform: uppercase;
		padding: 10px 0;
		border-bottom:2px solid #341906;
	}
	
	form {
		border:2px solid #d55d04;
		width:480px;
		padding:10px;
		-moz-border-radius: 5px;
		-moz-box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.5);
		background-color:#ece9e6;
		font-family:Verdana, Geneva, sans-serif;
		font-variant:small-caps;
		position:absolute;
		top: 35%;
		font-weight:bold;
		left:32%;
	}
	
	form input[type="text"], form input[type="password"] {
		margin-bottom: 1em;
		padding:5px;
		width: 300px
	}
	
	label {
		margin-bottom:10px;
	}
	
	form input[type="submit"] {
		padding:5px;
		text-transform:capitalize;
	}
	
	.err {
		background-color:#f99a97;
		padding: 6px;
		text-align:center;
		font-family:Verdana, Geneva, sans-serif;
		color:#fff;
		width:500px;
		position:absolute;
		top: 10%;
		left:32%;
	}
	
	.succ {
		background-color:#9C3;
		padding: 6px;
		text-align:center;
		font-family:Verdana, Geneva, sans-serif;
		color:#fff;
		width:200px;
		position:absolute;
		top: 10%;
		left:42%;
	}
	
</style>
<div><h3>generate key</h3></div>
<form method="post" action="generate.php" id="reg">
    <label>Email</label><input type="text" name="email" /><br />
    <input type="submit" name="submit" value="generate" />
    <input type="hidden" name="submitted" value="TRUE" />
</form>

</body>
</html>