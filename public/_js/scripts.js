$(document).ready(function(){
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
	});	
/* Account Dropdown */
	$(".account").hover(
		function(){
			$(".dd").css("display", "block");
		}, function(){
			$(".dd").css("display", "none");
	});
});
