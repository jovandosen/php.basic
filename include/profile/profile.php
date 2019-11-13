<?php 

	session_start(); 

	require __DIR__ . '/../../vendor/autoload.php';

	use App\validation\ValidateProfileData;
	use App\validation\ValidateFile;
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

	if( isset($_POST['avatar-hidden-field']) && !empty($_POST['avatar-hidden-field']) ){
		
		$validateAvatar = new ValidateFile($_FILES);
		$uploadResult = $validateAvatar->validateAvatarData();
		
		if( $uploadResult[0] === true ){
			$userRecord = new User();
			$userId = $userRecord->findUserByEmail($_SESSION['email']);
			$userRecord->upload($userId, $uploadResult[1]);
			$uploadSuccessMessage = 'File uploaded successfully.';
		}

		if( $uploadResult[0] === false ){
			$uploadErrorMessage = $uploadResult[1];
		}

	}

	$userDetails = new User();
	$userID = $userDetails->findUserByEmail($_SESSION['email']);
	$userInfo = $userDetails->findUserById($userID);
	$avatar = $userInfo->avatar;

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

		<form method="post" action="profile.php" enctype="multipart/form-data" id="avatar-form">
			<div id="profile-avatar-container">
				<?php if(empty($avatar)): ?>
					<p>No avatar image provided</p>
					<?php else: ?>
					<img src="/assets/images/uploads/<?php echo $avatar; ?>" />	
				<?php endif; ?>
				<div id="avatar-file" class="<?php echo (!empty($avatar)) ? 'remove-style' : ''; ?>">
					<div id="avatar-file-box-one">
						<input type="file" name="avatar" id="avatar" /> 
					</div>
					<div id="avatar-file-box-two" style="display: none;">
						<button type="button" id="upload-avatar">UPLOAD</button>
					</div>
					<input type="hidden" name="avatar-image" value="<?php echo (!empty($avatar)) ? $avatar : ''; ?>" id="avatar-image" />
					<input type="hidden" name="avatar-hidden-field" value="avatar-hidden" id="avatar-hidden-field" />
				</div>
			</div>

			<div id="avatar-message" class="upload-error" 
				style="<?php echo (isset($uploadErrorMessage) && !empty($uploadErrorMessage)) ? 'display: block;' : 'display: none;'; ?>">
				<p><?php echo (isset($uploadErrorMessage) && !empty($uploadErrorMessage)) ? $uploadErrorMessage : ''; ?></p>
			</div>

			<?php if(isset($uploadSuccessMessage)): ?>
				<div id="avatar-message" class="upload-success">
					<p><?php echo $uploadSuccessMessage; ?></p>
				</div>
			<?php endif; ?>
		</form>

		<div id="user-flash-message" style="display: none;">
			<p><?php echo (isset($message) && !empty($message)) ? $message : ''; ?></p>
		</div>

		<script src="/assets/js/app.js"></script>
		<script src="/assets/js/profile.js"></script>
	</body>
</html>