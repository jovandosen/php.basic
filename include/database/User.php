<?php

namespace App\database;

use App\database\Connection;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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

		//

		// send mail
		$mail = new PHPMailer(true);

		try {

			$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
		    $mail->isSMTP();                                            // Send using SMTP
		    $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
		    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
		    $mail->Username   = 'jovandosen994@gmail.com';              // SMTP username
		    $mail->Password   = 'gospodari';                            // SMTP password
		    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
		    $mail->Port       = 587;

		    $mail->setFrom('jovandosen994@gmail.com', 'Jovan Dosen');
    		$mail->addAddress($email, $name);

    		$mail->isHTML(true);                                         // Set email format to HTML
    		$mail->Subject = 'Welcome';
    		$mail->Body = 'You have successfully registered.';

    		$mail->send();

		} catch (Exception $e){
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}

		//

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