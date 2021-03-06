<?php

/*
|--------------------------------------------------------------------------
| Register The Laravel Class Loader
|--------------------------------------------------------------------------
|
| In addition to using Composer, you may use the Laravel class loader to
| load your controllers and models. This is useful for keeping all of
| your classes in the "global" namespace without Composer updating.
|
*/

ClassLoader::addDirectories(array(

	app_path().'/commands',
	app_path().'/controllers',
	app_path().'/models',
	app_path().'/helpers',
	app_path().'/database/seeds',

));

/*
|--------------------------------------------------------------------------
| Application Error Logger
|--------------------------------------------------------------------------
|
| Here we will configure the error logger setup for the application which
| is built on top of the wonderful Monolog library. By default we will
| build a basic log file setup which creates a single file for logs.
|
*/

Log::useFiles(storage_path().'/logs/laravel.log');

/*
|--------------------------------------------------------------------------
| Application Error Handler
|--------------------------------------------------------------------------
|
| Here you may handle any errors that occur in your application, including
| logging them or displaying custom views for specific errors. You may
| even register several error handlers to handle different types of
| exceptions. If nothing is returned, the default error view is
| shown, which includes a detailed stack trace during debug.
|
*/

App::error(function(Exception $exception, $code)
{
	Log::error($exception);
});

/*
|--------------------------------------------------------------------------
| Maintenance Mode Handler
|--------------------------------------------------------------------------
|
| The "down" Artisan command gives you the ability to put an application
| into maintenance mode. Here, you will define what is displayed back
| to the user if maintenance mode is in effect for the application.
|
*/

App::down(function()
{
	return Response::make("Be right back!", 503);
});

/*
|--------------------------------------------------------------------------
| Require The Filters File
|--------------------------------------------------------------------------
|
| Next we will load the filters file for the application. This gives us
| a nice separate location to store our route and application filter
| definitions instead of putting them all in the main routes file.
|
*/

require app_path().'/filters.php';

/*
|--------------------------------------------------------------------------
| Custom Form
|--------------------------------------------------------------------------
*/

Form::macro('artist', function($value = null, $attr = array())
{
	$out = '<select name="artist" ';
	
	foreach($attr as $k_attr=>$v_attr)
	{
		$out .= $k_attr . '="' . $v_attr . '"';
	}
	
	$out .= '>';
	
	$out .= '<option';
	if(empty($value)) $out .= ' selected="selected"';
	$out .= 'style="display:none;">' . trans('trans.form.sel_option') . '</option>';
	
	foreach(Artist::orderBy('name')->get() as $val)
	{
		$out .= '<option value="' . $val->id . '"';
		if($value == $val->id) $out .= ' selected="selected"';
		$out .= '>' . $val->name . '</option>';
	}
			
	$out .= '</select>';
	
	return $out;
});

Form::macro('track', function($value = null, $attr = array())
{
	$out = '<select name="track" ';
	
	foreach($attr as $k_attr=>$v_attr)
	{
		$out .= $k_attr . '="' . $v_attr . '"';
	}
	
	$out .= '>';
	
	$out .= '<option';
	if(empty($value)) $out .= ' selected="selected"';
	$out .= ' style="display:none;">' . trans('trans.form.sel_option') . '</option>';
	
	foreach(Audio::orderBy('album')->orderBy('track')->get() as $val)
	{
		$out .= '<option value="' . $val->id . '"';
		if($value == $val->id) $out .= ' selected="selected"';
		$out .= ' data-subtext="' . $val->album . '">' . $val->track . '</option>';
	}
			
	$out .= '</select>';
	
	return $out;
});

Form::macro('album', function($value = null, $attr = array())
{
	$out = '<select name="album" ';
	
	foreach($attr as $k_attr=>$v_attr)
	{
		$out .= $k_attr . '="' . $v_attr . '"';
	}
	
	$out .= '>';
	
	$out .= '<option';
	if(empty($value)) $out .= ' selected="selected"';
	$out .= ' style="display:none;">' . trans('trans.form.sel_option') . '</option>';
	
	foreach(Audio::where('album', '!=', '')->orderBy('album')->get() as $val)
	{
		$out .= '<option value="' . $val->id . '"';
		if($value == $val->id) $out .= ' selected="selected"';
		$out .= '>' . $val->album . '</option>';
	}
			
	$out .= '</select>';
	
	return $out;
});

Form::macro('selectYearRange', function($name, $value = null, $attr = array())
{
	$out = '<select name="' . $name . '" ';
	
	foreach($attr as $k_attr=>$v_attr)
	{
		$out .= $k_attr . '="' . $v_attr . '"';
	}
	
	$out .= '>';
	
	$out .= '<option';
	if(empty($value)) $out .= ' selected="selected"';
	$out .= ' style="display:none;">' . trans('trans.form.sel_option') . '</option>';
	
	for($i = date('Y'); $i >= 1900; $i--)
	{
		$out .= '<option value="' . $i. '"';
		if($value == $i) $out .= ' selected="selected"';
		$out .= '>' . $i . '</option>';
	}
			
	$out .= '</select>';
	
	return $out;
});



