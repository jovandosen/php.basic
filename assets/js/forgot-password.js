$(document).ready(function(){

	$("#forgot-password-button").on("click", function(){
		validateEmailAddress();
	});

	getEmails();

	checkFlashMessage();

	imageSlider();

});

function validateEmailAddress()
{
	var email = $("#email").val();
	var allEmails = $("#all-emails").val();

	var emailError = '';

	var error = false;

	email = email.trim();

	if( email == '' ){

		error = true;
		emailError = 'Email can not be empty.';
		$("#email-error-container").text(emailError);
		$("#email").addClass('error-wrapper');

	} else if( validateEmail(email) == false ) {

		error = true;
		emailError = 'Email is not valid.';
		$("#email-error-container").text(emailError);
		$("#email").addClass('error-wrapper');

	} else {

		// check if email exists
		allEmails = allEmails.split(",");

		var countEmails = 0;

		for( var i = 0; i < allEmails.length; i++ ){
			if( email == allEmails[i] ){
				countEmails++;
			}
		}

		if( countEmails === 0 ){
			error = true;
			emailError = 'Email does not exist.';
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

	if( error === false ){
		$("#forgot-password-form").submit();
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

function checkFlashMessage()
{
	var flashMessage = $("#mail-sent-container p").text();

	if( flashMessage != '' ){

		setTimeout(function(){
			$("#mail-sent-container").css({"display":"none"});
		}, 5000);

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