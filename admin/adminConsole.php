<?php
	session_start();
	
	if (isset($_SESSION["username"]))
	{
		$servername = $_SERVER['SERVER_ADDR'];
		if ($servername == '::1')
		{
			$servername = "127.0.0.1";
		}
		
		$time = Date('h:ia');
		
		$body = "
			<body>
				<a href='http://".$servername."/'>Home</a><br/>
				<a href='http://".$servername."/user/main.php'>User Central</a><br/>
				<a href='http://".$servername."/user/logout.php'>Logout</a><br/><br/>
				
				Execute MySQL Commands: <br/><br/>
				
				<form method='POST' id='sqlform'>
				<textarea name='sql' form='sqlform' style='height:150px;'></textarea>
				<input type='hidden' name='_sql'><br/><br/>
				<input type='submit' value='Execute SQL'>
				</form>
				
				<script>
					document.writeln('<br/> Client Time:');
					document.write(timeGetter());
					document.write('<br/> Server Time: ');
					document.write('".$time."');
				</script>
			</body>
		";

		$head = "
			<head>
				<title>Administrative Console</title>
				<link href='../css/adminConsole.css' type='text/css' rel='styleheet' />
				<script src='../script/time.js' type='text/javascript'></script>
			</head>
		";
		
		$html = "<!DOCTYPE html><html>".$head.$body."</html>";

		if (isset($_GET['admin']))
		{
			if ($_GET['admin'] == 1)
			{
				$servername = $_SERVER['SERVER_ADDR'];
				$username = 'root';
				$password = '';
				$dbname = 'hazlett';
				
				$conn = new mysqli($servername, $username, $password, $dbname);
					
				if ($conn->connect_error)
				{
					die("Connection failed: " . $conn->connect_error);
				}
				
				if (isset($_POST['sql']))
				{
					if (isset($_POST['_sql']))
					{
						$sql = $_POST['sql'];
						$result = $conn->query($sql);
					}
				}
				
				$sql = "SELECT * FROM users";
				$result = $conn->query($sql);
				
				echo "<div id='tablesContainer'><div id='usersContainer'><h1>Users</h1><table id='users'>".
				     "<th>userid</th>".
					 "<th>first</th>".
					 "<th>last</th>".
					 "<th>username</th>".
					 "<th>password</th>";
				
				while($row = $result->fetch_assoc()) 
				{
					echo "<tr>";
					
					if ($row["password"] == "")
					{
						$passSet = "Not Set";
					}
					else
					{
						$passSet = "Set";
					}
					
					echo "<td>". $row["userid"] . 
						 "</td><td>" . $row["first"] . 
						 "</td><td>" . $row["last"] . 
						 "</td><td>" . $row["username"] . 
						 "</td><td>" . $passSet .
						 "</td>";
						
					echo "</tr>";
				}
					
				echo "</table></div>";
				
				
				
				
				$sql = "SELECT * FROM posts";
				$result = $conn->query($sql);
				
				echo "<div id='postsContainer'><h1>Posts</h1><table id='posts'>".
					 "<th>Posted By</th>".
					 "<th>Content</th>";
				
				while($row = $result->fetch_assoc()) 
				{
					echo "<tr>";
					echo "<td>". $row["postedby"] . 
						 "</td><td>" . $row["content"] . 
						 "</td>";
						
					echo "</tr>";
				}
					
				echo "</table></div></div>";
				$conn->close();
				
				echo $html;
				echo "<br/><br/>";
				
				echo "<br/><br/>Password Generator:<br/>";
				echo "<form method='post' id='passGen'>";
				echo "<input type='password' name='passGen'/><br/>";
				echo "<input type='hidden' name='admin' value='1'/><br/>";
				echo "<input type='submit' value='Generate Password'><br/><br/>";
				echo "</form>";
				
				if (isset($_POST['passGen']))
				{
					echo sha1($_POST['passGen']);
				}
				
			}
			else
			{
				echo "You do not have sufficent rights to gain access to this page!";
			}
		}
		else
		{
			echo "You do not have sufficent rights to gain access to this page!";
		}
	}
	else
	{
		echo "You do not have sufficent rights to gain access to this page!";
	}
?>

<head>
	<link href="../css/adminConsole.css" rel="stylesheet" type="text/css"/>
	<script src="../script/time.js" type="text/javascript"></script>
</head>