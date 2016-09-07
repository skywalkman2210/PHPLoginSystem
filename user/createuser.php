<?php
	session_start();
	
	$servername = $_SERVER['SERVER_ADDR'];
	if ($servername == '::1')
	{
		$servername = "127.0.0.1";
	}
	
	$passMatch = 0;

	if (isset($_GET['passMatch']))
	{
		$passMatch = $_GET['passMatch'];
	}

	if (isset($_POST['nuser']))
	{
		$newUser = $_POST['nuser'];
		$newPass = sha1($_POST['npass']);
		$conPass = sha1($_POST['cpass']);
		$newFirst = $_POST['nfirst'];
		$newLast = $_POST['nlast'];
		
		if ($newPass != $conPass)
		{
			echo "Your passwords did not match!";
			//header("Location: http://".$servername."/user/createuser.php?passMatch=1");
		}
		else
		{
			$username = 'root';
			$password = '';
			$dbname = 'hazlett';
			$conn = new mysqli($servername, $username, $password, $dbname);
			if ($conn->connect_error)
			{
				die("Connection failed: " . $conn->connect_error);
			}
			
			$sql = "SELECT username FROM users";
			$result = $conn->query($sql);
			
			while($row = $result->fetch_assoc()) 
			{
				$exists = false;
				
				if ($row['username'] == $newUser)
				{
					$exists = true;
				}
				
			}
			
			if (!$exists)
			{				
				$sql = "INSERT INTO users (first, last, username, password) VALUES('".$newFirst."','".$newLast."','".$newUser."','".$newPass."')";
				$result = $conn->query($sql);
				
				echo "You have successfully created a new user.<br/>";
				echo "<a href='http://".$servername."/'>Login</a>";
			}
			else
			{
				echo "That username is already taken!";
				echo "<br/><br/> <a href='createuser.php'>Try again</a>";
			}
		}
	}
	else
	{
		echo "To login, you must provide all of the information.<br/><br/>";
		echo "<form method='post'>
			  First Name: <br/><input type='text' name='nfirst'/><br/>
			  <br/>Last Name: <br/><input type='text' name='nlast'/><br/>
			  <br/>User Name: <br/><input type='text' name='nuser'/><br/>
			  <br/>Password: <br/><input type='password' name='npass'/><br/>
			  <br/>Confirm Password: <br/><input type='password' name='cpass'/><br/><br/>
			  <input type='submit' value='Submit'/><br/>
			  </form>
			  <a href='http://".$servername."/'>Nevermind</a>
			  <br/><br/><br/>
			 ";
		if ($passMatch != 0)
		{
			echo "****Your Passwords did not match!****";
		}
	}
?>

<head>
	<link href="../css/other.css" rel="stylesheet" type="text/css" />
</head>