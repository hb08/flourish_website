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
	});

	// Save Garden
	$('.save_garden').click(function(){
	  var name = document.getElementById('garden_name').value;
	  if(name == null){
	    name == "My Garden";
	  }
	  var canvas = document.getElementById('gardenCanvas');
	  // save Png
	  var img = canvas.toDataURL('image/png');
		$('#holdGarden').html(img);
	});

	// Add Plant to Search Remove Panel
	$('.plantRemove').click(function(){
			$thisPlant = this;
			$thisId = $($thisPlant).attr('id');
			$thisName = $($thisPlant).attr('name');
			$('#plantId').val($thisId);
			$('#plantName').val($thisName);
	});
	$('.plantAdd').click(function(){
			$thisPlant = this;
			$thisId = $($thisPlant).attr('id');
			$thisName = $($thisPlant).attr('name');
			$('#addPlant').val($thisId);
			$('#addName').val($thisName);
	});
});
