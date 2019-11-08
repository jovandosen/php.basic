$(document).ready(function(){

	$("#cookie-consent-container").fadeIn(1000);
	
	$("#cookie-consent-button").on("click", function(){

		$("#cookie-consent-container").fadeOut(1000);

		var clicked = "accepted";

		$.ajax({
			url: "CookiePolicy.php?data=" + clicked,
			method: "GET",
			success: function(response){
				console.log(response);
			},
			error: function(){
				console.log('Error');
			}
		});

	});

});