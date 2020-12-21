<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
<style>
	body {
		background-color: #4e2c13;
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
		top: 54%;
		font-weight:bold;
		left:32%;
	}
	
	form input[type="text"], form input[type="password"] {
		margin-bottom: 1em;
		padding:5px;
		
	}
	
	form input[type="text"], form input[type="password"] {
		margin-bottom: 1em;
		padding:5px;
		width: 300px
	}
	
	div {
		width: 100%;
	}

	div img {
		position: absolute;
		left: 37%;
		top: 20%;
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
</style>

</head>

<body>
    <div><h3>admin panel</h3></div>
    <?php
		if( !empty( $_GET['msgs'] ) )
		{
			echo '<p class="err">'.$_GET['msgs'].'</p>';
		}
	?>

	<div><img src="band.png" /></div>

	<form method="post" action="auth.php">
    	<label>username:</label>
        <input type="text" name="uname" /><br/>
        
        <label>password:</label>
        <input type="password" name="pass" /><br/>
        
        <div id="sub" align="center"><input type="submit" name="submitted" value="login" /></div>
    </form>
</body>
</html>