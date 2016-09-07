<?php
	session_start();

	$postAuthor = $_SESSION['username'];
	$servername = $_SERVER['SERVER_ADDR'];
	if ($servername == '::1')
	{
		$servername = "127.0.0.1";
	}

	if (isset($_POST['content']))
	{
		if ($_POST['content'] != '')
		{
			$username = 'root';
			$password = '';
			$dbname = 'hazlett';
			
			$postContent = $_POST['content'];
			
			$conn = new mysqli($servername, $username, $password, $dbname);
			
			if ($conn->connect_error)
			{
				die("Connection failed: " . $conn->connect_error);
			}
			
			$sql = "INSERT INTO posts (postedby, content) VALUES ( '". $postAuthor ."', '". $postContent ."')";
			$result = $conn->query($sql);
			
			$conn->close();
		}
	}
	
?>

<!DOCTYPE html>
<html>
<head>
	<title>Create a new post</title>
	<link href="http://<?php echo $servername ?>/css/other.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<form method="post" id='postform'>
		Enter the post content<br/>
		<textarea name='content' form='postform' class='postbox' style='height:100px;'></textarea><br/><br/>
		<input type='hidden' name='postedRecent' value='1'/>
		<input type='hidden' name='user' value="<?= $postAuthor ?>"/>
		<input type="submit" value="Create Post" /><br/><br/>
	</form>
	
	<?php 
		if ($postAuthor == 'admin')
		{
			echo "You are Administrator.<br/><br/>";
		}
		
		if(isset($_POST['postedRecent']))
		{
			echo "You created a new post!";
		}
	?>
	
	<a href="http://<?=$servername?>/">Go Home!</a>
</body>
</html>