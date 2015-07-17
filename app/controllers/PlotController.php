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
					$hzone = DB::table('hzone')->where('zone_number', $z)->pluck('hz_id');
					$zoneRange = array();
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
			$gardenId = Session::get('gid');
			Session::forget('gid');
			$name = Input::get('garden_name');
			$check = DB::table('garden_plots')->where('user_id', Session::get('user'))->where('garden_name', $name)->pluck('garden_id');
			$i = 1;
			$garden_code = Input::get('shapes');
			$gardenSize = array(
				'width' => Input::get('width'),
				'height' =>Input::get('height')
			);
			$gardenSize = json_encode($gardenSize);
			// Check if this is a current garden, rename if it is not
			if($gardenId){
				$name = $name;
			}
			if($check > 0 ){
				$name .= "_" . $i;
			}
			// Add to database
			DB::table('garden_plots')->insert(
				array('user_id' => Session::get('user'), 'garden_name' => $name,  'garden_code' => $garden_code, 'garden_img' => Input::get('garden'), 'garden_size' => $gardenSize )
			);
			return Redirect::to('/gp/gardens');
		}

	/* Edit Plot */
	public function editPlot($garden){
			$gardenId = $garden;
			$thisGarden = DB::table('garden_plots')->where('garden_id', $gardenId)->select('garden_name as name', 'garden_code as code', 'garden_size as size')->get();
			// Array waiting for Garden Numbers
			$gardenNumber = array();
			$plants = array();
			$uid = Session::get('user');
			$code = $thisGarden['0']->code;
			$size = json_decode($thisGarden['0']->size);
			$garden_name = $thisGarden['0']->name;
			// Pull all for zip code
			$z = DB::table('zip_zone')->where('zipcode', Session::get('zip'))->pluck('zone_number');
			$hzone = DB::table('hzone')->where('zone_number', $z)->pluck('hz_id');
			$zoneRange = array();
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
				case 'Florida':
					$zoneRange = [ '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'. '13', '14', '15', '16', '17', '18', '19'];
					break;
			}
			foreach($zoneRange as $zr){
				$names = DB::table('plant_list')->where('zone_id', $zr)->lists('plant_name');
				foreach($names as $n){
					array_push($plants, $n);
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
			return View::make('pages.plot.plot_edit', array('title' => 'Edit Garden | Flourish – Your Florida Gardening Guide', 'size' => $size, 'code' => $code, 'plants' => $newList, 'gid' => $gardenId, 'garden_name' => $garden_name));
	}
}
