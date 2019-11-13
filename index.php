<?php 

	session_start(); 

	if( isset($_SESSION['user']) && !empty($_SESSION['user']) ){

		$user = $_SESSION['user'];

		$userName = $user->name;
		$userEmail = $user->email;

		if( isset($_SESSION['message']) && !empty($_SESSION['message']) ){
			$userMessage = $_SESSION['message'];
		} else {
			$userMessage = '';
		}

	} else {
		header('Location: /include/login.php');
	}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Homepage</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" type="image/png" href="/assets/images/favicon.jpg">
		<link rel="stylesheet" type="text/css" href="/assets/css/app.css">
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

		<div id="user-flash-message" style="display: none;">
			<p><?php echo $userMessage; ?></p>
		</div>

		<script src="/assets/js/app.js"></script>
	</body>
</html>