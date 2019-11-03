<?php

	session_start();

	require __DIR__ . '/../vendor/autoload.php';

	use App\validation\ValidateRegistration;
	use App\database\User;
	
	if( isset($_POST['register-user']) ){

		$name = $_POST['name'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$allEmails = $_POST['all-emails'];

		$allEmails = explode(",", $allEmails);

		$validReg = new ValidateRegistration($name, $email, $password);

		$nameError = $validReg->validateName();
		$emailError = $validReg->validateEmail();
		$passwordError = $validReg->validatePassword();

		foreach($allEmails as $key => $value){
			if( $email == $value ){
				$emailError = 'Email already exists.';
			}
		}

		if( $nameError == false && $emailError == false && $passwordError == false ){
			$user = new User();
			$user->create($name, $email, $password);
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
					<div>
						<label for="name">Name:</label>
					</div>
					<input type="text" name="name" id="name" autocomplete="off" minlength="3" maxlength="15" placeholder="Enter name..." 
						class="<?php echo (isset($nameError) && !empty($nameError)) ? 'error-wrapper' : ''; ?>" 
						value="<?php echo (isset($name) && !empty($name)) ? $name : ''; ?>" />
					<span id="name-error-container">
						<?php echo (isset($nameError) && !empty($nameError)) ? $nameError : ''; ?>
					</span>
				</div>

				<div id="email-container">
					<div>
						<label for="email">Email:</label>
					</div>
					<input type="text" name="email" id="email" autocomplete="off" placeholder="Enter email address..." 
						class="<?php echo (isset($emailError) && !empty($emailError)) ? 'error-wrapper' : ''; ?>" 
						value="<?php echo (isset($email) && !empty($email)) ? $email : ''; ?>" />
					<span id="email-error-container">
						<?php echo (isset($emailError) && !empty($emailError)) ? $emailError : ''; ?>
					</span>
				</div>

				<div id="password-container">
					<div id="container-for-password-label-register">
						<label for="password">Password:</label>
					</div>
					<div id="show-password-container-register">
						<input type="checkbox" name="show-password-register" id="show-password-register" />Show Password
					</div>
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

				<input type="hidden" name="all-emails" value="" id="all-emails" />

			</form>
		</div>

		<div id="image-container">
			<img src="/../assets/images/image.jpg" />
		</div>

		<script src="/../assets/js/register.js"></script>
	</body>
</html>