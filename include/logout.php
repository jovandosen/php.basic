<?php

	session_start();

	if( isset($_SESSION['name']) && !empty($_SESSION['name']) && isset($_SESSION['email']) && !empty($_SESSION['email']) ){
		session_unset();
		session_destroy();
		header('Location: /include/login.php');
	}

?>