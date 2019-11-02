<?php

	session_start();

	require __DIR__ . '/../vendor/autoload.php';

	use App\validation\ValidateLogin;
	use App\database\User;

	if( isset($_POST['login-user']) ){

		$email = $_POST['email'];
		$password = $_POST['password'];

		$validLogin = new ValidateLogin($email, $password);

		$emailError = $validLogin->validateEmail();
		$passwordError = $validLogin->validatePassword();

		if( $emailError == false && $passwordError == false ){

			$user = new User();
			$data = $user->login($email, $password);

			if($data[0] == 'email'){
				$emailError = $data[1];
			}

			if($data[0] == 'password'){
				$passwordError = $data[1];
			}

		}

	}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Login</title>
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

		<div id="auth-login-container">
			<form method="post" action="login.php" id="login-form">

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
					<div>
						<label for="password">Password:</label>
					</div>
					<input type="password" name="password" id="password" minlength="3" maxlength="15" placeholder="Enter password..." 
						class="<?php echo (isset($passwordError) && !empty($passwordError)) ? 'error-wrapper' : ''; ?>" />
					<span id="password-error-container">
						<?php echo (isset($passwordError) && !empty($passwordError)) ? $passwordError : ''; ?>
					</span>
				</div>

				<div id="login-button-container">
					<button type="button" id="login-button">LOGIN</button>
				</div>

				<div id="register-link-container">
					<a href="register.php">Register</a>
				</div>

				<div id="forgot-password-link-container">
					<a href="#">Forgot password?</a>
				</div>

				<input type="hidden" name="login-user" value="login-user" />

			</form>
		</div>

		<div id="image-container">
			<img src="/../assets/images/image.jpg" />
		</div>

		<script src="/../assets/js/login.js"></script>
	</body>
</html>