<?php
	session_start();
	
	$servername = $_SERVER['SERVER_ADDR'];
	if ($servername == '::1')
	{
		$servername = "127.0.0.1";
	}

	$username = 'root';
	$password = '';
	$dbname = 'hazlett';
	$user = $_GET["user"];
	$userPassword = $_GET["sha"];

	//Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	//Check connection
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}

	$passCreate = "UPDATE users SET password='". $userPassword ."' WHERE username='".$user."'";
	$result = $conn->query($passCreate);

	if (isset($_SESSION['username']))
	{
		session_unset();
		session_destroy();
	}
	
	echo "<span id='updated'>Password updated!</span><br/><br/>";
	echo "<a href='http://".$servername."/'>Go Home</a>";

	$conn->close();
?>

<head>
	<link href="http://<?php echo $servername ?>/css/other.css" rel="stylesheet" type="text/css" />
</head>