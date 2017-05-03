<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    $indexPath = public_path('_index.html');
//
//    return \Response::make(file_get_contents($indexPath));
//});

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
Route::get('/calendar', array('uses' => 'CalcController@showMilestone'));
Route::post('/addMilestone', array('uses' => 'CalcController@addMilestone'));

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
Route::post('/saveGarden', array('uses' => 'PlotController@saveGarden'));
/* Edit Garden */
Route::get('/plot/edit/{id}', array('uses' => 'PlotController@editPlot'));

/* Process Registration */
Route::post('/register',array('uses' => 'HomeController@doRegister'));
/* Process Login */
Route::post('/login', array('uses' => 'HomeController@doLogin'));
/* Logout */
Route::get('/logout', array('uses' => 'HomeController@doLogout'));
/* Update Account */
Route::post('/profile', array('uses' => 'HomeController@updateUser'));

/* Remove Items */
Route::post('/removeItem', array('uses' => 'PlantController@removePlant'));
/* Add Items */
Route::post('/addItem', array('uses' => 'PlantController@addPlant'));
