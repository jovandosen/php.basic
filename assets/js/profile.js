$(document).ready(function(){

	$("#profile-name, #profile-email").on("keyup", function(){
		detectChange();
	});

	$("#update-profile-data").on("click", function(){
		validateProfileData();
	});

	$("#avatar").on("change", function(){
		validateAvatar();
	});

	$("#upload-avatar").on("click", function(){
		$("#avatar-form").submit();
	});

});

function detectChange()
{
	var name = $("#profile-name").val();
	var email = $("#profile-email").val();

	var nameCheck = $("#profile-name-hidden").val();
	var emailCheck = $("#profile-email-hidden").val();

	name = name.trim();
	email = email.trim();
	nameCheck = nameCheck.trim();
	emailCheck = emailCheck.trim();

	if( (name != nameCheck) || (email !=emailCheck) ){
		$("#update-profile-data").css({"display":"block"});
	} else {
		$("#update-profile-data").css({"display":"none"});
	}

}

function validateProfileData()
{
	var name = $("#profile-name").val();
	var email = $("#profile-email").val();

	var error = false;

	var nameError = '';
	var emailError = '';

	if( name == '' ){
		error = true;
		nameError = 'Name can not be empty.';
		$("#profile-name-error").text(nameError);
		$("#profile-name").addClass("add-error-style");
	} else {
		var nameLength = name.length;
		if( nameLength < 3 || nameLength > 15 ){
			error = true;
			nameError = 'Name must have at least 3 characters, but not more than 15';
			$("#profile-name-error").text(nameError);
			$("#profile-name").addClass("add-error-style");
		}
	}

	if( nameError == '' ){
		$("#profile-name-error").text('');
		if( $("#profile-name").hasClass("add-error-style") ){
			$("#profile-name").removeClass("add-error-style");
		}
	}

	if( email == '' ){
		error = true;
		emailError = 'Email can not be empty.';
		$("#profile-email-error").text(emailError);
		$("#profile-email").addClass("add-error-style");
	} else {
		if( validateEmail(email) === false ){
			error = true;
			emailError = 'Email is not valid.';
			$("#profile-email-error").text(emailError);
			$("#profile-email").addClass("add-error-style");
		}
	}

	if( emailError == '' ){
		$("#profile-email-error").text('');
		if( $("#profile-email").hasClass("add-error-style") ){
			$("#profile-email").removeClass("add-error-style");
		}
	}

	if( error === false ){
		$("#profile-form").submit();
	}

}

function validateEmail(email)
{
	var regularEx = /\S+@\S+\.\S+/;
	return regularEx.test(email);
}

function validateAvatar()
{
	if( document.getElementById("avatar").files.length !== 0 ){

		var fileName;
		var fileSize;
		var fileType;

		var fileNameError = false;
		var fileSizeError = false;
		var fileTypeError = false;

		var file = document.getElementById("avatar").files[0];

		fileName = file.name;
		fileSize = file.size;
		fileType = file.type;

		fileType = fileType.split("/");
		fileType = fileType[1];

		if( (fileType != 'jpg') && (fileType != 'jpeg') && (fileType != 'png') ){
			fileTypeError = 'Only jpg, jpeg and png files are allowed.';
		}

		if( fileSize > 5242880 ){
			fileSizeError = 'File is too large, max file size is 5MB.';
		}

		if( fileTypeError != '' ){
			$("#avatar-message").css({"display":"block"});
			$("#avatar-message p").text(fileTypeError);
		} 

		if( fileSizeError != '' ){
			$("#avatar-message").css({"display":"block"});
			$("#avatar-message p").text(fileSizeError);
		} 

		if( fileTypeError === false && fileSizeError === false ){
			$("#avatar-message p").text('');
			$("#avatar-file-box-two").css({"display":"block"});
		} else {
			$("#avatar-file-box-two").css({"display":"none"});
		}

	}
}