<?php

class PhotoController extends Controller {

	public function action_index($username)
	{
		$data = array(
			'albums' => Photo::get_album($username)
		);
		
		return View::make('site.photo', $data);
	}
	
	public function action_album($id = false)
	{
		$data = array(
			'post'   => Input::all(),
			'album' => Photo::get_album($id),
			'user' => Auth::user()
		);		
		
		return View::make('site.photo_album', $data);
	}
	
	public function action_edit_album($id = false)
	{
		$data = array(
			'post'   => Input::all(),
			'album' => Photo::get_album($id),
			'user' => Auth::user()
		);		
		
		return View::make('site.photo_edit_album', $data);
	}
	
	public function action_save($id = 0)
	{
		$photo = Photo::save_data($id);
		
		if(!empty($photo))
		{
			return Redirect::to('photo/editalbum/' . $photo->id);
		}
		else
		{
			return Redirect::back();
		}
	}
	
	public function action_delete_album($id)
	{
		Photo::destroy_data($id);
		return Redirect::to(Auth::user()->username . '/photo');
	}
	
	// =========================== Admin =========================== //
	
	public function action_admin_index()
	{
		 return 'Photo Admin Gallery';
	}

}
