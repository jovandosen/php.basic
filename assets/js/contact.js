$(document).ready(function(){
	
	$("#contact-button").on("click", function(){
		//validateContactForm();
		$("#contact-form").submit();
	});

});

function validateContactForm()
{
	var name = $("#name").val();
	var email = $("#email").val();
	var message = $("#message").val();

	var nameError = '';
	var emailError = '';
	var messageError = '';

	var error = false;

	name = name.trim();
	email = email.trim();
	message = message.trim();

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

	if( emailError == '' ){
		$("#email-error-container").text('');
		if( $("#email").hasClass("error-wrapper") ){
			$("#email").removeClass("error-wrapper");
		}
	}

	if( message == '' ){
		error = true;
		messageError = 'Message can not be empty.';
		$("#message-error-container").text(messageError);
		$("#message").addClass('error-wrapper');
	}

	if( messageError == '' ){
		$("#message-error-container").text('');
		if( $("#message").hasClass('error-wrapper') ){
			$("#message").removeClass('error-wrapper');
		}
	}

	if( error === false ){
		$("#contact-form").submit();
	}

}

function validateEmail(email)
{
	var regularEx = /\S+@\S+\.\S+/;
	return regularEx.test(email);
}