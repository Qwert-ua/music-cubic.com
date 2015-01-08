<?php

class ArtistsController extends Controller {

	public function action_index()
	{
		$data = array(
			'artists' => Artist::all()
		);
		
		return View::make('site.artist_list', $data);
	}
	
	public function action_form()
	{
		$genre = Config::get('myconfig.genre');
		natsort($genre);
		
		$data = array(
			'genre' => $genre,
			'country' => Country::orderBy('name')->get()
		);
		
		return View::make('site.artist_form', $data);
	}
	
	public function action_save()
	{
		Artist::save_data(0);
		return Redirect::to('artist');
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
