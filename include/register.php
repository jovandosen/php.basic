<?php
	
	if( isset($_POST['register-user']) ){

		$name = $_POST['name'];
		$email = $_POST['email'];
		$password = $_POST['password'];

		var_dump($name);
		var_dump($email);
		var_dump($password);
 
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
					<input type="text" name="name" id="name" autocomplete="off" />
					<span id="name-error-container"></span>
				</div>

				<div id="email-container">
					<label for="email">Email:</label>
					<input type="text" name="email" id="email" autocomplete="off" />
					<span id="email-error-container"></span>
				</div>

				<div id="password-container">
					<label for="password">Password:</label>
					<input type="password" name="password" id="password" />
					<span id="password-error-container"></span>
				</div>

				<div id="register-button-container">
					<button type="button" id="register-button">REGISTER</button>
				</div>

				<input type="hidden" name="register-user" value="register-user" />

			</form>
		</div>

		<div id="image-container">
			<img src="/../assets/images/image.jpg" />
		</div>

		<script src="/../assets/js/app.js"></script>
	</body>
</html>