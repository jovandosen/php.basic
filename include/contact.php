<!DOCTYPE html>
<html>
	<head>
		<title>Contact</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" type="image/png" href="/../assets/images/favicon.jpg">
		<link rel="stylesheet" type="text/css" href="/../assets/css/app.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	</head>
	<body>

		<?php require('navigation.php'); ?>

		<div id="contact-form-container">
			<form method="post" action="contact.php" id="contact-form">
				
				<div id="name-container">
					<div>
						<label for="name">Name:</label>
					</div>
					<input type="text" name="name" id="name" autocomplete="off" minlength="3" maxlength="15" placeholder="Enter name..." />
					<span id="name-error-container"></span>
				</div>

				<div id="email-container">
					<div>
						<label for="email">Email:</label>
					</div>
					<input type="text" name="email" id="email" autocomplete="off" placeholder="Enter email address..." />
					<span id="email-error-container"></span>
				</div>

				<div id="message-container">
					<div>
						<label for="message">Message:</label>
					</div>
					<textarea name="message" id="message" autocomplete="off" placeholder="Enter your message..."></textarea>
					<span id="message-error-container"></span>
				</div>

				<div id="contact-button-container">
					<button type="button" id="contact-button">SUBMIT</button>
				</div>

				<input type="hidden" name="contact-hidden-data" value="contact-hidden-data" />

			</form>
		</div>

		<div id="image-container">
			<img src="" />
		</div>

		<script src="/../assets/js/contact.js"></script>
		<script src="/../assets/js/slider.js"></script>
	</body>
</html>