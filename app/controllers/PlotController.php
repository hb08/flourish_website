<?php
class PlotController extends BaseController {

/* Opening Page  */
	public function startPlotter()
	{
		if(Session::get('ustatus') == 1){
			$uid = Session::get('user');
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
		if(Session::get('ustatus') == 1){ // User Logged In
			$input = Input::all();
			// Array waiting for Garden Numbers
			$gardenNumber = array();
			$uid = Session::get('user');
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
					$z = (int) DB::table('zip_zone')->where('zipcode', Session::get('zip'))->pluck('zone_number');
					$zoneRange;
					// Ensure Zone is entire selection for Zip
					switch($z){
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
		          break;
					}
					foreach($zoneRange as $zr){
						$names = DB::table('plant_list')->where('zone_id', $zr)->lists('plant_name');
						foreach($names as $n){
							array_push($plants, $n);
						}
					}
				}elseif((int)$n > 0){
				// All other zones
					$list = DB::table('user_plants')->where('list_id', $n)->lists('plant_id');
					foreach($list as $l){
						$names = DB::table('plant_list')->where('plant_id', $l)->pluck('plant_name');
						array_push($plants, $names);
					}
				}
			}
			// Create empty NewList
			$newList = array();
			// Go through each item in plants and push as individual value to array
			foreach($plants as $pl){
				array_push($newList, $pl);
			}
			// Make sure it's all unique
			$newList = array_unique($newList);
			// Alphabetize the list
			sort($newList);
			return View::make('pages.plot_new', array('title' => 'New Garden | Flourish – Your Florida Gardening Guide', 'input' => $input, 'plants' => $newList));
		}else{ // User Not Logged In
			return View::make('index')->with('title' , 'Flourish – Your Florida Gardening Guide')->with('userattempt', true);
		}
	}

	/* Save Garden  */
		public function saveGarden(){
			$name = Input::get('garden_name');
			$check = DB::table('garden_plots')->where('user_id', Session::get('user'))->where('garden_name', $name)->pluck('garden_id');
			$i = 1;
			// Check if this is a current garden, rename if it is not
			if($check > 0 ){
				$name .= "_" . $i;
			}
			DB::table('garden_plots')->insert(
				array('user_id' => Session::get('user'), 'garden_name' => $name, 'garden_plants' => Input::get('plants'), 'garden_code' => Input::get('shapes'), 'garden_img' => Input::get('garden') )
			);
			return Redirect::to('/gp/gardens');
		}
}
