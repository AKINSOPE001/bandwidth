<?php
session_start();
	
	
	function checkLogin()
	{
		if( !isset( $_SESSION['id'] ) )
		{
			header("location: index.php");
		}
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
<style>
	body {
		background-color: #4e2c13;
	}

	#box {
		border:5px solid #FCF;
		width:200px;
		padding:10px;
		-moz-border-radius: 5px;
		-moz-box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.5);
		background-color:#ece9e6;
		font-family:Verdana, Geneva, sans-serif;
		font-variant:small-caps;
		position:absolute;
		top: 58%;
		font-weight:bold;
		left:43%;
	}
	
	form input[type="text"], form input[type="password"] {
		margin-bottom: 1em;
		padding:5px;
		
	}
	
	form input[type="submit"] {
		padding:5px;
		text-transform:capitalize;
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
		background: url("views.png") 44% 50% no-repeat;
	}

	div img {
		position: absolute;
		left: 37%;
		top: 20%;
	}
	
	.err {
		background-color:#F30;
		padding: 6px;
		text-align:center;
		font-family:Verdana, Geneva, sans-serif;
		color:#fff;
		width:200px;
		position:absolute;
		top: 20%;
		left:44%;
	}
	#box a {
		display: block;
		padding: 10px;
		color: #121212;
	}

	#box a:hover {color: red;}
</style>

</head>

<body>
	<div><h3>admin panel</h3></div>

	<div><img src="band.png" /></div>

    <div id="box"><a href="register_user.php">resgister user</a>
    <a href="generate.php">generate password</a>
    <a href="admin_logout.php">logout</a></div>
</body>
</html>