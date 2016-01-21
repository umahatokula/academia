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
		
		//Fee Elements
		Route::get('billing/fee_elements/{id}/activate', array('as'=>'billing.fee_elements.activate', 'uses'=>'feeElementsController@activate'));
		Route::get('billing/fee_elements/{id}/deactivate', array('as'=>'billing.fee_elements.deactivate', 'uses'=>'feeElementsController@deactivate'));
		Route::resource('billing/fee_elements', 'feeElementsController');

		//Fee Schedules
		Route::get('billing/fee_schedules/{id}/activate', array('as'=>'billing.fee_schedules.activate', 'uses'=>'feeSchedulesController@activate'));
		Route::get('billing/fee_schedules/{id}/deactivate', array('as'=>'billing.fee_schedules.deactivate', 'uses'=>'feeSchedulesController@deactivate'));
		Route::get('billing/fee_schedules/{id}/bill_class', array('as'=>'billing.fee_schedules.bill_class', 'uses'=>'feeSchedulesController@billClass'));
		Route::resource('billing/fee_schedules', 'feeSchedulesController');

		//Invoices
		Route::get('billing/invoices/{fee_schedule_code}/bill_class', array('as'=>'billing.invoices.bill_class', 'uses'=>'invoicesController@bill_class'));
		Route::post('billing/invoices/class_invoices', array('as'=>'billing.invoices.class_invoices', 'uses'=>'invoicesController@class_invoices'));
		Route::get('billing/invoices/{student_id}/{fee_schedule_code}/student_invoice', array('as'=>'billing.invoices.student_invoice', 'uses'=>'invoicesController@student_invoice'));
		Route::get('billing/invoices/{student_id}/{fee_schedule_code}/edit_student_invoice', array('as'=>'billing.invoices.edit_student_invoice', 'uses'=>'invoicesController@edit_student_invoice'));
		Route::post('billing/invoices/update_student_invoice', array('as'=>'billing.invoices.update_student_invoice', 'uses'=>'invoicesController@update_student_invoice'));
		Route::get('billing/invoices/{student_id}/{fee_schedule_code}/mail_invoice', array('as'=>'billing.invoices.mail_invoice', 'uses'=>'invoicesController@mail_invoice'));
		Route::resource('billing/invoices', 'invoicesController');

		//Discount Policies
		Route::get('billing/edit_parent_policy', array('as'=>'billing.discount_policies.edit_parent_policy', 'uses'=>'discountPolicyController@edit_parent_policy'));
		Route::get('billing/edit_staff_policy', array('as'=>'billing.discount_policies.edit_staff_policy', 'uses'=>'discountPolicyController@edit_staff_policy'));
		Route::get('billing/edit_scholarship_policy', array('as'=>'billing.discount_policies.edit_scholarship_policy', 'uses'=>'discountPolicyController@edit_scholarship_policy'));
		Route::PUT('billing/update_parent_policy', array('as'=>'billing.discount_policies.update_parent_policy', 'uses'=>'discountPolicyController@update_parent_policy'));
		Route::PUT('billing/update_staff_policy', array('as'=>'billing.discount_policies.update_staff_policy', 'uses'=>'discountPolicyController@update_staff_policy'));
		Route::PUT('billing/update_scholarship_policy', array('as'=>'billing.discount_policies.update_scholarship_policy', 'uses'=>'discountPolicyController@update_scholarship_policy'));
		Route::resource('billing/discount_policies', 'discountPolicyController');

		//Student Ledgers
		Route::resource('billing/student_ledger', 'studentsLedgerController');





		//Subjects
		Route::resource('settings/subjects', 'subjectsController');

		//Class
		Route::resource('settings/classes', 'classesController');

		//School
		Route::resource('settings/school', 'schoolController');

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

//Logout
	Route::get('login', 		array('as' => 'login', 		'uses' => 'loginController@login'));

// Login
	Route::post('doLogin', 		array('as' => 'doLogin', 	'uses' => 'loginController@doLogin'));

// Error
	Route::get('error', 		array('as' => 'error', 		'uses' => 'homeController@error'));



