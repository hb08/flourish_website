<?php
class PlantController extends BaseController {

/* Search Plants */
  public function searchPlants(){
		/* Assign Inputs to Variables */
		$zip = Input::get('search');
		$diff = Input::get('difficulty');
		$season = Input::get('season');
		$soil = Input::get('soil');
		$sun = Input::get('sun');
		$type = Input::get('type');
		$water = Input::get('water');

		/* Old Input Container */
		$old = array();

		$statement = 'SELECT plant_list.plant_id as id, plant_name, pi_type.plant_type, bot_name, sun_need, soil_need, season_name, diff_detail, water_need, harvest_time  FROM plant_list
		INNER JOIN pi_type ON plant_list.plant_type = pi_type.type_id
		INNER JOIN pi_sun ON plant_list.sun_id = pi_sun.sun_id
		INNER JOIN pi_soil ON plant_list.soil_id = pi_soil.soil_id
		INNER JOIN pi_season ON plant_list.season_id = pi_season.season_id
		INNER JOIN pi_diff ON plant_list.diff_id = pi_diff.diff_id
		INNER JOIN pi_water ON plant_list.water_id = pi_water.water_id
		';

		$or = false;
		/* Set Search Statements */
		if(!empty($diff)){ // If there is a DIFFICULTY filter
			// Add to the statement
			$statement .= ' WHERE plant_list.diff_id = ' . $diff;
			// Change the Or to true
			$or = true;
			// Add to array
			$old['diff'] = $diff;
		}
		if(!empty($type)){ // If there is a TYPE filter
			// Add to array
			$old['type'] = $type;
			// If Or is FALSE
			if($or == false ){
				// Start with a WHERE for plants that grow everywhere
				$statement .= ' WHERE (plant_list.plant_type = 5';
				// Change the Or to true
				$or = true;
			}else{
				// Otherwise start with OR for plants that grow everywhere
				$statement .= ' AND (plant_list.plant_type = 5';
			}
			if($type == 1 || $type == 9){
				// Pull all plants within FULL
				$statement .= ' OR plant_list.plant_type = 1';
				$statement .= ' OR plant_list.plant_type = 9)';
			} elseif($type == 7 || $type == 8){
				// Pull all plants within PART
				$statement .= ' OR plant_list.plant_type = 7';
				$statement .= ' OR plant_list.plant_type = 8)';
			}
		}
		if(!empty($sun)){ // If there is a SUN filter
			// Add to array
			$old['sun'] = $sun;
			// If Or is FALSE
			if($or == false ){
				// Start with a WHERE
				$statement .= ' WHERE (';
				// Change the Or to true
				$or = true;
			}else{
				// Otherwise start with OR
				$statement .= ' AND (';
			}
			if($sun == 1 || $sun == 4 ){
				// Pull all plants within FULL
				$statement .= ' plant_list.sun_id = 1';
				$statement .= ' OR plant_list.sun_id = 4)';
			} elseif($sun == 2 || $sun == 4 || $sun == 5 ){
				// Pull all plants within PART
				$statement .= ' plant_list.sun_id = 2';
				$statement .= ' OR plant_list.sun_id = 4';
				$statement .= ' OR plant_list.sun_id = 5)';
			} elseif($sun == 3 || $sun == 5  ){
				// Pull all plants within SHADE
				$statement .= ' plant_list.sun_id = 3';
				$statement .= ' OR plant_list.sun_id = 5)';
			}
		}
		if(!empty($season)){ // If there is a SEASON filter
			// Add to array
			$old['season'] = $season;
			// If Or is FALSE
			if($or == false ){
				// Start with a WHERE for plants that grow everywhere
				$statement .= ' WHERE (plant_list.season_id = 5';
				// Change the Or to true
				$or = true;
			}else{
				// Otherwise start with OR for plants that grow everywhere
				$statement .= ' AND (plant_list.season_id = 5';
			}
			// Find specific season and assign all plants possible within
			if($season == 1 || $season == 6 || $season == 7 || $season == 8 ){
				// Pull all plants within SPRING
				$statement .= ' OR plant_list.season_id = 1';
				$statement .= ' OR plant_list.season_id = 6';
				$statement .= ' OR plant_list.season_id = 7';
				$statement .= ' OR plant_list.season_id = 8)';
			} elseif($season == 2 || $season == 7 || $season == 9 ){
				// Pull all plants within Summer
				$statement .= ' OR plant_list.season_id = 2';
				$statement .= ' OR plant_list.season_id = 7';
				$statement .= ' OR plant_list.season_id = 9)';
			} elseif($season == 3 || $season == 6 || $season == 8 || $season == 9 ){
				// Pull all plants within Fall
				$statement .= ' OR plant_list.season_id = 3';
				$statement .= ' OR plant_list.season_id = 6';
				$statement .= ' OR plant_list.season_id = 8';
				$statement .= ' OR plant_list.season_id = 9)';
			} elseif($season == 4 || $season == 6 || $season == 8 ){
				// Pull all plants within Winter
				$statement .= ' OR plant_list.season_id = 4';
				$statement .= ' OR plant_list.season_id = 6';
				$statement .= ' OR plant_list.season_id = 8)';
			}
		}
		if(!empty($soil)){
			// Add to array
			$old['soil'] = $soil;
			// If Or is FALSE
			if($or == false ){
				// Start with a WHERE for plants that grow everywhere
				$statement .= ' WHERE (plant_list.soil_id = 10';
				// Change the Or to true
				$or = true;
			}else{
				// Otherwise start with OR for plants that grow everywhere
				$statement .= ' AND (plant_list.soil_id = 10';
			}
			// Find specific soil and assign all plants possible within
			if($soil == 1 || $soil == 11 ){
				// Pull all plants within SANDY
				$statement .= ' OR plant_list.soil_id = 1';
				$statement .= ' OR plant_list.soil_id = 11)';
			} elseif($soil == 2 || $soil == 7){
				// Pull all plants within SILTY
				$statement .= ' OR plant_list.soil_id = 2';
				$statement .= ' OR plant_list.soil_id = 7)';
			} elseif($soil == 3 || $soil == 8 ){
				// Pull all plants within CLAY
				$statement .= ' OR plant_list.soil_id = 3';
				$statement .= ' OR plant_list.soil_id = 8)';
			} elseif($soil == 4 || $soil == 9 ){
				// Pull all plants within PEATY
				$statement .= ' OR plant_list.soil_id = 4';
				$statement .= ' OR plant_list.soil_id = 9)';
			} elseif($soil == 5){
				// Pull all plants within SALINE
				$statement .= ' OR plant_list.soil_id = 5)';
			} elseif($soil == 6 || $soil == 7 || $soil == 8 || $soil == 9 || $soil == 11  ){
				// Pull all plants within LOAM
				$statement .= ' OR plant_list.soil_id = 6';
				$statement .= ' OR plant_list.soil_id = 7';
				$statement .= ' OR plant_list.soil_id = 8';
				$statement .= ' OR plant_list.soil_id = 9';
				$statement .= ' OR plant_list.soil_id = 11)';
			}
		}
		if(!empty($water)){ // If there is a WATER filter
			// Add to array
			$old['water'] = $water;
			if($or == false){
				// Add to the statement
				$statement .= ' WHERE plant_list.water_id = ' . $water;
				// Change the Or to true
				$or = true;
			}else{
				$statement.= ' AND plant_list.water_id = ' . $water;
			}
		}
		$zoneRange = array();
		if(!empty($zip)){
			// Add to array
			$old['zip'] = $zip;
			$zone = DB::table('zip_zone')->where('zipcode', $zip)->pluck('zone_number');
			// Ensure Zone is entire selection for Zip
			switch($zone){
				case '1':
					$zoneRange = [ '1', '9', '12', '13', '15'];
					break;
				case '2':
					$zoneRange = [ '2', '9', '12', '13', '15'];
					break;
				case '3':
					$zoneRange = [ '3', '9', '10', '14', '17'];
					break;
				case '4':
					$zoneRange = [ '4', '9', '10', '14', '17'];
					break;
				case '5':
					$zoneRange = [ '5', '10', '11', '12', '13', '14', '18'];
					break;
				case '6':
					$zoneRange = [ '6', '10', '11', '12', '13', '14', '18'];
					break;
				case '7':
					$zoneRange = [ '7', '11', '12', '14', '19'];
					break;
				case '8':
					$zoneRange = [ '8', '11', '12', '14', '19'];
					break;
        case 'Florida':
          $zoneRange = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19'];
          break;
			}
			$counter = count($zoneRange);
			$i = 1;
			foreach($zoneRange as $z){
				if($or == false && $i == 1){
					// If there are no previous filters and this is the first item
					$statement .= ' WHERE (zone_id = ' . $z;
					$or = true;
				}elseif($or == true && $i == 1){
					// If there are previous filters and this is the first item
					$statement .= ' AND (zone_id = ' . $z;
					$or = true;
				}elseif($i == $counter){
					// If this is the last item
					$statement .= ' OR zone_id = ' . $z . ')';
				}else{
					// Everything else
					$statement .= ' OR zone_id = ' . $z;
				}
				// Add iteration
				$i+=1;
			}
		}
		$plants = DB::select($statement);
		$plantList = (array)$plants;
		/* Get the Count */
		$count = count($plants);
		/* Get the Search Filters */
		$filter = array(
			'difficulty' => DB::table('pi_diff')->get(),
			'season' => DB::table('pi_season')->get(),
			'soil' => DB::table('pi_soil')->get(),
			'sun' => DB::table('pi_sun')->get(),
			'type' => DB::table('pi_type')->get(),
			'water' => DB::table('pi_water')->get()
		);

		/* Return it all in a view */
		return View::make('pages.search', array('title' => 'Plant Directory | Flourish – Your Florida Gardening Guide', 'plants' => $plantList, 'count' => $count, 'filter' => $filter, 'zip' => $zip, 'zone' => $zone, 'thisPanel' => 'search',  'old' => $old));
	}
/* Plant List */
	public function getPlants(){
		$zip;
		$plants;
		$zone;

		if(is_null(Session::get('zip'))){ /* Select All in Database - Default for no entered zip/ not logged in */
			$statement = '
      SELECT plant_list.plant_id as id, plant_name, pi_type.plant_type, bot_name, sun_need, soil_need, season_name, diff_detail, water_need, harvest_time  FROM plant_list
			INNER JOIN pi_type ON plant_list.plant_type = pi_type.type_id
			INNER JOIN pi_sun ON plant_list.sun_id = pi_sun.sun_id
			INNER JOIN pi_soil ON plant_list.soil_id = pi_soil.soil_id
			INNER JOIN pi_season ON plant_list.season_id = pi_season.season_id
			INNER JOIN pi_diff ON plant_list.diff_id = pi_diff.diff_id
			INNER JOIN pi_water ON plant_list.water_id = pi_water.water_id
			';
			$zip = 'Florida';
			$hzone = '';
      $plants = DB::select($statement);
		}else{ /* If user is logged in, select all from zip */
			$zip = Session::get('zip');
			$zone_number = DB::table('zip_zone')->where('zipcode', $zip)->pluck('zone_number');
      $hzone = DB::table('hzone')->where('zone_number', $zone_number)->pluck('hz_id');
			$zoneRange = array();
      $statement = 'SELECT plant_list.plant_id as id, plant_name, pi_type.plant_type, bot_name, sun_need, soil_need, season_name, diff_detail, water_need, harvest_time  FROM plant_list
      INNER JOIN pi_type ON plant_list.plant_type = pi_type.type_id
      INNER JOIN pi_sun ON plant_list.sun_id = pi_sun.sun_id
      INNER JOIN pi_soil ON plant_list.soil_id = pi_soil.soil_id
      INNER JOIN pi_season ON plant_list.season_id = pi_season.season_id
      INNER JOIN pi_diff ON plant_list.diff_id = pi_diff.diff_id
      INNER JOIN pi_water ON plant_list.water_id = pi_water.water_id';
			// Ensure Zone is entire selection for Zip
			switch($hzone){
				case '1':
					$zoneRange = [ '1', '9', '12', '13', '15'];
					break;
				case '2':
					$zoneRange = [ '2', '9', '12', '13', '15'];
					break;
				case '3':
					$zoneRange = [ '3', '9', '10', '14', '17'];
					break;
				case '4':
					$zoneRange = [ '4', '9', '10', '14', '17'];
					break;
				case '5':
					$zoneRange = [ '5', '10', '11', '12', '13', '14', '18'];
					break;
				case '6':
					$zoneRange = [ '6', '10', '11', '12', '13', '14', '18'];
					break;
				case '7':
					$zoneRange = [ '7', '11', '12', '14', '19'];
					break;
				case '8':
					$zoneRange = [ '8', '11', '12', '14', '19'];
					break;
        case '15':
          $zoneRange = [ '1', '2', '9', '12', '13', '15'];
          break;
        case '17':
          $zoneRange = [ '3', '4', '9', '10', '14', '17'];
          break;
        case '18':
          $zoneRange = [ '5', '6', '10', '11', '12', '13', '14', '18'];
          break;
        case '19':
          $zoneRange = [ '7', '8', '11', '12', '14', '19'];
          break;
			}
      $or = false;
      $counter = count($zoneRange);
			$i = 1;
			foreach($zoneRange as $z){
				if($or == false && $i == 1){
					// If there are no previous filters and this is the first item
					$statement .= ' WHERE (zone_id = ' . $z;
					$or = true;
				}elseif($or == true && $i == 1){
					// If there are previous filters and this is the first item
					$statement .= ' AND (zone_id = ' . $z;
					$or = true;
				}elseif($i == $counter){
					// If this is the last item
					$statement .= ' OR zone_id = ' . $z . ')';
				}else{
					// Everything else
					$statement .= ' OR zone_id = ' . $z;
				}
				// Add iteration
				$i+=1;
			}
			$plants = DB::select($statement);
		} // End Else
		$plantList = (array)$plants;
		/* Get the Count */
		$count = count($plants);
		/* Get the Search Filters */
		$filter = array(
			'difficulty' => DB::table('pi_diff')->get(),
			'season' => DB::table('pi_season')->get(),
			'soil' => DB::table('pi_soil')->get(),
			'sun' => DB::table('pi_sun')->get(),
			'type' => DB::table('pi_type')->get(),
			'water' => DB::table('pi_water')->get()
		);
		/* Return it all in a view */
		return View::make('pages.search', array('title' => 'Plant Directory | Flourish – Your Florida Gardening Guide', 'plants' => $plantList, 'thisPanel' => 'search',  'count' => $count, 'filter' => $filter, 'zip' => $zip, 'zone' => $hzone ));
	}

/* Plant Details */
	public function plantDetails($plantId){
		/* Get Data for Specific Plant Chart */
		$plantChart =  DB::select('
			SELECT plant_list.plant_id as id, plant_name, pi_type.plant_type, bot_name, sun_need, soil_need, season_name, diff_detail, water_need, harvest_time  FROM plant_list
			INNER JOIN pi_type ON plant_list.plant_type = pi_type.type_id
			INNER JOIN pi_sun ON plant_list.sun_id = pi_sun.sun_id
			INNER JOIN pi_soil ON plant_list.soil_id = pi_soil.soil_id
			INNER JOIN pi_season ON plant_list.season_id = pi_season.season_id
			INNER JOIN pi_diff ON plant_list.diff_id = pi_diff.diff_id
			INNER JOIN pi_water ON plant_list.water_id = pi_water.water_id
			WHERE plant_list.plant_id = ?', [$plantId]
		);
		/* Images */
		$altImageSrc = DB::table('plant_img')->where('plant_id', $plantId)->get();
		/* Copy Text */
		$plantInfo = DB::table('plant_info')->where('plant_id', $plantId)->get();
		/* Difficulty Level */
		$diff = DB::select('
			SELECT diff_detail FROM pi_diff
			INNER JOIN plant_list
			ON pi_diff.diff_id=plant_list.diff_id
			WHERE plant_list.plant_id = ?', [$plantId]
		);
		/* Parse  Location of Images */
		$plant_diff = '../_images/icons/difficulty/' . $diff["0"]->diff_detail . '.png';
		$image_name = strtolower($plantChart["0"]->plant_name);
		$image_name = str_replace(" ", "_", $image_name);
		$image_name = str_replace("-", "_", $image_name);
		$image_location = '_images/plant_images/' . $image_name . '_main.jpg';

		/* Return view with variables needed */
		return View::make('pages.details', array('title' => ($plantChart["0"]->plant_name . ' | Flourish – Your Florida Gardening Guide'), 'chart' => $plantChart["0"],  'thisPanel' => 'details', 'imgSrc' => $altImageSrc["0"], 'info' => $plantInfo["0"], 'img' => $image_location, 'diff' => $plant_diff));
	}

/* Remove Plant */
  public function removePlant(){
    $pid = Input::get('plant');
    $lname = Input::get('name');
    $lid = Input::get('list');
    if($lid == 'gardens'){
      $lnum = DB::table('garden_plots')->where('user_id', Session::get('user'))->where('garden_name', $lname)->pluck('garden_id');
      DB::table('garden_plots')->where('garden_id', $pid)->delete();
      return Redirect::to('/gp/gardens/');
    }else{
      $lid = Input::get('addList');
      $ulists = User::userLists();
     if($lid != ''){ // If there are lists checked
        // Every list checked should have plant added to DB if it is not in there
        foreach($lid as $l){
          $check = DB::table('user_plants')->where('list_id', $l)->where('plant_id', $pid)->pluck('id');
          if($check == null){ // Add if not in the DB
            DB::table('user_plants')->insert(
              array(
                'user_id'=> Session::get('user'),
                'plant_id'=> $pid,
                'list_id' => $l
                )
            );
          }
          // Check if this list is in the ulists
          foreach($ulists as $u => $v){
            // If it is this list
            if($l == $v){
              // Remove it
              unset($ulists[$u]);
            }
          }
        }
      }
      // Remove everything left on ulists from DB
      foreach($ulists as $ul){
        DB::table('user_plants')->where('plant_id', $pid)->where('list_id', $ul)->delete();
      }

    return Redirect::back();
    }
  }// End Remove Plant

  /* Add Plant */
  public function addPlant(){
    $pid = Input::get('plant');
    $lists = Input::get('addList');
    foreach($lists as $l){
      DB::table('user_plants')->insert(
        array(
          'user_id'=> Session::get('user'),
          'plant_id'=> $pid,
          'list_id' => $l
          )
      );
    }
    return Redirect::to('/search');
  }

}
