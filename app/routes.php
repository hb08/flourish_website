<?php
/* Main Page */
Route::get('/', function(){return View::make('hello'); });
Route::get('home',function(){ return View::make('hello'); });
/* Plant Directory */
Route::get('/search', array('uses'=>'PlantController@getPlants'));
/* Plant Details */
Route::get('/details/{id}', array('uses' =>'PlantController@plantDetails'));
/* Calendar */
Route::get('/calendar',function(){
	return View::make('pages.calendar');
});
/* Overview */
Route::get('/overview', array('uses'=>'OverviewController@getTotals'));

Route::get('/plot', function()
{
	return View::make('hello');
});

Route::get('/plan', function()
{
	return View::make('hello');
});
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








