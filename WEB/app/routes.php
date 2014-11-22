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
include_once('routesapi.php');

Route::get('/login', 'UsersController@login');
Route::post('/login', 'UsersController@web_Auth');


Route::group(array('before'=>'auth.admin'),function()
{
	Route::get('/logout', 'UsersController@web_Logout');

	Route::get('admin', function(){
		return View::make("admin.index");
	});
	Route::post('administrator/sendpush','AdminController@sendPush');
    Route::resource('administrator', 'AdminController');
	Route::resource('donations', 'DonationsController');
	Route::resource('bloodsupplies', 'BloodsuppliesController');
});

Route::group(array('before'=>'auth.superadmin'),function()
{
	Route::get('/logout', 'UsersController@web_Logout');

	Route::get('superAdmin', array('as' => 'superAdmin', 'to' => function(){
		return View::make("superAdmin.index");
	}));
	Route::resource('users', 'UsersController');
	Route::resource('institutions', 'InstitutionsController');
});