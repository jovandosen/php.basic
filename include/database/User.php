<?php

namespace App\database;

use App\database\Connection;
use App\mail\SendWelcomeMail;
use App\mail\ForgotPasswordMail;

class User extends Connection
{
	public function create($name, $email, $password)
	{
		$sql = "INSERT INTO users(name, email, password, created, logged) VALUES(?, ?, ?, ?, ?)";

		$currentDateTime = date('Y-m-d H:i:s');

		$password = password_hash($password, PASSWORD_DEFAULT);

		$record = $this->connect->prepare($sql);

		$loggedValue = 1;

		$record->bind_param("ssssi", $name, $email, $password, $currentDateTime, $loggedValue);

		$record->execute();

		$_SESSION['name'] = $name;

		$_SESSION['email'] = $email;

		$_SESSION['message'] = 'You have successfully registered.';

		$mail = new SendWelcomeMail($name, $email);

		// find user by email and return user id
		$id = $this->findUserByEmail($email);

		$_SESSION['ID'] = $id;

		$record->close();

		$this->connect->close();

		header('Location: /index.php');
	}

	public function login($email, $password)
	{
		$sql = "SELECT * FROM users WHERE email=?";

		$record = $this->connect->prepare($sql);

		$record->bind_param("s", $email);

		$record->execute();

		$details = $record->get_result();

		$userID = '';
		$userName = '';
		$userEmail = '';
		$userPassword = '';

		if( $details->num_rows === 1 ){
			while($row = mysqli_fetch_object($details)){
				$userID = $row->userID;
				$userName = $row->name;
				$userEmail = $row->email;
				$userPassword = $row->password;
			}
		} else {
			return array('email', 'Please enter correct email address');
		}

		if( password_verify($password, $userPassword) ){
			$_SESSION['ID'] = $userID;
			$_SESSION['name'] = $userName;
			$_SESSION['email'] = $userEmail;

			$sqlData = "UPDATE users SET logged=1 WHERE userID=?";

			$recordData = $this->connect->prepare($sqlData);

			$recordData->bind_param("i", $userID);

			$recordData->execute();

			header('Location: /index.php');
		} else {
			return array('password', 'Password is not correct');
		}
	}

	public function logout($id)
	{
		$sqlInfo = "UPDATE users SET logged=0 WHERE userID=?";

		$recordInfo = $this->connect->prepare($sqlInfo);

		$recordInfo->bind_param("i", $id);

		$recordInfo->execute();
	}

	public function findUserByEmail($email)
	{
		$sqlDetail = "SELECT * FROM users WHERE email=?";

		$recordDetails = $this->connect->prepare($sqlDetail);

		$recordDetails->bind_param("s", $email);

		$recordDetails->execute();

		$data = $recordDetails->get_result();

		$id = '';

		if( $data->num_rows === 1 ){
			while( $row = mysqli_fetch_object($data) ){
				$id = $row->userID;
			}
		}

		return $id;
	}

	public function findUserById($id)
	{
		$sql = "SELECT * FROM users WHERE userID=?";

		$record = $this->connect->prepare($sql);

		$record->bind_param("i", $id);

		$record->execute();

		$details = $record->get_result();

		$user = '';

		if( $details->num_rows === 1 ){
			while( $row = mysqli_fetch_object($details) ){
				$user = $row;
			}
		}

		return $user;
	}

	public function sendForgotPasswordMail($name, $email)
	{
		$forgotPasswordMail = new ForgotPasswordMail($name, $email);
	}

	public function update($name, $email, $id)
	{
		$sql = "UPDATE users SET name=?, email=? WHERE userID=?";

		$record = $this->connect->prepare($sql);

		$record->bind_param("ssi", $name, $email, $id);

		$record->execute();

		$record->close();

		$this->connect->close();

		$_SESSION['name'] = $name;

		$_SESSION['email'] = $email;

		$_SESSION['user-updated'] = 'Data successfully updated.';
	}

	public function upload($id, $avatar)
	{
		$sql = "UPDATE users SET avatar=? WHERE userID=?";

		$record = $this->connect->prepare($sql);

		$record->bind_param("si", $avatar, $id);

		$record->execute();

		$record->close();

		$this->connect->close();
	}
}

?>