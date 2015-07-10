<?php
class OverviewController extends BaseController {

/* Overview */
	public function getTotals()
	{
		if(Session::get('ustatus') == 1){
			$uid = Session::get('user');
			/* Get totals for various options and add to array*/
			$water = DB::select( 'SELECT DISTINCT water_id FROM plant_list
				JOIN user_plants ON user_plants.plant_id = plant_list.plant_id
				WHERE user_plants.user_id = ' . $uid);
			$sun = DB::select( 'SELECT DISTINCT sun_id FROM plant_list
				JOIN user_plants ON user_plants.plant_id = plant_list.plant_id
				WHERE user_plants.user_id = ' . $uid);
			$soil = DB::select( 'SELECT DISTINCT soil_id FROM plant_list
				JOIN user_plants ON user_plants.plant_id = plant_list.plant_id
				WHERE user_plants.user_id = ' . $uid);
			$diff = DB::select( 'SELECT DISTINCT diff_id FROM plant_list
				JOIN user_plants ON user_plants.plant_id = plant_list.plant_id
				WHERE user_plants.user_id = ' . $uid);
			$allOpts = array(
				'water' => $water,
				'sun' 	=> $sun,
				'soil'	=> $soil,
				'diff'	=> $diff
			);
			$totals = array();
			// Get counts for each option and push to counts array
			foreach($allOpts['water'] as $v){
					$name = DB::table('pi_water')->where('water_id', $v->water_id)->pluck('water_need');
					$finalCount = DB::table('user_plants')
						->join('plant_list', 'user_plants.plant_id', '=', 'plant_list.plant_id')
						->where('user_id', '=', $uid)
						->where('water_id', '=', $v->water_id)
						->count();
						$totals['water'][$name] = $finalCount;
			}
			foreach($allOpts['soil'] as $v){
				$name = DB::table('pi_soil')->where('soil_id', $v->soil_id)->pluck('soil_need');
				$finalCount = DB::table('user_plants')
					->join('plant_list', 'user_plants.plant_id', '=', 'plant_list.plant_id')
					->where('user_id', '=', $uid)
					->where('soil_id', '=', $v->soil_id)
					->count();
					$totals['soil'][$name] = $finalCount;
			}
			foreach($allOpts['sun'] as $v){
				$name = DB::table('pi_sun')->where('sun_id', $v->sun_id)->pluck('sun_need');
				$finalCount = DB::table('user_plants')
					->join('plant_list', 'user_plants.plant_id', '=', 'plant_list.plant_id')
					->where('user_id', '=', $uid)
					->where('sun_id', '=', $v->sun_id)
					->count();
					$totals['sun'][$name] = $finalCount;
			}
			foreach($allOpts['diff'] as $v){
				$name = DB::table('pi_diff')->where('diff_id', $v->diff_id)->pluck('diff_detail');
				$finalCount = DB::table('user_plants')
					->join('plant_list', 'user_plants.plant_id', '=', 'plant_list.plant_id')
					->where('user_id', '=', $uid)
					->where('diff_id', '=', $v->diff_id)
					->count();
					$totals['diff'][$name] = $finalCount;
			}
			// Add in Counts for the iconLinks
			$listNumbers = array(
				"growing"	=> DB::table('user_lists')->where('user_id', $uid)->where('user_listname', 'Growing')->pluck('list_id'),
				"plants"	=> DB::table('user_lists')->where('user_id', $uid)->where('user_listname', 'My List')->pluck('list_id'),
				"waiting"	=> DB::table('user_lists')->where('user_id', $uid)->where('user_listname', 'Waiting')->pluck('list_id')
			);
			$totalGrowing = DB::table('user_plants')->where('list_id', $listNumbers['growing'])->count();
			$totalPlants = DB::table('user_plants')->where('list_id', $listNumbers['plants'])->count();
			$totalPlotted = DB::table('garden_plots')->where('user_id', $uid)->count();
			$totalWaiting = DB::table('user_plants')->where('list_id', $listNumbers['waiting'])->count();
			$totals['counts'] = array(
				'growing' => $totalGrowing,
				'plants' 	=> $totalPlants,
				'plots' 	=> $totalPlotted,
				'waiting' => $totalWaiting
				);
			return View::make('overview', array('title' => 'Garden Overview | Flourish – Your Florida Gardening Guide', 'totals' => $totals));
		}else{
			return View::make('index')->with('title' , 'Flourish – Your Florida Gardening Guide')->with('userattempt', true);
		}
	}

/* Panels */
	public function showPanel($page)
	{
		if(Session::get('ustatus') == 1){
			$userId= Session::get('user');
			// Add in Counts for the iconLinks
			$listNumbers = array(
				"growing"	=> DB::table('user_lists')->where('user_id', $userId)->where('user_listname', 'Growing')->pluck('list_id'),
				"plants"	=> DB::table('user_lists')->where('user_id', $userId)->where('user_listname', 'My List')->pluck('list_id'),
				"waiting"	=> DB::table('user_lists')->where('user_id', $userId)->where('user_listname', 'Waiting')->pluck('list_id')
			);
			$totalGrowing = DB::table('user_plants')->where('list_id', $listNumbers['growing'])->count();
			$totalPlants = DB::table('user_plants')->where('list_id', $listNumbers['plants'])->count();
			$totalPlotted = DB::table('garden_plots')->where('user_id', $userId)->count();
			$totalWaiting = DB::table('user_plants')->where('list_id', $listNumbers['waiting'])->count();
			$totals['counts'] = array(
				'growing' => $totalGrowing,
				'plants' 	=> $totalPlants,
				'plots' 	=> $totalPlotted,
				'waiting' => $totalWaiting
				);
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
				return View::make('pages.gp.'. $page, array('title' => $title, 'plants' => $plantList, 'thisPlant' => $thisPlant, 'thisPanel' => $thisList,  'chart' => $plantChart['0'] , 'info' => $info, 'totals' => $totals ));

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
				return View::make('pages.gp.' . $page, array('title' => 'My Plants Growing | Flourish – Your Florida Gardening Guide', 'lists' => $userPlants, 'count' => $count, 'thisPanel' => $thisList, 'totals' => $totals ));

			/* Gardens */
			}elseif($page == 'gardens'){
				return View::make('pages.gp.' . $page, array('title' => 'My Gardens | Flourish – Your Florida Gardening Guide ', 'totals' => $totals ));
			}


		}else{
			return View::make('index')->with('title' , 'Flourish – Your Florida Gardening Guide')->with('userattempt', true);
		}
	} /* End Show Panel */
} /* Ends Controller Class */
