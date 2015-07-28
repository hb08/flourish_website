<?php

class HomeController extends BaseController {

/* Register */
	public function doRegister()
	{
		// Input to Variables
		$user_name = Input::get('user_name');
		$password = Hash::make(Input::get('password')); // Has Password immediately
		$email = Input::get('email');
		$zip_code = Input::get('zip_code');

		// Search for username
		$name_search = DB::table('users')->where('user_name', $user_name)->pluck('user_id');
		// If there is no such user already
		if(is_null($name_search)){
			// Add to account
			DB::insert('INSERT INTO users(user_name, password, email, zip_code) VALUES( ?, ?, ?, ?)', array($user_name, $password, $email, $zip_code));
			$uid = DB::table('users')->where('user_name', $user_name)->pluck('user_id');
			$userZip = DB::table('users')->where('user_id', $uid)->pluck('zip_code');
			// Add User Id and Zip to SESSION USER
			Session::put('user', $uid);
			Session::put('zip', $userZip);
			// Create Mandatory Plant Lists
			DB::table('user_lists')->insert(array(
				array('user_id' => $uid, 'user_listname' => 'Growing'),
				array('user_id' => $uid, 'user_listname' => 'Waiting'),
				array('user_id' => $uid, 'user_listname' => 'My List'),
			));
			// Return to Previous Page
			return Redirect::back();
		// If there is a user with this name already
		}else{
			// Return with message
			$msg = $user_name . " is a user already. Please try logging in with that name, or registering a new one.";
			return Redirect::back()->with('errorMsg', $msg);
		}
		var_dump( $name_search);
	}
/* Logging in */
	public function doLogin()
	{
		$rules = array(
			'user_name' => 'required',
			'password' => 'required|alphaNum|min:3' // Password can only be alphanumeric > 3chars long
		);

		// Run validation rules
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
				return Redirect::back()
		        ->withErrors($validator) // send back all errors to the login form
		        ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
		} else {

			// create our user data for the authentication
			$userdata = array(
					'user_name'     => Input::get('user_name'),
					'password'		=> Input::get('password')
			);
		$check = DB::table('users')->where('user_name', $userdata['user_name'])->pluck('password');
			// attempt to do the login
			if ($check)	{
				if( Hash::check($userdata['password'], $check)){
					// Add User Status, Id, and Zip to SESSION USER
					$uid = DB::table('users')->where('user_name', $userdata['user_name'])->pluck('user_id');
					$userZip = DB::table('users')->where('user_id', $uid)->pluck('zip_code');
					Session::put('ustatus', 1);
					Session::put('user', $uid);
					Session::put('zip', $userZip);
							return Redirect::back();
				}
				Session::put('errorMsg', 'Incorrect Login!');
			return Redirect::to('/');
			} else {
					// validation not successful, send back to form
					return Redirect::to('/');
			}
	}
}
/* Logout */
	public function doLogout()
	{
		Session::flush();
		Auth::logout();
		return Redirect::to('/');
	}
/* User Update */
	public function updateUser()
	{
		$uid = Session::get('user');
		$new = Input::all();
		DB::table('users')
			->where('user_id', $uid)
			->update(array(
				'email' => $new['email'],
				'zip_code' => $new['zip_code']
		));
		$userZip = DB::table('users')->where('user_id', $uid)->pluck('zip_code');
		Session::forget('zip');
		Session::put('zip', $userZip);
		return Redirect::back();
	}
}
