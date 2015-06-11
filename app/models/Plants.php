<?php

use Illuminate\Database\Eloquent\Model;

class Plants extends Eloquent {

  protected $table='plant_list';

	// Get File For Plant using Id
	static public function getAddress($pName, $type){
		$image_name = strtolower($pName);;
		$image_name = str_replace(" ", "_", $image_name);
		$image_name = str_replace("-", "_", $image_name);
    $image_location = '_images/plant_images/' . $image_name . '_'. $type . '.jpg';
		return $image_location;
	}
}
