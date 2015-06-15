<?php
class PlantController extends BaseController {

/**
 * Setup the layout used by the controller.
 *
 * @return void
 */

/* Plant List */
	public function getPlants()
	{
		/* Select All in Database - Default for no entered zip */
		$plants = DB::select('
			SELECT plant_list.plant_id as id, plant_name, pi_type.plant_type, bot_name, sun_need, soil_need, season_name, diff_detail, water_need, harvest_time  FROM plant_list
			INNER JOIN pi_type ON plant_list.plant_type = pi_type.type_id
			INNER JOIN pi_sun ON plant_list.sun_id = pi_sun.sun_id
			INNER JOIN pi_soil ON plant_list.soil_id = pi_soil.soil_id
			INNER JOIN pi_season ON plant_list.season_id = pi_season.season_id
			INNER JOIN pi_diff ON plant_list.diff_id = pi_diff.diff_id
			INNER JOIN pi_water ON plant_list.water_id = pi_water.water_id;
		');
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
		return View::make('pages.search', array('title' => 'Plant Directory | Flourish – Your Florida Gardening Guide', 'plants' => $plantList, 'count' => $count, 'filter' => $filter ));
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
		return View::make('pages.details', array('title' => ($plantChart["0"]->plant_name . ' | Flourish – Your Florida Gardening Guide'), 'chart' => $plantChart["0"], 'imgSrc' => $altImageSrc["0"], 'info' => $plantInfo["0"], 'img' => $image_location, 'diff' => $plant_diff));

	}
}
