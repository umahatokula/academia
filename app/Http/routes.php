<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     return view('login');
// });


Route::get('classmethod', function () {
    $reflection = new ReflectionClass('Request');
    dd($reflection->getMethods());
});


Route::group(['middleware' => 'login'], function(){
	//Home Route
	Route::resource('/', 'homeController');


	//Ressults
	Route::post('academics/results/fetchSheet', array('as'=> 'fetchSheet', 'uses' => 'resultsController@fetchSheet'));
	Route::resource('academics/results', 'resultsController');

	Route::resource('admin/parents', 'parentsController');

	Route::resource('admin/students', 'studentsController');

	Route::resource('admin/staff', 'staffController');

	//==========================SETTINGS==========================|
	//============================================================|
	//==========================HEADMASTER ROUTES=================|
	//============================================================|

	Route::group(['middleware' => ['super_administrator']], function(){
		
		//Subjects
		Route::resource('settings/subjects', 'subjectsController');

		//Class
		Route::resource('settings/classes', 'classesController');

		//User
		Route::resource('settings/users', 'usersController');
	});



	//==========================SETTINGS==========================|
	//============================================================|
	//==========================SUPERADMIN ROUTES=================|
	//============================================================|		


	Route::group(['middleware' => 'super_administrator'], function(){	
		//RRoles & Privileges
		Route::post('settings/ajax/rolePermissions', array('as' => 'rolePermissions', 'uses' => 'loginController@rolePermissions'));
		Route::resource('settings/privileges', 'privilegesController');
		Route::resource('settings/roles', 'rolesController');
	});
	

	//Logout
	Route::get('logout', 		array('as' => 'logout', 	'uses' => 'loginController@logout'));
});


// Login
	Route::post('doLogin', 		array('as' => 'doLogin', 		'uses' => 'loginController@doLogin'));

	// Error
	Route::post('error', 		array('as' => 'error', 		'uses' => 'homeController@error'));



