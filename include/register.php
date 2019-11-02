<?php

	session_start();
	
	if( isset($_POST['register-user']) ){

		require 'validation/ValidateRegistration.php';
		require 'Record.php';

		$name = $_POST['name'];
		$email = $_POST['email'];
		$password = $_POST['password'];

		$validReg = new ValidateRegistration($name, $email, $password);

		$nameError = $validReg->validateName();
		$emailError = $validReg->validateEmail();
		$passwordError = $validReg->validatePassword();

		if( $nameError == false && $emailError == false && $passwordError == false ){
			$newRecord = new Record($name, $email, $password);
			$newRecord->connect();
			$newRecord->insert();
		}
 
	}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Register</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" type="image/png" href="/../assets/images/favicon.jpg">
		<link rel="stylesheet" type="text/css" href="/../assets/css/app.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	</head>
	<body>

		<div id="auth-navigation">
			<ul>
				<li><a href="register.php">Register</a></li>
				<li><a href="login.php">Login</a></li>
			</ul>
		</div>

		<div id="auth-register-container">
			<form method="post" action="register.php" id="register-form">

				<div id="name-container">
					<label for="name">Name:</label>
					<input type="text" name="name" id="name" autocomplete="off" minlength="3" maxlength="15" placeholder="Enter name..." 
						class="<?php echo (isset($nameError) && !empty($nameError)) ? 'error-wrapper' : ''; ?>" />
					<span id="name-error-container">
						<?php echo (isset($nameError) && !empty($nameError)) ? $nameError : ''; ?>
					</span>
				</div>

				<div id="email-container">
					<label for="email">Email:</label>
					<input type="text" name="email" id="email" autocomplete="off" placeholder="Enter email address..." 
						class="<?php echo (isset($emailError) && !empty($emailError)) ? 'error-wrapper' : ''; ?>" />
					<span id="email-error-container">
						<?php echo (isset($emailError) && !empty($emailError)) ? $emailError : ''; ?>
					</span>
				</div>

				<div id="password-container">
					<label for="password">Password:</label>
					<input type="password" name="password" id="password" minlength="3" maxlength="15" placeholder="Enter password..." 
						class="<?php echo (isset($passwordError) && !empty($passwordError)) ? 'error-wrapper' : ''; ?>" />
					<span id="password-error-container">
						<?php echo (isset($passwordError) && !empty($passwordError)) ? $passwordError : ''; ?>	
					</span>
				</div>

				<div id="register-button-container">
					<button type="button" id="register-button">REGISTER</button>
				</div>

				<div id="login-link-container">
					<a href="login.php">Login</a>
				</div>

				<input type="hidden" name="register-user" value="register-user" />

			</form>
		</div>

		<div id="image-container">
			<img src="/../assets/images/image.jpg" />
		</div>

		<script src="/../assets/js/register.js"></script>
	</body>
</html>