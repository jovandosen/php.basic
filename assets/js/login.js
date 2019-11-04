$(document).ready(function(){

	$("#login-button").on("click", function(){
		validateLogin();
	});

	$("#show-password-login").on("click", function(){
		showLoginPassword();
	});

});

function validateLogin()
{
	var email = $("#email").val();
	var password = $("#password").val();

	var emailError = '';
	var passwordError = '';

	var error = false;

	email = email.trim();
	password = password.trim();

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
		$("#login-form").submit();
	}

}

function validateEmail(email)
{
	var regularEx = /\S+@\S+\.\S+/;
	return regularEx.test(email);
}

function showLoginPassword()
{
	var element = document.getElementById("password");

	if( element.type === "password" ){
		element.type = "text";
	} else {
		element.type = "password";
	}
}