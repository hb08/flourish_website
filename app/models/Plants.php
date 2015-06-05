<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Plants extends Model
{
    protected $table='plant_list';
	
	// Get File For Plant using Id
	static public function getAddres($pName){
		$image_name = strtolower($pName);;
		$image_name = str_replace(" ", "_", $image_name);
		$image_name = str_replace("-", "_", $image_name);
		return $image_name;		
	}
}