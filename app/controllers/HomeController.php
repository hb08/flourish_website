<?php

class HomeController extends BaseController {

/* Index Page */

	public function showRegister()
	{
		return View::make('register')->with('title' , 'Register With Flourish – Your Florida Gardening Guide');
	}
	public function doRegister()
	{

		$user_name = Input::get('user_name');
		$password = Hash::make(Input::get('password')); // Has Password immediately


		$email = Input::get('email');
		$zip_code = Input::get('zip_code');

		$name_search = DB::select('SELECT * FROM users WHERE user_name = ?', array($user_name) );
		if($user_name != $name_search){
			DB::insert('INSERT INTO users(user_name, password, email, zip_code) VALUES( ?, ?, ?, ?)', array($user_name, $password, $email, $zip_code));
			return Redirect::to('/');
		}else{
			return Redirect::route('/');
		}
	}
	public function showLogin()
	{
		return Redirect::to('/');
	}

	public function doLogin()
	{
		$rules = array(
			'user_name' => 'required',
			'password' => 'required|alphaNum|min:3' // Password can only be alphanumeric > 3chars long
		);

		// Run validation rules
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
		    return Redirect::to('login')
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
		    if ($check)
			{
				if( Hash::check($userdata['password'], $check))
				{
					Session::put('ustatus', 1);
		        	return Redirect::to('/');
				}
				return Redirect::to('register');
		    } else {
		        // validation not successful, send back to form
		        echo "Didn't work.\n";
		        echo Input::get('user_name');
		        echo "\n";
		        echo Hash::make(Input::get('password'));

		    }

		}
	}

	public function doLogout()
	{
		Session::forget('ustatus');
		return Redirect::to('/');
	}
}
