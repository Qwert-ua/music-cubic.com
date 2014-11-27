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

Route::pattern('id', '[0-9]+');
Route::pattern('role', '[0-9]+');

Route::group(array('before' => 'ajax', 'prefix' => 'ajax'), function()
{
	Route::post('notify', array('before' => 'ajax', 'uses' =>'AjaxController@action_notify'));
	Route::post('selectcity', array('before' => 'ajax', 'uses' =>'AjaxController@action_selectcity'));
});

Route::get('admin/auth', 'AuthController@action_admin_index');
Route::post('admin/auth/login', 'AuthController@action_admin_login');
Route::get('admin/auth/logout', 'AuthController@action_admin_logout');

Route::group(array('before' => 'auth.admin', 'prefix' => 'admin'), function()
{
    Route::get('/', 'HomeController@action_admin_index');
    
    Route::get('users/{role?}', 'UsersController@action_admin_index');
    Route::get('users/form/{id?}', 'UsersController@action_admin_form');
    Route::post('users/save/{id?}', 'UsersController@action_admin_save');
    Route::get('users/destroy/{id}', 'UsersController@action_admin_destroy');
    
    Route::get('complaints', 'ComplaintsController@action_admin_index');
    
    Route::get('artists', 'ArtistsController@action_admin_index');
    Route::get('artists/form/{id?}', 'ArtistsController@action_admin_form');
    Route::post('artists/save/{id?}', 'ArtistsController@action_admin_save');
    
    Route::get('legal', 'LegalController@action_admin_index');
    Route::get('audio', 'AudioController@action_admin_index');
    Route::get('poster', 'PosterController@action_admin_index');
    Route::get('statistics', 'StatisticsController@action_admin_index');
});

Route::get('auth', 'AuthController@action_index');
Route::post('auth/login', 'AuthController@action_login');
Route::get('auth/logout', 'AuthController@action_logout');

Route::get('registration', 'RegistrationController@action_index');
Route::post('registration/send', 'RegistrationController@action_send');
Route::get('activation/{activation?}', 'RegistrationController@action_activation');

Route::group(array('before' => 'auth.user'), function()
{
	Route::get('/', 'HomeController@action_index');	
	Route::post('uploadicon', 'UsersController@action_upload_icon');
	Route::get('edit', 'UsersController@action_edit');
	Route::post('edit', 'UsersController@action_save');
});









