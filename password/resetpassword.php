<?php
	$servername = $_SERVER['SERVER_ADDR'];
	if ($servername == '::1')
	{
		$servername = "127.0.0.1";
	}
	
	if (isset($_GET['reset']))
	{	
		$reset = $_GET['reset'];
		$passList = array("BlueGrapes2210", "CockMunch15", "AmericaOnLine55", "Skywalkman22_10");
		
		if ($reset == 1)
		{
			$randNum = rand(0,3);
			$resetPass = $passList[$randNum];
			
			if (isset($_GET['user']))
			{
				$username = $_GET['user'];
					
				if (!isset($_GET['pw']))
				{
					echo "Your new password will be: " . $resetPass;
					$shaPass = sha1($resetPass);
				}
				else
				{
					echo "Your new password will be: {custom}";
					$shaPass = $_GET['pw'];
				}
				
				echo "<br/><br/><a href='http://".$servername."/password/passwordupdated.php?sha=". $shaPass ."&user=".$username."'>Click here to set your new password!</a>";
				echo "<br/> or <br/>";
				echo "<a href='http://".$servername."/?logged=0'>Nevermind</a>";
			}
			else
			{
				$html = "Please enter your username: <br/>";
				$html .= "<form method='GET'>";
				$html .= "<input type ='text' name='user'><br/><br/>";
				$html .= "<input type='hidden' name='reset' value='1'>";
				$html .= "<input type='submit'></form>";
				
				echo $html;
			}
		}
		else {echo "Error: Invalid call";}
	}
	else
	{
		echo "ERROR: Invalid Call";
	}
?>

<head>
	<link href="../css/other.css" rel="stylesheet" type="text/css" />
</head>