<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {

    Route::get('/', function () {
        return view('welcome');
    })->middleware('guest');

    Route::get('/main', 'VillageController@index');
    Route::get('/army', 'ArmyController@index');
    Route::get('/maps', 'VillageController@maps');

    Route::get('/army/{id}', 'ArmyController@getArmy');

    Route::post('/armyLvlUp', 'ArmyController@levelup');
    Route::post('/recruit', 'ArmyController@recruit');
    Route::post('/attack', 'ArmyController@attack');

    Route::post('/lvlup', 'VillageController@levelup');
    Route::post('/change', 'VillageController@changeName');

    Route::auth();

});
