<?php
class OverviewController extends BaseController {

/* Overview */
	public function getTotals()
	{
		/* Get totals for plant (ALL FOR NOW) */

		return View::make('overview')->with('title' , 'Garden Overview | Flourish – Your Florida Gardening Guide');
	}

/* Panels */
	public function showPanel($page)
	{
		$userId= 9; /* CHANGE FOR USER SPECIFIC INTERACTION */
		/* If it's Growing or Waiting Panels */
		if($page == 'growing' || $page =='waiting'){
			if($page=='growing'){
			/* Only Growing */
				$thisList = DB::table('user_lists')->where('user_listname', 'Growing')->where('user_id', $userId)->pluck('list_id');
			}elseif($page == 'waiting'){
			/* Only Waiting */
				$thisList = DB::table('user_lists')->where('user_listname', 'Waiting')->where('user_id', $userId)->pluck('list_id');
			}
			/* Both Growing and Waiting */

			/* Select Plants */
			$plantList = DB::select('
						SELECT user_plants.plant_id, plant_name, main_src, seed_src, sprout_src, harvest_src
						FROM user_plants
						INNER JOIN plant_list ON user_plants.plant_id=plant_list.plant_id
						INNER JOIN plant_img ON user_plants.plant_id=plant_img.plant_id
						WHERE user_plants.user_id=?
						AND user_plants.list_id=?;',[$userId, $thisList]);
			/* Default to first item in list if no plant in session */
			if(Session::has('thisPlant')){
				$thisPlant = Session::get('thisPlant');
				Session::forget('thisPlant');
			}else {
				$thisPlant = $plantList[0]->plant_id;
			}
			/* Get Data for Specific Plant Chart */
			$plantChart =  DB::select('
				SELECT plant_list.plant_id as id, plant_name, pi_type.plant_type, bot_name, sun_need, soil_need, season_name, diff_detail, water_need, harvest_time
				FROM plant_list
				INNER JOIN pi_type ON plant_list.plant_type = pi_type.type_id
				INNER JOIN pi_sun ON plant_list.sun_id = pi_sun.sun_id
				INNER JOIN pi_soil ON plant_list.soil_id = pi_soil.soil_id
				INNER JOIN pi_season ON plant_list.season_id = pi_season.season_id
				INNER JOIN pi_diff ON plant_list.diff_id = pi_diff.diff_id
				INNER JOIN pi_water ON plant_list.water_id = pi_water.water_id
				WHERE plant_list.plant_id = ?', [$thisPlant]
			);
			if($page == 'growing'){
				/* Plant info */
				$info = DB::table('plant_info')->where('plant_id', $thisPlant)->pluck('plant_descrip');
				$title = "My Plants Growing | Flourish – Your Florida Gardening Guide";
			}elseif($page == 'waiting'){
				/* Plant info */
				$info = DB::table('plant_info')->where('plant_id', $thisPlant)->pluck('plant_prep');
				$title = "My Plants Waiting | Flourish – Your Florida Gardening Guide";
			}
			/* Return Panel View */
			return View::make('pages.gp.'. $page, array('title' => $title, 'plants' => $plantList, 'thisPlant' => $thisPlant, 'chart' => $plantChart['0'] , 'info' => $info ));

		/* Plants List */
		}elseif($page == 'list'){

			/* Find list number */
			$thisList = DB::table('user_lists')->where('user_listname', 'My List')->where('user_id', $userId)->pluck('list_id');
			/* Get list of plants from DB */
			$userPlants = DB::select('
					SELECT user_plants.plant_id as id, plant_name, pi_type.plant_type, bot_name, sun_need, soil_need, season_name, diff_detail, water_need, harvest_time
					FROM user_plants
					INNER JOIN plant_list ON user_plants.plant_id=plant_list.plant_id
					INNER JOIN pi_type ON plant_list.plant_type = pi_type.type_id
					INNER JOIN pi_sun ON plant_list.sun_id = pi_sun.sun_id
					INNER JOIN pi_soil ON plant_list.soil_id = pi_soil.soil_id
					INNER JOIN pi_season ON plant_list.season_id = pi_season.season_id
					INNER JOIN pi_diff ON plant_list.diff_id = pi_diff.diff_id
					INNER JOIN pi_water ON plant_list.water_id = pi_water.water_id
					WHERE user_plants.user_id=?
					AND user_plants.list_id=?', [$userId, $thisList]);

				/* Count list elements */
				$count = count($userPlants);
			return View::make('pages.gp.' . $page, array('title' => 'My Plant List $title = My Plants Growing | Flourish – Your Florida Gardening Guide', 'lists' => $userPlants, 'count' => $count));
		}

	} /* End Show Panel */

} /* Ends Controller Class */
