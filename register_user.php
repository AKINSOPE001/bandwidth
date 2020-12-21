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
		$appID = 'APP/ID/'.mt_rand(1111, 9999);
		
		// check first name
		if(!empty($_POST['fname']))
		{
			if(!is_numeric($_POST['fname']))
			{
				$fn = mysql_real_escape_string($_POST['fname']);
			}
			else
			{
				$error[] = 'Please enter a valid first name';
			}
		}
		else
		{
			$error[] = 'Please enter a first name';
		}
		
		// check last name
		if(!empty($_POST['lname']))
		{
			if(!is_numeric($_POST['lname']))
			{
				$ln = mysql_real_escape_string($_POST['lname']);
			}
			else
			{
				$error[] = 'Please enter a valid last name';
			}
		}
		else
		{
			$error[] = 'Please enter a last name';
		}
		
		// check username
		if(!empty($_POST['uname']))
		{
			if(!is_numeric($_POST['uname']))
			{
				$un = mysql_real_escape_string($_POST['uname']);
			}
			else
			{
				$error[] = 'Please enter a valid username';
			}
		}
		else
		{
			$error[] = 'Please enter a username';
		}
		
		// check password
		if( !empty($_POST['pass']) )
		{
			if( $_POST['pass'] == $_POST['cpass'] )
			{
				$p = mysql_real_escape_string($_POST['pass']);
			}
			else
			{
				$error[] = 'Your passwords do not match';
			}
		}
		else
		{
			$error[] = 'please enter a paassword';
		}

		// check password
		if( !empty($_POST['email']) )
		{
			$e = mysql_real_escape_string($_POST['email']);

			$q = "SELECT * FROM user WHERE email='$e'";
			
			$r = mysql_query($q) or die(mysql_error());
			
			if(mysql_num_rows($r) > 0)
			{
				$error[] = "Email address already used.";
			}
		}
		else
		{
			$error[] = 'please enter your email';
		}
		
		// if everything is OK
		if( empty($error) )
		{
			$q = "INSERT INTO user
				 (first_name, last_name, username, password, email)
				 VALUES('$fn', '$ln', '$un', SHA1('$p'), '$e')";
			
			$r = mysql_query($q) or die(mysql_error());
			
			if($r)
			{
				echo '<p class="succ">Registration successfull
				<a href="actions.php">back</a></p>';
				
			}
		}
		else
		{
			echo '<p class="err">';	
			foreach($error as $msg)
			{
				
				echo $msg . '</br>';
			}
			echo '</p>';
			
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
	
	label {
		margin-bottom:10px;
	}
	
	form input[type="text"], form input[type="password"] {
		margin-bottom: 1em;
		padding:5px;
		
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
		top: 18%;
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
		top: 100%;
		left:42%;
	}
	
</style>
<div><h3>register user</h3></div>
<form method="post" action="register_user.php" id="reg">
	<label>First name</label><input type="text" name="fname" /><br />
    <label>Last name</label><input type="text" name="lname" /><br />
    <label>Username</label><input type="text" name="uname" /><br />
    <label>Password</label><input type="password" name="pass" /><br />
    <label>Confirm Password</label><input type="password" name="cpass" /><br />
    <label>Email</label><input type="text" name="email" /><br />
    <input type="submit" name="submit" value="register" />
    <input type="hidden" name="submitted" value="TRUE" />
</form>

</body>
</html>