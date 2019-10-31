<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Login</title>
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

		<div id="auth-login-container">
			<form method="post" action="login.php" id="login-form">

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

				<div id="login-button-container">
					<button type="button" id="login-button">LOGIN</button>
				</div>

			</form>
		</div>

		<div id="image-container">
			<img src="/../assets/images/image.jpg" />
		</div>

		<script src="/../assets/js/app.js"></script>
	</body>
</html>