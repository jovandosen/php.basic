$(document).ready(function(){
	imageSlider();
});

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