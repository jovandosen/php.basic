<?php 

	session_start(); 

	if( isset($_SESSION['name']) && !empty($_SESSION['name']) && isset($_SESSION['email']) && !empty($_SESSION['email']) ){
		$userName = $_SESSION['name'];
		$userEmail = $_SESSION['email'];
	} else {
		header('Location: /../login.php');
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

		<form method="post" action="#" id="profile-form">
			<div id="profile-content">
				<div id="avatar-wrapper">
					<div id="avatar-wrapper-box">
						<p>No avatar image provided</p>
						<?php if(isset($userAvatar) && !empty($userAvatar)): ?>
							<img src="/assets/images/one.jpg" />
						<?php endif; ?>
					</div>
					<input type="file" name="avatar" id="avatar" />
				</div>
				<div id="profile-content-details">
					<div>
						<label for="profile-name">Name:</label>
						<input type="text" name="profile-name" id="profile-name" value="<?php echo $userName; ?>" />
					</div>
					<div id="profile-email-container">
						<label for="profile-email">Email:</label>
						<input type="text" name="profile-email" id="profile-email" value="<?php echo $userEmail; ?>" />
					</div>
					<div id="profile-update-button-container">
						<button id="update-profile-data">UPDATE</button>
					</div>
				</div>
			</div>
		</form>

		<script src="/assets/js/app.js"></script>
	</body>
</html>