<?php

	session_start();

	require __DIR__ . '/../vendor/autoload.php';

	use App\validation\ValidateForgotPassword;
	use App\database\User;

	if( isset($_POST['forgot-password-check']) && !empty($_POST['forgot-password-check']) ){

		$email = $_POST['email'];
		$allEmails = $_POST['all-emails'];

		$allEmails = explode(",", $allEmails);

		$forgotPasswordValidation = new ValidateForgotPassword($email);

		$emailError = $forgotPasswordValidation->validateEmail();

		if( $emailError === false ){

			$emailCount = 0;

			foreach( $allEmails as $key => $value ){
				if( $email == $value ){
					$emailCount++;
				}
			}

			if( $emailCount === 0 ){
				$emailError = 'Email does not exist.';
			}

		}

		if( $emailError === false && $emailCount === 1 ){
			
			$user = new User();

			$id = $user->findUserByEmail($email);

			$userData = $user->findUserById($id);

			$user->sendForgotPasswordMail($userData->name, $userData->email);

		}

	}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Forgot Password</title>
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

		<div id="forgot-password-form-container">
			<form method="post" action="forgot-password.php" id="forgot-password-form">

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

				<div id="forgot-password-button-container">
					<button type="button" id="forgot-password-button">SEND</button>
				</div>

				<input type="hidden" name="forgot-password-check" value="valid" />

				<input type="hidden" name="all-emails" value="" id="all-emails" />

			</form>

			<?php if( isset($_SESSION['mail']) && !empty($_SESSION['mail']) ): ?>
				<div id="mail-sent-container">
					<p><?php echo 'Mail sent successfully.'; ?></p>
				</div>
			<?php endif; ?>

		</div>

		<div id="image-container">
			<img src="" />
		</div>

		<script src="/../assets/js/forgot-password.js"></script>
	</body>
</html>