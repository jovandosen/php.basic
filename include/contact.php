<?php

	session_start();

	require __DIR__ . '/../vendor/autoload.php';

	use App\validation\ValidateContactForm;
	use App\database\ContactModel;

	if( isset($_POST['contact-hidden-data']) && !empty($_POST['contact-hidden-data']) ){

		$name = $_POST['name'];
		$email = $_POST['email'];
		$message = $_POST['message'];

		$validContactFormData = new ValidateContactForm($name, $email, $message);

		$nameError = $validContactFormData->validateName();
		$emailError = $validContactFormData->validateEmail();
		$messageError = $validContactFormData->validateMessage();

		if( $nameError == false && $emailError == false && $messageError == false ){
			$contact = new ContactModel();
			$contact->create($name, $email, $message);
		}

	}

?>
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

				<div id="message-container">
					<div>
						<label for="message">Message:</label>
					</div>
					<textarea name="message" id="message" autocomplete="off" placeholder="Enter your message..." 
						class="<?php echo (isset($messageError) && !empty($messageError)) ? 'error-wrapper' : ''; ?>">
						<?php echo (isset($message) && !empty($message)) ? $message : ''; ?>		
					</textarea>
					<span id="message-error-container">
						<?php echo (isset($messageError) && !empty($messageError)) ? $messageError : ''; ?>
					</span>
				</div>

				<div id="contact-button-container">
					<button type="button" id="contact-button">SUBMIT</button>
				</div>

				<input type="hidden" name="contact-hidden-data" value="contact-hidden-data" />

				<?php if( isset($_SESSION['info']) && !empty($_SESSION['info']) ): ?>
					<input type="hidden" name="information" value="<?php echo $_SESSION['info']; ?>" id="info-message" />
					<?php session_unset($_SESSION['info']); ?>
				<?php else: ?>
					<input type="hidden" name="information" value="empty" id="info-message" />	
				<?php endif; ?>

			</form>
		</div>

		<div id="image-container">
			<img src="" />
			<div id="previous-button-container">
				<button id="previous">&#8249;</button>
			</div>
			<div id="next-button-container">
				<button id="next">&#8250;</button>
			</div>
			<input type="hidden" name="current-slider-image" id="current-slider-image" value="0" />
		</div>

		<script src="/../assets/js/contact.js"></script>
		<script src="/../assets/js/slider.js"></script>
	</body>
</html>