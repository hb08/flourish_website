<?php
use App\Plants;
use App\Users;

/* Home Page */
Route::get('/', function(){
	return View::make('index')->with('title' , 'Flourish – Your Florida Gardening Guide');
});
Route::get('home',function(){
	return View::make('index')->with('title' , 'Flourish – Your Florida Gardening Guide');
});

/* Plant Directory */
Route::get('/search', array('uses'=>'PlantController@getPlants'));
/* Plant Search */
Route::post('/newSearch', array('uses'=>'PlantController@searchPlants'));
/* Plant Details */
Route::get('/details/{id}', array('uses' =>'PlantController@plantDetails'));

/* Calendar */
Route::get('/calendar', function(){
	if(Session::get('ustatus') == 1){
		return View::make('pages.calendar')->with('title' , 'My Garden Calendar | Flourish – Your Florida Gardening Guide');
	}else{
		return View::make('index')->with('title' , 'Flourish – Your Florida Gardening Guide')->with('userattempt', true);
	}
});

/* Overview */
Route::get('/overview', array('uses' => 'OverviewController@getTotals'));
/* Overview Panels */
Route::get('/gp/{page}', array('uses' => 'OverviewController@showPanel'));


/* Get Specific Plant */
Route::get('/gp/view/{page}/{plant}', function($page, $plant){
	if(Session::get('ustatus') == 1){
		Session::put('thisPlant', $plant);
		return Redirect::action('OverviewController@showPanel', array('page' => $page));
	}else{
		return View::make('index')->with('title' , 'Flourish – Your Florida Gardening Guide')->with('userattempt', true);
	}
});

/* Garden Plotter */
Route::get('/plot', array('uses' => 'PlotController@startPlotter'));
/* New Garden */
Route::post('/plot/new', array('uses' => 'PlotController@newPlot'));
/* Process Registration */
Route::post('/register',array('uses' => 'HomeController@doRegister'));
/* Process Login */
Route::post('/login', array('uses' => 'HomeController@doLogin'));
/* Logout */
Route::get('/logout', array('uses' => 'HomeController@doLogout'));
