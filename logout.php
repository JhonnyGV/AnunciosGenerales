<?php require_once("includes/functions.php"); ?>
<?php
	// Closing a session.
	
	//1. Finding session
	session_start();
	
	//2. unset all session variables
	$_SESSTION = array();
	
	//3. destroy session cookie
	if(!isset($_COOKIE[session_name()])) {
		setcookie(session_name, '', time()-42000, '/');
	}
	
	//4. destroy session
	session_destroy();
	
	redirect_to("login.php?logout=1");
?>