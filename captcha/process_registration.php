<?php
	session_start();
		
	if (!isset($_POST['captcha'])) {
		header("Location: register.php?ERR=NO_CAPTCHA"); 
		exit;
	}
	
	if ($_SESSION['_captcha_'] === strtolower($_POST['captcha'])) {
		// Registration Success
		header("Location: welcome.php"); 
	} else {
		header("Location: register.php?ERR=WRONG_CAPTCHA"); 
		exit;
	}
?>
