$(document).ready(function(){

	$("#register-button").on("click", function(){
		validateRegistration();
	});

	$("#show-password-register").on("click", function(){
		showRegisterPassword();
	});

	getEmails();

	imageSlider();

});

function validateRegistration()
{
	var name = $("#name").val();
	var email = $("#email").val();
	var password = $("#password").val();
	var allEmails = $("#all-emails").val();

	var nameError = '';
	var emailError = '';
	var passwordError = '';

	var error = false;

	name = name.trim();
	email = email.trim();
	password = password.trim();

	if( name == '' ){
		error = true;
		nameError = 'Name can not be empty.';
		$("#name-error-container").text(nameError);
		$("#name").addClass('error-wrapper');
	} else {
		var nameLenght = name.length;
		if( nameLenght < 3 || nameLenght > 15 ){
			error = true;
			nameError = 'Name must have at least 3 characters, but not more that 15';
			$("#name-error-container").text(nameError);
			$("#name").addClass('error-wrapper');
		}
	}

	if( nameError == '' ){
		$("#name-error-container").text('');
		if( $("#name").hasClass("error-wrapper") ){
			$("#name").removeClass("error-wrapper");
		}
	}

	if( email == '' ){
		error = true;
		emailError = 'Email can not be empty.';
		$("#email-error-container").text(emailError);
		$("#email").addClass('error-wrapper');
	} else {
		if( validateEmail(email) == false ){
			error = true;
			emailError = 'Email is not valid.';
			$("#email-error-container").text(emailError);
			$("#email").addClass('error-wrapper');
		}
	}

	// check if email exists
	allEmails = allEmails.split(",");
	
	for( var i = 0; i < allEmails.length; i++ ){
		if( email == allEmails[i] ){
			error = true;
			emailError = 'Email already exists.';
			$("#email-error-container").text(emailError);
			$("#email").addClass('error-wrapper');
		}
	}

	if( emailError == '' ){
		$("#email-error-container").text('');
		if( $("#email").hasClass("error-wrapper") ){
			$("#email").removeClass("error-wrapper");
		}
	}

	if( password == '' ){
		error = true;
		passwordError = 'Password can not be empty.';
		$("#password-error-container").text(passwordError);
		$("#password").addClass('error-wrapper');
	} else {
		var passwordLength = password.length;
		if( passwordLength < 3 || passwordLength > 15 ){
			error = true;
			passwordError = 'Password must have at least 3 characters, but not more that 15';
			$("#password-error-container").text(passwordError);
			$("#password").addClass('error-wrapper');
		}
	}

	if( passwordError == '' ){
		$("#password-error-container").text('');
		if( $("#password").hasClass('error-wrapper') ){
			$("#password").removeClass('error-wrapper');
		}
	}

	if( error === false ){
		$("#register-form").submit();
	}

}

function validateEmail(email)
{
	var regularEx = /\S+@\S+\.\S+/;
	return regularEx.test(email);
}

function getEmails()
{
	$.ajax({
		url: "External.php",
		method: "POST",
		success: function(response){
			var emails = JSON.parse(response);
			$("#all-emails").val(emails);
		},
		error: function(){
			console.log('Error');
		}
	});
}

function showRegisterPassword()
{
	var element = document.getElementById("password");

	if( element.type === "password" ){
		element.type = "text";
	} else {
		element.type = "password";
	}
}

function imageSlider()
{
	var images = ['one.jpg', 'two.jpg', 'three.jpg', 'four.jpg', 'five.jpg', 'six.jpg', 'seven.jpg', 'eight.jpg', 'image.jpg'];

	var firstImage = images.length - 1;

	$("#image-container img").attr("src", "/../assets/images/"+images[firstImage]);

	var imageCount = images.length;

	var interval = 0;

	var intervalId = setInterval(function(){

		if( interval < imageCount ){
			$("#image-container img").attr("src", "/../assets/images/"+images[interval]);
			interval++;
		} else {
			clearInterval(intervalId);
			imageSlider();
		}
		
	}, 3000);

}