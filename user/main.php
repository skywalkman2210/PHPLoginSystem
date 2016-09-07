<?php
	session_start();
	
	$servername = $_SERVER['SERVER_ADDR'];
	if ($servername == '::1')
	{
		$servername = "127.0.0.1";
	}
	
	if (isset($_SESSION["username"]))
	{
		$user = $_SESSION["username"];
		$first = $_SESSION["first"];
		
		if (isset($_SESSION['last']))
		{
			$last = $_SESSION["last"];
			echo "Welcome back " . $first . " " . $last . "!<br/><br/>";
		}
		else
		{
			echo "<span id='wrongpass'>Welcome back " . $first . "!</span><br/><br/>";
		}
		
		echo "<form action='../post/createpost.php' method='post' name='poster'><input type='hidden' name='user' value='" . $user . "'/><a href='#' onclick='submit();'>Create new post</a></form>";
		echo "<br/><br/>";
		echo "<a href='../password/resetpassword.php?reset=1&user=". $user ."'>Click here to reset your password</a><br/>";
		echo "<a href='../password/changepassword.php?user=".$user."'>Change Password</a><br/>";
		echo "<a href='http://".$servername."/'>Go Home</a><br/>";
		echo "<a href='logout.php'>Logout</a>";
		

		if ($user == 'admin')
		{
			echo "<br/>";
			echo "<a href='http://".$servername."/admin/adminConsole.php?admin=1'>Administrative Console</a>";
		}
	}
?>

<head>
	<link href="http://<?php echo $servername ?>/css/other.css" rel="stylesheet" type="text/css" />
	<script src="http://<?php echo $servername ?>/script/main.js"></script>
</head>