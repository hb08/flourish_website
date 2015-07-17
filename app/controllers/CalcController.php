<?php

class CalcController extends BaseController {

/* Register */
	public function showMilestone(){
		if(Session::get('ustatus') == 1){
			// User Id
			$uid = Session::get('user');
			// Plants
			$listId = array(
				'gid' 	=> 	DB::table('user_lists')->where('user_id', $uid)->where('user_listname', 'Growing')->pluck('list_id'),
				'wid' 	=> 	DB::table('user_lists')->where('user_id', $uid)->where('user_listname', 'Waiting')->pluck('list_id'),
				'mlid' 	=> 	DB::table('user_lists')->where('user_id', $uid)->where('user_listname', 'My List')->pluck('list_id')
			);
			$plantList = array();
			// Plant Id List
			foreach($listId as $lid){
					$plants = DB::select('SELECT plant_id FROM user_plants WHERE list_id = ?', [$lid]);
					for($i = 0; $i < count($plants); $i++){
						array_push($plantList,$plants[$i]->plant_id);
					}
			}
			$plantNames = array();
			// Plant Milestone Array
			$plantMilestones = array();
			// Add milestones for each array
			foreach($plantList as $pL){
				$pName = DB::table('plant_list')->where('plant_id', $pL)->pluck('plant_name');
				$milestoneList = array(
					'pid' => $pL,
					'pname' => $pName,
					'harvest' => DB::table('plant_list')->where('plant_id', $pL)->pluck('harvest_time'),
					'sprout' => DB::table('plant_list')->where('plant_id', $pL)->pluck('sprout_time'),
					'sow' => DB::table('plant_list')->where('plant_id', $pL)->pluck('sow_time'),
					'thin' => DB::table('plant_list')->where('plant_id', $pL)->pluck('thin_time'),
					'fertilize' => DB::table('plant_list')->where('plant_id', $pL)->pluck('fertilize_time'),
				);
				$plant = array(
					'id' => $pL,
					'name' => $pName
				);
				array_push($plantNames, $plant);
				array_push($plantMilestones, $milestoneList);
			}
			// Plant name list
			return View::make('pages.calendar', array('title' => 'My Garden Calendar | Flourish – Your Florida Gardening Guide', 'pnames' => $plantNames, 'milestones'=> $plantMilestones));
		}else{
			return View::make('index')->with('title' , 'Flourish – Your Florida Gardening Guide')->with('userattempt', true);
		}
	}

	public function addMilestone(){
		$id = Input::get('name');
		$start = Input::get('startDate');
		$milestones = Input::get('addMilestone');
		$mdates = array();
		// Find plant milestone days for events selected
		for($i = 0; $i < count($milestones); $i++){
			if($milestones[$i] == 'Planting'){
				$days = DB::table('plant_list')->where('plant_id', $id)->pluck('sow_time');
				if(!empty($days)){

				}
			}elseif($milestones[$i] == 'Misc'){
				$days = array(
					'fertilize_time' => DB::table('plant_list')->where('plant_id', $id)->pluck('fertilize_time'),
					'thin_time' => DB::table('plant_list')->where('plant_id', $id)->pluck('thin_time'),
					'sprout_time' => DB::table('plant_list')->where('plant_id', $id)->pluck('sprout_time')
				);
				foreach($days as $day){
					if(!empty($day)){

					}
				}
			}elseif($milestones[$i] == 'Harvest'){
				$days = DB::table('plant_list')->where('plant_id', $id)->pluck('harvest_time');
				if(!empty($days)){

				}
			}
		}
		// Add days to start date to find end date

		// Push all to Database

		return Redirect::action('CalcController@showMilestone');
	}
}
