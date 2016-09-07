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
	$user = $_POST["username"];
	$userPassword = sha1($_POST["password"]);
	
	//Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	//Check connection
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}
	
	$sql = "SELECT * FROM users WHERE username = '".$user."'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc()) 
		{
			if ($row["password"] == null)
			{
				echo "You have entered your new password!<br/><br/>";
				
				echo "<a href='http://". $servername ."/'>Login</a>";
				
				$passCreate = "UPDATE users SET password='". $userPassword ."' WHERE username='".$user."'";
				
				mysqli_query($conn, $passCreate);
			}
			else
			{
				if ($row["password"] == $userPassword)
				{
					$_SESSION["username"] = $user;
					$_SESSION["passwod"] = $userPassword;
					
					if (isset($row["first"]))
					{
						$_SESSION["first"] = $row["first"];
					}
					
					if (isset($row["last"]))
					{
						$_SESSION["last"] = $row["last"];
					}
					
					Header("Location: http://". $servername."/user/main.php");
				}
				else
				{
					echo "<span id='wrongpass'>You entered the wrong password!</span><br/><br/>";
					echo "<a href='resetpassword.php?reset=1&user=". $user ."'>Reset your password</a><br/>";
					echo "<a href='http://".$servername."/'>Go home</a>";
				}
			}
		}
	}
	else
	{
		if ($user == "")
		{
			$user = "{undefined}";
		}
		
		echo "Sorry could not find user: " . $user;
		echo "<br/><br/><a href='http://".$servername."/'>Go Back</a>";
	}

	$conn->close();
?>

<script>
function submit()
{
	document.forms['poster'].submit();
}
</script>

<head>
	<link href="http://<?php echo $servername ?>/css/other.css" rel="stylesheet" type="text/css" />
</head>