<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

// Get user Information - used in Login
	static public function userInfo($uid){
		$userName = DB::table('users')->where('user_id', $uid)->pluck('user_name');
		$userEmail= DB::table('users')->where('user_id', $uid)->pluck('email');
		$userZip = DB::table('users')->where('user_id', $uid)->pluck('zip_code');
		$user = array(
			'name' => $userName,
			'email' => $userEmail,
			'zip' => $userZip,
		);
		return $user;
	}
}
