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

		<?php require('navigation.php'); ?>

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
					<div id="container-for-password-label-login">
						<label for="password">Password:</label>
					</div>
					<div id="show-password-container-login">
						<input type="checkbox" name="show-password-login" id="show-password-login" />Show Password
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
					<a href="forgot-password.php">Forgot password?</a>
				</div>

				<input type="hidden" name="login-user" value="login-user" />

			</form>
		</div>

		<div id="image-container">
			<img src="" />
		</div>

		<?php if( !isset($_SESSION['cookie-accepted']) ): ?>
			<div id="cookie-consent-container" style="display: none;">
				<p>This site uses cookies to collect and store information. Cookies are necessary for our site functioning. To learn more about cookies please read our <a href="cookie-consent.php">Cookie Policy</a>.
				<button id="cookie-consent-button">Accept</button></p>
			</div>
		<?php endif; ?>

		<script src="/../assets/js/login.js"></script>
		<script src="/../assets/js/slider.js"></script>
		<script src="/../assets/js/cookie-consent.js"></script>
	</body>
</html>