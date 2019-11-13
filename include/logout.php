<?php

	session_start();

	require __DIR__ . '/../vendor/autoload.php';

	use App\database\User;

	if( isset($_SESSION['user']) && !empty($_SESSION['user']) ){

		$user = new User();
		$userData = $_SESSION['user'];
		$id = $userData->userID;
		$user->logout($id);

		session_unset();
		session_destroy();
		header('Location: /include/login.php');
	}

?>