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
	Route::post('selectcity', 'AjaxController@action_selectcity');
	Route::post('uploadphoto/{id}', 'AjaxController@action_uploadimages');
	Route::post('getgallery', 'AjaxController@action_getgallery');
	Route::post('imgdel', 'AjaxController@action_imgdel');
	Route::post('images_sort', 'AjaxController@action_imagessort');
	Route::post('geocountry', 'AjaxController@action_geo_country');
	Route::post('geocity', 'AjaxController@action_geo_city');
});

Route::get('admin/auth', 'AuthController@action_admin_index');
Route::post('admin/auth/login', array('before' => 'csrf', 'uses' => 'AuthController@action_admin_login'));
Route::get('admin/auth/logout', 'AuthController@action_admin_logout');

Route::group(array('before' => 'auth.admin', 'prefix' => 'admin'), function()
{
    Route::get('/', 'HomeController@action_admin_index');
    
    Route::get('users/{role?}', 'UsersController@action_admin_index');
    Route::get('users/form/{id?}', 'UsersController@action_admin_form');
    Route::post('users/save/{id?}', array('before' => 'csrf', 'uses' => 'UsersController@action_admin_save'));
    Route::get('users/destroy/{id}', 'UsersController@action_admin_destroy');
    
    Route::get('complaints', 'ComplaintsController@action_admin_index');
    
    Route::get('artists', 'ArtistsController@action_admin_index');
    Route::get('artists/form/{id?}', 'ArtistsController@action_admin_form');
    Route::post('artists/save/{id?}', array('before' => 'csrf', 'uses' => 'ArtistsController@action_admin_save'));
    Route::get('artists/destroy/{id?}', 'ArtistsController@action_admin_destroy');
    
    Route::get('legal', 'LegalController@action_admin_index');
    Route::get('audio', 'AudioController@action_admin_index');
    Route::get('poster', 'PosterController@action_admin_index');
    Route::get('statistics', 'StatisticsController@action_admin_index');
    
    Route::get('photo', 'PhotoController@action_admin_index');
});

Route::get('auth', 'AuthController@action_index');
Route::post('auth/login', array('before' => 'csrf', 'uses' => 'AuthController@action_login'));
Route::get('auth/logout', 'AuthController@action_logout');

Route::get('registration', 'RegistrationController@action_index');
Route::post('registration/send', array('before' => 'csrf', 'uses' => 'RegistrationController@action_send')); 
Route::get('activation/{activation?}', 'RegistrationController@action_activation');

Route::group(array('before' => 'auth.user'), function()
{
	Route::get('/', 'HomeController@action_index');	
	
	Route::post('uploadicon', array('before' => 'csrf', 'uses' => 'UsersController@action_upload_icon'));
	
	Route::get('edit', 'UsersController@action_edit');
	Route::post('edit', array('before' => 'csrf', 'uses' => 'UsersController@action_save'));

    Route::get('{username}/photo', 'PhotoController@action_index');
    Route::get('photo/album/{id?}', 'PhotoController@action_album');
    Route::post('photo/save/{id?}', array('before' => 'csrf', 'uses' => 'PhotoController@action_save'));
    Route::get('photo/editalbum/{id}', 'PhotoController@action_edit_album');
    Route::get('photo/delalbum/{id}', 'PhotoController@action_delete_album');
    
    Route::get('artist', 'ArtistsController@action_list');
    Route::get('artist/new', 'ArtistsController@action_form');
    Route::post('artist/save/{id?}', array('before' => 'csrf', 'uses' => 'ArtistsController@action_save'));
    Route::get('artist/{artist}/edit', 'ArtistsController@action_form');
    Route::get('artist/{artist}', 'ArtistsController@action_index');
    Route::post('artist/uploadicon/{id}', array('before' => 'csrf', 'uses' => 'ArtistsController@action_upload_icon'));
    Route::post('artist/uploadcover/{id}', array('before' => 'csrf', 'uses' => 'ArtistsController@action_upload_cover'));
	Route::get('artist/{artist}/albums', 'ArtistsController@action_albums');
	Route::post('artist/createaudioalbum/{id}', array('before' => 'csrf', 'uses' => 'ArtistsController@action_createaudioalbum'));
	Route::get('artist/{artist}/album/{album}', 'ArtistsController@action_album_view');
	Route::post('artist/uploadaudio/{album_id}/{id?}', array('before' => 'csrf', 'uses' => 'ArtistsController@action_uploadaudio'));
	
    Route::get('{username}/audio', 'AudioController@action_index');
    Route::get('audio/add', 'AudioController@action_form');
    Route::post('audio', array('before' => 'csrf', 'uses' => 'AudioController@action_upload'));
    Route::post('audio/create-playlist', array('before' => 'csrf', 'uses' => 'AudioController@action_createplaylist'));
    
});









