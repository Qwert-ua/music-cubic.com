<?php

class ArtistsController extends Controller {

	public function action_index()
	{
		return View::make('site.index');
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
			return Redirect::to(URL::previous()); 
		}
		else
		{
			return Redirect::to('admin/artists/form/' . $artist->id); 
		}
	}

}
