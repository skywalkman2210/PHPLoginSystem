<?php
	$servername = $_SERVER['SERVER_ADDR'];
	if ($servername == '::1')
	{
		$servername = "127.0.0.1";
	}
	
	if ((isset($_GET['user'])) ||
	    (isset($_POST['user'])) )
	{
		if (isset($_POST['user']))
		{
			$user = $_POST['user'];
			$pass = sha1($_POST['pw']);
			
			header("Location: http://".$servername."/password/resetpassword.php?reset=1&user=".$user."&pw=".$pass);
			exit();
		}
		else
		{
			echo "Please enter what you would like your new password to be:<br/>";
			
			$html = "<form method='POST'>";
			$html .= "<input type ='password' name='pw'> &nbsp;";
			$html .= "<input type='hidden' name='user' value='". $_GET['user']."'>";
			$html .= "<input type='submit'></form>";
			
			echo $html;
		}
	}
	else { echo "ERROR: Invalid Call"; }
?>

<head>
	<link href="http://<?php echo $servername ?>/css/other.css" rel="stylesheet" type="text/css" />
</head>