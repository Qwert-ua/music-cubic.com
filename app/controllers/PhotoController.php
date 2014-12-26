<?php

class PhotoController extends Controller {

	public function action_index()
	{
		return View::make('site.photo');
	}
	
	public function action_create()
	{
		return View::make('site.photo_create');
	}
	
	public function action_save()
	{
		Photo::save_data();
		return Redirect::to(URL::previous());
	}
	
	public function action_upload()
	{
		return '0';
	}
	
	// =========================== Admin =========================== //
	
	public function action_admin_index()
	{
		 return 'Photo Admin Gallery';
	}

}
