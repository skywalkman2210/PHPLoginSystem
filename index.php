<?php
	session_start();
	
	$servername = $_SERVER['SERVER_ADDR'];
	if ($servername == '::1')
	{
		$servername = "127.0.0.1";
	}
	
	//59,116,116 color: rgb(228,209,17
	
	if (isset($_GET['bgred']))
	{
		$red = $_GET['bgred'];
	}
	else
	{
		$red = 59;
	}
	
	if (isset($_GET['bggreen']))
	{
		$green = $_GET['bggreen'];
	}
	else
	{
		$green = 116;
	}
	
	if (isset($_GET['bgblue']))
	{
		$blue = $_GET['bgblue'];
	}
	else
	{
		$blue = 116;
	}
	
	if (isset($_GET['fgred']))
	{
		$red2 = $_GET['fgred'];
	}
	else
	{
		$red2 = 228;
	}
	
	if (isset($_GET['fggreen']))
	{
		$green2 = $_GET['fggreen'];
	}
	else
	{
		$green2 = 209;
	}
	
	if (isset($_GET['fgblue']))
	{
		$blue2 = $_GET['fgblue'];
	}
	else
	{
		$blue2 = 17;
	}
?>

<!DOCTYPE HTML>
<html>
  <head>
    <title>Allen Hazlett | Home</title>
	<link href="css/index.css" rel="stylesheet" type="text/css"/>
	<style type="text/css">
		a {
			color: rgb(<?php echo $red2 ?>,<?php echo $green2 ?>,<?php echo $blue2 ?>);
		}
	</style>
	<script src="script/index.js"></script>
  </head>
  
  <body style="background: rgb(<?= $red ?>,<?= $green ?>,<?= $blue ?>); color: rgb(<?= $red2 ?>,<?= $green2 ?>,<?= $blue2 ?>);">
  <div id='top'>
	<?php
		$showdata = 1;
	
		if(isset($_GET['nologin']))
		{
			if ($_GET['nologin'] == 1)
			{
				$showdata = 0;
			}
		}
		
		if ($showdata == 1)
		{
			if (isset($_SESSION['username']))
			{
				echo "
					<div id='login'>
						You are logged in as: ". $_SESSION['username'] ."<br/><br/><br/>
						<a href='http://". $servername ."/user/main.php'>User Central</a><br/><br/>
						";
						
						if ($_SESSION['username'] == "admin")
						{
							echo "<a href='http://". $servername ."/admin/adminConsole.php'>Administrative Console</a><br/><br/>";
						}
						
				echo "
						<form action='user/logout.php'>
							<input type='submit' value='Logout'/>
						<form>
					</div>
				";
			}
			else
			{
				echo "
				<div id='login'>
					<form action='http://".$servername."/user/login.php' method='POST'>
						Username: <input type='text' name='username'/><br/><br/>
						Password: &nbsp;<input type='password' name='password'/><br/><br/>
						<input type='submit' value='Submit'/>
					</form>
						
					<br/>
					<a href='user/createuser.php'>Sign Up</a>
					<br/><br/>
					<a href='password/resetpassword.php?reset=1'>Forgot password?</a>
				</div>
				<br/>
				";
			}
		}
	?>
	
    <h1 class='welcome'>Hello!</h1>
	</div>
	
	<center>
	<div id="postContainer">
		<?php
			
			$username = 'root';
			$password = '';
			$dbname = 'hazlett';
			$count = 0;
			
			$conn = new mysqli($servername, $username, $password, $dbname);
				
			if ($conn->connect_error)
			{
				die("Connection failed: " . $conn->connect_error);
			}
		
			$sql = "SELECT * FROM posts GROUP BY id DESC";
			$result = $conn->query($sql);
			
			
			while($row = $result->fetch_assoc()) 
			{
				$count++;
				
				echo "
					<table class='post'>
						<tr>
							<th>Posted by: <span id='poster'>". $row['postedby'] . "</span></th>
						</tr>
						<tr>
							<td>".$row['content']."</td>
						</tr>
					</table>
					<br/><br/>
				
				";
			}
			
			$conn->close();
		?>
	</div>
	</center>
		
  </body>
</html>