<?php 

	session_start(); 

	require __DIR__ . '/../../vendor/autoload.php';

	use App\validation\ValidateProfileData;
	use App\database\User;

	if( isset($_SESSION['name']) && !empty($_SESSION['name']) && isset($_SESSION['email']) && !empty($_SESSION['email']) ){
		$userName = $_SESSION['name'];
		$userEmail = $_SESSION['email'];
	} else {
		header('Location: /../login.php');
	}

	if( isset($_POST['profile-form-field']) && !empty($_POST['profile-form-field']) ){
		
		$name = $_POST['profile-name'];
		$email = $_POST['profile-email'];

		$validateData = new ValidateProfileData($name, $email);

		$nameError = $validateData->validateName();
		$emailError = $validateData->validateEmail();

		if( $nameError == false && $emailError == false ){

			$user = new User();

			$id = $user->findUserByEmail($_SESSION['email']);

			$user->update($name, $email, $id);

			$userName = $_SESSION['name'];
			$userEmail = $_SESSION['email'];
			$message = $_SESSION['user-updated'];

		}

	}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Profile</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" type="image/png" href="/../../assets/images/favicon.jpg">
		<link rel="stylesheet" type="text/css" href="/../../assets/css/app.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	</head>
	<body>

		<div id="homepage-navigation">
			<ul>
				<li><a href="#">Link 1</a></li>
				<li><a href="#">Link 2</a></li>
				<li><a href="#">Link 3</a></li>
				<li><a href="#">Link 4</a></li>
				<li><a href="#">Link 5</a></li>
				<li id="user-info">
					<a href="#"><?php echo $userName; ?></a>
					<ul id="user-info-details" style="display: none;">
						<li><a href="/include/profile/profile.php">Profile</a></li>
						<li><a href="#">Settings</a></li>
						<li><a href="/include/logout.php">Logout</a></li>
					</ul>
				</li>
			</ul>
		</div>

		<form method="post" action="profile.php" id="profile-form">
			<div id="profile-content">
				<div id="profile-content-details">

					<div>
						<label for="profile-name">Name:</label>
						<input type="text" name="profile-name" id="profile-name" value="<?php echo $userName; ?>" autocomplete="off" 	class="<?php echo (isset($nameError) && !empty($nameError)) ? 'add-error-style' : ''; ?>" />
						<input type="hidden" name="profile-name-hidden" value="<?php echo $userName; ?>" id="profile-name-hidden" />
						<span id="profile-name-error">
							<?php echo (isset($nameError) && !empty($nameError)) ? $nameError : ''; ?>
						</span>
					</div>

					<div id="profile-email-container">
						<label for="profile-email">Email:</label>
						<input type="text" name="profile-email" id="profile-email" value="<?php echo $userEmail; ?>" autocomplete="off"
							class="<?php echo (isset($emailError) && !empty($emailError)) ? 'add-error-style' : ''; ?>" />
						<input type="hidden" name="profile-email-hidden" value="<?php echo $userEmail; ?>" id="profile-email-hidden" />
						<span id="profile-email-error">
							<?php echo (isset($emailError) && !empty($emailError)) ? $emailError : ''; ?>
						</span>
					</div>

					<div id="profile-update-button-container">
						<button type="button" id="update-profile-data" style="display: none;">UPDATE</button>
					</div>

					<input type="hidden" name="profile-form-field" value="submited" id="profile-form-field" />

				</div>
			</div>
		</form>

		<div id="user-flash-message" style="display: none;">
			<p><?php echo (isset($message) && !empty($message)) ? $message : ''; ?></p>
		</div>

		<script src="/assets/js/app.js"></script>
		<script src="/assets/js/profile.js"></script>
	</body>
</html>