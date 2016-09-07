<?php
	session_start();
	session_unset();
	session_destroy();
	
	$servername = $_SERVER['SERVER_ADDR'];
	if ($servername == '::1')
	{
		$servername = "127.0.0.1";
	}
	
	Header("Location: http://". $servername ."/")
?>