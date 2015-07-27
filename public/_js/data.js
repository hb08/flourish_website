var ms = [];
// Text
var textMil = {
	allStart 	: "<div class='dp medium-12 columns'>",
	start			: "<h3> Your <span>",
	plantS		:	"</span> are ready to Plant!</h3><img src='http://www.hbetancourt.com/flourish/public/_images/plant_images/",
	plantF		:	"_seed.jpg'/><p>Your seeds or seedlings are finally ready to be tucked into the dirt and start the grand adventure of becoming a full-grown plant!  Make certain you’ve prepared your gardening area appropriately, and get planting!</p><p>If the soil conditions aren’t right,  keep an eye out for the right time to plant your seeds by following the planting information in the fruit or vegetable’s information page.",
	sproutS 	: "</span> will be Sprouting soon!</h3><img src='http://www.hbetancourt.com/flourish/public/_images/plant_images/",
	sproutF		:	"_sprout.jpg'/><p>Your plants should be beginning to sprout!  You should see leaves, stems, or other greenery rising from the soil soon!</p><p>If your plants haven’t sprouted yet, don’t worry!  Like any living thing, all plants are different.  If you haven’t seen sprouting within a week, there may be a problem with your seed or shoot.",
	thinS 		: "</span> need to be Thinned soon!</h3><img src='http://www.hbetancourt.com/flourish/public/_images/plant_images/",
	thinF			:	"_sprout.jpg'/><p>Now that your plants are sprouting like crazy, it’s time to thin them out a bit!  Make sure to refer to your plant description for information on how to thin out plants.</p><p>If your plants haven’t started growing too close together yet, that’s a good thing!  All plants are different, as are all garden layouts, and if you end up not having to thin plants out, more the better, but keep an eye out for crowding!",
	fertS 		: "</span> will need Fertilizing soon!</h3><img src='http://www.hbetancourt.com/flourish/public/_images/plant_images/",
	fertF			:	"_sprout.jpg'/><p>Just like you, plants aren’t themselves when they’re hungry!  Time to check the plant description for information on fertilization and then get those plants fed!</p><p>If your plants seem to be doing pretty good without fertilizer, that’s great!  You may already have the soil just where the plant likes it.  Just take time to check and make sure the plants don’t appear to be wilting any, and if they do, add a little fertilizer!",
	harvS 	: "</span> will be ready to Harvest soon!</h3><img src='http://www.hbetancourt.com/flourish/public/_images/plant_images/",
	harvF	:	"_harvest.jpg'/><p>Your hard work is finally bearing fruit (or vegetables).  After you’ve checked the harvesting information in your plant’s description, get to work getting those delicious treasures picked and stored!</p><p>If you’ve read the harvesting information and it seems too early, that’s fine!  As always, all plants are different, and grow at differing times.  Just make sure to check for the appropriate harvesting conditions so you can get as much as possible in your yield.",
	linkStart : " <a href='details/",
	end				: "'>More Information</a></p>",
	allEnd 		: "</div>",
};
// Get the lists
if($('.mList > li > a')){
	var plLinks 	= $('#all > .mList > .plant > a');
	var sLinks	= $('#all > .mList > .sprout > a');
	var tLinks	= $('#all > .mList > .thin > a');
	var fLinks	= $('#all > .mList > .fert > a');
	var hLinks	= $('#all > .mList > .harv > a');
	tryLinks(plLinks, 'plant');
	tryLinks(sLinks, 'sprout');
	tryLinks(tLinks, 'thin');
	tryLinks(fLinks, 'fert');
	tryLinks(hLinks, 'harv');
}
function tryLinks(pLinks, t){
	for(var i = 0; i < pLinks.length; i++){
		var pchild = $(pLinks[i]).children();
		var pName = $(pchild[0]).html();
		if(pName){
			var plant = {
				id 		: $(pLinks[i]).attr('class'),
				name 	: pName,
				date	: $(pLinks[i]).children(".due").attr('name'),
			}
			var uName = pName.toLowerCase();
			if(t == 'plant'){
				plant['text'] = textMil['start']+ pName +  textMil['plantS'] + uName +textMil['plantF'] + textMil['linkStart'] + $(pLinks[i]).attr('class') + textMil['end'];
			}else if(t == 'sprout'){
				plant['text'] = textMil['start']+ pName +  textMil['sproutS'] + uName +textMil['sproutF'] + textMil['linkStart'] + $(pLinks[i]).attr('class') + textMil['end'];
			}else if(t == 'thin'){
				plant['text'] = textMil['start']+ pName +  textMil['thinS'] + uName +textMil['thinF'] + textMil['linkStart'] + $(pLinks[i]).attr('class') + textMil['end'];
			}else if(t == 'fert'){
				plant['text'] = textMil['start']+ pName +  textMil['fertS'] + uName +textMil['fertF'] + textMil['linkStart'] + $(pLinks[i]).attr('class') + textMil['end'];
			}else if(t == 'harv'){
				plant['text'] = textMil['start']+ pName +  textMil['harvS'] + uName +textMil['harvF'] + textMil['linkStart'] + $(pLinks[i]).attr('class') + textMil['end'];
			}
			ms.push(plant);
		}
		}
	}
var mileEvents = {};
// Push to events with correct text
for(var i = 0; i < ms.length; i++){
	var ev = ms[i]['date'];
	// format date for cal
	ev += "T17:00:00Z";
	ev = new Date(ev);
	var date = ('0' + (ev.getMonth()+1)).slice(-2) + '-'
             + ('0' + ev.getDate()).slice(-2) + '-'
             + ev.getFullYear();
	var event = ms[i]['text'];
	console.log(ev);
	if(mileEvents[date]){
		mileEvents[date] += "<div class='mEvent row'>" + event + "</div>";
	}else{
		mileEvents[date] = "<div class='mEvent row'>" + event + "</div>";
	}
}
