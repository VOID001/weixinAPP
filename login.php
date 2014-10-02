<?php
	session_start();
	if($_POST['username']=='admin' && $_POST['password']=='neupioneer@204')
	{
		//echo "OK";
		$_SESSION['username']="admin";
	}
	header("Location:home.php");

?>
