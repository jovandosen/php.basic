<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Register</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="/../assets/css/app.css">
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
					<span id="name-error-container">test</span>
				</div>

				<div id="email-container">
					<label for="email">Email:</label>
					<input type="text" name="email" id="email" autocomplete="off" />
					<span id="email-error-container">test</span>
				</div>

				<div id="password-container">
					<label for="password">Password:</label>
					<input type="password" name="password" id="password" />
					<span id="password-error-container">test</span>
				</div>

				<div id="register-button-container">
					<button type="button" id="register-button">REGISTER</button>
				</div>

			</form>
		</div>

		<div id="image-container">
			<img src="/../assets/images/image.jpg" />
		</div>

		<script src="/../assets/js/app.js"></script>
	</body>
</html>