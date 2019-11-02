<?php

namespace App\database;

use App\database\Connection;

class User extends Connection
{
	public function create($name, $email, $password)
	{
		$sql = "INSERT INTO users(name, email, password, created) VALUES(?, ?, ?, ?)";

		$currentDateTime = date('Y-m-d H:i:s');

		$password = password_hash($password, PASSWORD_DEFAULT);

		$record = $this->connect->prepare($sql);

		$record->bind_param("ssss", $name, $email, $password, $currentDateTime);

		$record->execute();

		$record->close();

		$this->connect->close();

		$_SESSION['name'] = $name;

		$_SESSION['email'] = $email;

		$_SESSION['message'] = 'You have successfully registered.';

		header('Location: /index.php');
	}

	public function login($email, $password)
	{
		$sql = "SELECT * FROM users WHERE email=?";

		$record = $this->connect->prepare($sql);

		$record->bind_param("s", $email);

		$record->execute();

		$details = $record->get_result();

		$userName = '';
		$userEmail = '';
		$userPassword = '';

		if( $details->num_rows === 1 ){
			while($row = mysqli_fetch_object($details)){
				$userName = $row->name;
				$userEmail = $row->email;
				$userPassword = $row->password;
			}
		} else {
			return array('email', 'Please enter correct email address');
		}

		if( password_verify($password, $userPassword) ){
			$_SESSION['name'] = $userName;
			$_SESSION['email'] = $userEmail;
			header('Location: /index.php');
		} else {
			return array('password', 'Password is not correct');
		}
	}
}

?>