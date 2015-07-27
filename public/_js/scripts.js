$(document).ready(function(){
	// Force Panel Open if not logged in
	$forceOpen = document.getElementById('userAttempt');
	if($forceOpen != null){
		$('#loginPanel').foundation('reveal', 'open');
		$forceOpen = null;
		$("#errorP").prepend('You must be a registered user to access this content!');
	}

// Image Slider on Index
if(document.getElementById("index") ){
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
	}

// Calendar
if(document.getElementById('calendar')){
}
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
	// Remove default
	$('#noLink').click(function(e){
		e.preventDefault();
	});


	// Curve Text On GO only
	if(document.getElementById('diffchart')){
			var totalCount = 0;
		// Parse all needs for all dials and sepearte by type, adding new text to page
		var allDials = [];
		allDials['water'] = splitText('water');
		allDials['soil'] = splitText('soil');
		allDials['sun'] = splitText('sun')
		allDials['diff'] = splitText('diff');
		function splitText(thisType){ // Splits the text into an  array
			var textChange = document.getElementById(thisType).innerHTML;
			var splitText = textChange.split("|");
			var final = [];
			var start = '#' + thisType + 'dial';
			var i = 0;
			splitText.forEach(function(e){
					// For every split item
					var finalSplit = e.split(",");
					// Check if it's null (end) if not, split and add
					if(finalSplit[0] != ""){
						final.push({
							"type": finalSplit[0],
							"need": finalSplit[1]
						});
					var insert = "<p id='" + thisType + "_arc_" + i + "' class='tilted'>" + finalSplit[0] + "</p>";
					$(start).prepend(insert);
					var $arcing = $('#' + thisType + "_arc_" + i).hide();
					// Add to Total Count
					totalCount += parseInt(finalSplit[1]);
					i++;
					if(finalSplit[1] != 0){
						var coverUp = '#' + thisType + 'dial .dialLabel';
						$(coverUp).css({'z-index' : 4, 'background-color': 'white'})
						init();
						function init(){
							// Get number of current
							$arcing.show().arctext({radius:225});
						}
					}
				}
			})
			final['totalCount'] = totalCount;
			totalCount = 0;
			return final;
		} // End SplitText Function
		function rotateLabels(dial, type){
			var tc = dial['totalCount'];
			var rotation = 0;
			// For each item
			for(var ii = 0; ii < dial.length; ii++){
				// Find how many there are
				var thisW = dial[ii]['need'];
				// Divide by total to find what it is as a fraction
				var perc = thisW/tc;
				// Multiply by 360 to find amount to rotate
				var thisR = 360 * perc;
				if(ii == 0){ // First item
					// Start rotation at 20
					rotation += 20;
				}
				rotateThis = 'rotate(' + rotation + 'deg)';
				var elem = $('#' + type + '_arc_' + ii);
				elem.css({"transform": rotateThis});
				rotation += thisR;
			}
		}

		rotateLabels(allDials['water'], 'water');
		rotateLabels(allDials['soil'], 'soil');
		rotateLabels(allDials['sun'], 'sun');
		rotateLabels(allDials['diff'], 'diff');


	} // End If



}); // End Doc Ready
