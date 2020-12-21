<?php
	session_start();
	
	if( array_key_exists( 'submitted', $_POST ) )
	{
		include('db.php');
		
		if( !empty( $_POST['uname'] ) )
		{
			$un = $_POST['uname'];
		}
		else
		{
			$msgs = urlencode('Please fill missing fields');
			header("location: user_login.php?msgs=$msgs");
			exit();
		}
		
		if( !empty( $_POST['pass'] ) )
		{
			$p = $_POST['pass'];
		}
		else
		{
			$msgs = urlencode("Please fill missing fields");
			header("location: user_login.php?msgs=$msgs");
			exit();
		}
		
		$q = "SELECT user_id, email 
			  FROM user
			  WHERE
			  (username='$un' AND password=SHA1('$p'))";
			  
		$r = mysql_query( $q );
		
		if( mysql_num_rows( $r ) > 0 )
		{
			list( $user_id, $email ) = mysql_fetch_row( $r );
			
			$_SESSION['user_id'] = $user_id;
			$_SESSION['email'] = $email;
			
			header("location: test.php");
		}
		else
		{
			$msgs = urlencode("either your username or password is incorrect");
			header("location: user_login.php?msgs=$msgs");
		}
		
	}
?>