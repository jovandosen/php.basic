<?php

	session_start();

	require __DIR__ . '/../vendor/autoload.php';

	use App\database\User;

	if( isset($_SESSION['name']) && !empty($_SESSION['name']) && isset($_SESSION['email']) && !empty($_SESSION['email']) ){

		if( isset($_SESSION['ID']) && !empty($_SESSION['ID']) ){
			$user = new User();
			$user->logout($_SESSION['ID']);
		}

		session_unset();
		session_destroy();
		header('Location: /include/login.php');
	}

?>