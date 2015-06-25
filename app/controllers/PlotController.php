<?php
class PlotController extends BaseController {

/* Opening Page  */
	public function startPlotter()
	{
		if(Session::get('ustatus') == 1){
			$uid = 9; /* Change with User Specific Interaction */
			$userList = DB::table('user_lists')->where('user_id', $uid)->get();
			$count = count($userList);
			return View::make('pages.plot_begin', array('title' => 'Garden Plotter | Flourish – Your Florida Gardening Guide', 'count' => $count, 'userList' => $userList));
		}else{
			return View::make('index')->with('title' , 'Flourish – Your Florida Gardening Guide')->with('userattempt', true);
		}
	}

/* New Plot */
	public function newPlot()
	{
		if(Session::get('ustatus') == 1){
			$input = Input::all();
			// Array waiting for Garden Numbers
			$gardenNumber = array();
			$uid = 9; // CHANGE FOR USER INTERACTION
			foreach($input as $i){
				// If gardens have been chosen
				if(strpos($i,'garden_') !== false ){
					// Remove garden_
						$g = str_replace('garden_', '', $i);
					// And push to the GardenNumber array
						array_push($gardenNumber, $g);
				}
			}
			// Array waiting for plants
			$plants = array();
			$z;
			// Go through each garden and add all the plants to one list
			foreach($gardenNumber as $n){
				// If this is a zip code
				if($n == 'zip'){
					// Pull all for zip code
					// $z = DB::select('SELECT zone_number FROM users JOIN zip_zone ON users.zip_code=zip_zone.zipcode WHERE user_id = ?', [$uid] );
					// TEMP ZONE For CURRENT PLANTS
					$z = 9;
					$p = DB::table('plant_list')->where('zone_id', $z)->lists('plant_name');
					foreach($p as $pl){
						array_push($plants, $pl);
					}
				}else{
				// All other zones
					$p = DB::table('plant_list')->leftJoin('user_plants', 'plant_list.plant_id', '=', 'user_plants.plant_id')->where('list_id', $n)->lists('plant_name');
					foreach($p as $pl){
						array_push($plants, $pl);
					}
				}
			}
			// Create empty NewList
			$newList = array();
			// Go through each item in plants and push as individual value to array
			foreach($plants as $pl){
				array_push($newList, $pl);
			}
			$newList = array_unique($newList); // Remove any duplicates
			$newLIst = asort($newList); // Sort alphabetically
			return View::make('pages.plot_new', array('title' => 'New Garden | Flourish – Your Florida Gardening Guide', 'input' => $input, 'plants' => $newList));
		}else{
			return View::make('index')->with('title' , 'Flourish – Your Florida Gardening Guide')->with('userattempt', true);
		}
	}
}
