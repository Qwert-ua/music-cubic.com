<?php

class ArtistsController extends Controller {

	public function action_index($name)
	{
		$data = array(
			'artist' => Artist::where('login', '=', $name)->first()
		);
		
		return View::make('site.artist', $data);
	}
	
	public function action_list()
	{
		$data = array(
			'artists' => Artist::all()
		);
		
		return View::make('site.artist_list', $data);
	}
	
	public function action_form($name = null)
	{	
		$data = array(
			'edit' => true,
			'artist' => !empty($name) ? Artist::where('login', '=', $name)->first() : Session::get('post'),
			'genre' => Genre::lists('name', 'id'),
			'country' => Country::orderBy('name')->get()
		);
		
		return View::make('site.artist_form', $data);
	}
	
	public function action_save($id = 0)
	{
		$artist = Artist::save_data($id);
		
		return Redirect::back(); ///Redirect::to('artist/' . $artist->login);
	}
	
	public function action_upload_icon($id)
	{
		Artist::upload_icon($id);
		return Redirect::back();
	}
	
	public function action_upload_cover($id)
	{
		Artist::upload_cover($id);
		return Redirect::back();
	}
	
	public function action_albums($name)
	{
		$data = array(
			'artist' => !empty($name) ? Artist::where('login', '=', $name)->first() : Session::get('post')
		);
		
		return View::make('site.artist_albums', $data);
	}
	
	public function action_createaudioalbum()
	{
		Dump::p( Input::all() );
	}
	
	// =========================== Admin =========================== //
	
	public function action_admin_index()
	{ 
		$data = array(
			'artists' => Artist::all()
		);
		
		return View::make('admin.artists', $data);
	}
	
	public function action_admin_form($id = 0)
	{
		$genre = Config::get('myconfig.genre');
		natsort($genre);
		
		$data = array(
			'id' => $id,
			'artists' => Artist::find($id),
			'genre' => $genre,
			'users' => Role::find(1)->users,
			'country' => Country::orderBy('name')->get()
		);
		
		return View::make('admin.artists_form', $data);
	}
	
	public function action_admin_save($id)
	{
		$artist = Artist::save_data($id);
		
		if($artist === false)
		{
			return Redirect::back(); 
		}
		else
		{
			return Redirect::to('admin/artists/form/' . $artist->id); 
		}
	}
	
	public function action_admin_destroy($id)
	{
		$artist = Artist::destroy_data($id);
		
		return Redirect::back(); 
	}

}
