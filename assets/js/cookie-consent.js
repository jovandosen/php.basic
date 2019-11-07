$(document).ready(function(){

	$("#cookie-consent-container").fadeIn(1000);
	
	$("#cookie-consent-button").on("click", function(){
		$("#cookie-consent-container").fadeOut(1000);
	});

});