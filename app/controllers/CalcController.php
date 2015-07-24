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
			// Ged all Milestones
			$dbMile = DB::table('user_milestones')->where('user_id', Session::get('user'))->select('plant_id', 'm_type', 'end_date')->get();
			// Containers
			$holdP = array();
			$holdMsprout = array();
			$holdMthin = array();
			$holdMfert = array();
			$holdH = array();
			$plantNames = array();
			// Get plants from growing list
			$pgDb = DB::table('user_plants')->where('list_id', $listId['gid'])->lists('plant_id');
			foreach($pgDb as $pg){
				$thisName = DB::table('plant_list')->where('plant_id', $pg)->pluck('plant_name');
				$plant = array(
					'id' => $pg,
					'name' => $thisName,
				);
				array_push($plantNames, $plant);
			}
			// Plant Milestone Array
			$plantMilestones = array();
			// Add milestones for each array
			foreach($dbMile as $pL){
				$pName = DB::table('plant_list')->where('plant_id', $pL->plant_id)->pluck('plant_name');
				$strDate = strtotime($pL->end_date);
				$formatDate = date('M jS', $strDate);
				$milestoneList = array(
					'pid' => $pL->plant_id,
					'pname' => $pName,
					'type' => $pL->m_type,
					'end_date'	=> $formatDate,
					'raw_date' =>$pL->end_date
				);
				if($pL->m_type == 0){
					array_push($holdMsprout, $milestoneList);
				}else	if($pL->m_type == 1){
					array_push($holdMthin, $milestoneList);
				}else	if($pL->m_type == 2){
					array_push($holdMfert, $milestoneList);
				}else	if($pL->m_type == 3){
					array_push($holdH, $milestoneList);
				}else	if($pL->m_type == 4){
					array_push($holdP, $milestoneList);
				}
			}
			$plantMilestones = array(
				'plant'	=>  $holdP,
				'sprout'	=>  $holdMsprout,
				'thin'	=>  $holdMthin,
				'fert'	=>  $holdMfert,
				'harv'	=>  $holdH,
			);
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
		$types = array(
			"sprout"	=> 0,
			"thin"		=> 1,
			"fert" 		=> 2,
			"harv" 		=> 3,
			"plant"		=> 4,
		);
		// Find plant milestone days for events selected
		for($i = 0; $i < count($milestones); $i++){
			if($milestones[$i] == 'Planting'){
				$thisType = $types['plant'];
				$thisMilestone = array(
					"user_id" 		=> Session::get('user'),
					"plant_id" 		=> $id,
					"m_type" 			=> $thisType,
					"start_date"	=> $start,
					"end_date"		=> $start,
				);
					// Push all to Database
					array_push($mdates, $thisMilestone);
			}elseif($milestones[$i] == 'Misc'){
				$days = array(
					array('type' => $types['fert'],'time' => DB::table('plant_list')->where('plant_id', $id)->pluck('fertilize_time')),
					array('type' => $types['thin'],'time' => DB::table('plant_list')->where('plant_id', $id)->pluck('thin_time')),
					array('type' => $types['sprout'],'time' => DB::table('plant_list')->where('plant_id', $id)->pluck('sprout_time'))
				);
				foreach($days as $day){
					if(!empty($day['time'])){
						$time = (int)$day['time'];
						// Add days to start date to find end date
						$thisDate = date('Y-m-d', strtotime($start. " + " . $time . 'days'));
						$thisMilestone = array(
							"user_id" 		=> Session::get('user'),
							"plant_id" 		=> $id,
							"m_type" 			=> $day['type'],
							"start_date"	=> $start,
							"end_date"		=> $thisDate,
						);
						// Push all to Database
						array_push($mdates, $thisMilestone);
					}
				}
			}elseif($milestones[$i] == 'Harvest'){
				$thisType = $types['harv'];
				$days = DB::table('plant_list')->where('plant_id', $id)->pluck('harvest_time');
				$days = (int)$days;
				if(!empty($days)){
					// Add days to start date to find end date
					$thisDate = date('Y-m-d', strtotime($start. " + " . $days . 'days'));
					$thisMilestone = array(
						"user_id" 		=> Session::get('user'),
						"plant_id" 		=> $id,
						"m_type" 			=> $thisType,
						"start_date"	=> $start,
						"end_date"		=> $thisDate,
					);
					// Push all to Database
					array_push($mdates, $thisMilestone);
				}
			}
		}
	// Cycle through all the milestone dates
	for($i = 0; $i < count($mdates); $i++){
		$thisM = $mdates[$i];
		// Otherwise Add it into DB
		DB::table('user_milestones')->insert(array(
				'user_id' => $thisM['user_id'],
				'plant_id' => $thisM['plant_id'],
				'm_type' => $thisM['m_type'],
				'start_date' => $thisM['start_date'],
				'end_date' => $thisM['end_date']
			));
	}
	return Redirect::action('CalcController@showMilestone');
	}
}
