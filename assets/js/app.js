$(document).ready(function(){

	$("#user-info, #user-info-details").mouseover(function(){
		$("#user-info-details").css({"display":"block"});
	});

	$("#user-info, #user-info-details").mouseout(function(){
		$("#user-info-details").css({"display":"none"});
	});

	checkFlashMessage();

});

function checkFlashMessage()
{
	var flashMessage = $("#user-flash-message p").text();

	if( flashMessage != '' ){

		$("#user-flash-message").css({"display":"block"});

		setTimeout(function(){
			$("#user-flash-message").css({"display":"none"});
		}, 5000);

	}

}