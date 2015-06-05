<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function(){return View::make('hello'); });
Route::get('home',function(){ return View::make('hello'); });
/* Show Registration */
Route::get('/register', array('uses' => 'HomeController@showRegister'));
/* Process Registration */
Route::post('/register',array('uses' => 'HomeController@doRegister'));
/* Show Login */
Route::get('/login', array('uses' => 'HomeController@showLogin'));
/* Process Login */
Route::post('/login', array('uses' => 'HomeController@doLogin'));
/* Logout */
Route::get('/logout', array('uses' => 'HomeController@doLogout'));
/* Plant Directory */
Route::get('/search', array('uses'=>'PlantController@getPlants'));
/* Plant Details */
Route::get('/details/{id}', array('uses' =>'PlantController@plantDetails'));
Route::get('/calendar', function(){
	return View::make('pages.calendar');
});

Route::get('/overview', function()
{
	return View::make('hello');
});

Route::get('/plot', function()
{
	return View::make('hello');
});

Route::get('/plan', function()
{
	return View::make('hello');
});






