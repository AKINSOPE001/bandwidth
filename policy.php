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
	
	checkLogin();
	
	if(isset($_POST['submitted']))
	{
		$error = array();
		
		if(!empty($_POST['bnd']))
		{
			if(is_numeric($_POST['bnd']))
			{
				$bnd = $_POST['bnd'];
			}
			else
			{
				$error[] = "please enter an integer";
			}
		}
		else
		{
			$error[] = "please enter a size";
		}
		
		if(empty($error))
		{
			$q = "UPDATE bandwidth_policy
				  SET policy = $bnd";
			$r = mysql_query($q);
			
			if($r)
			{
				echo '<p class="succ">policy updated sucessfully</p>';
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
		top: 20%;
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
		top: 20%;
		left:42%;
	}
	
</style>

<body>
	<div><h3>Update policy</h3></div>
	<form action="policy.php" method="post">
    	<label>enter size:</label><br /><input type="text" name="bnd" />
        <input type="submit" name="submit" value="update" />
        <input type="hidden" name="submitted" value="TRUE" />
    </form>
</body>
</html>