$(document).ready(function(){
	// Force Panel Open
	$forceOpen = document.getElementById('userAttempt');
	if($forceOpen != null){
		$('#loginPanel').foundation('reveal', 'open');
		$forceOpen = null;
		$("#errorP").prepend('You must be a registered user to access this content!');
	}


	// Slider
	$('.left').click(function(e){
		$('.slides').slickNext();
	});
	$('.slides').slick({
		accessibility: true,
		arrows:true,
		autoplay: true,
		autoplaySpeed: 5000,
		dots: true,
		dotsClass: 'slick-dots',
		pauseOnDotsHover: false,
		speed: 500
	})
});
