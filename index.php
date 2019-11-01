<?php session_start(); ?>
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

		<?php

			if( isset($_SESSION['name']) && !empty($_SESSION['name']) ){
				$userName = $_SESSION['name'];
			}

			if( isset($_SESSION['email']) && !empty($_SESSION['email']) ){
				$userEmail = $_SESSION['email'];
			}

		?>

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
						<li><a href="#">Profile</a></li>
						<li><a href="#">Settings</a></li>
						<li><a href="#">Logout</a></li>
					</ul>
				</li>
			</ul>
		</div>

		<script src="/assets/js/app.js"></script>
	</body>
</html>