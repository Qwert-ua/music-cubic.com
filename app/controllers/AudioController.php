<?php

class AudioController extends Controller {

	public function action_index()
	{
		$user = Auth::user();
		
		$data = array(
			'audio' => Audio::all(),
			'artist' => Audio::all(),
			'palylist' => Playlist::where('user', '=', $user->id)->get()
		);
		
		return View::make('site.audio_list', $data);
	}
	
	public function action_form()
	{
		$data = array(
			'artists' => Artist::all()
		);
		
		return View::make('site.audio_form', $data);
	}

	public function action_upload($id = 0)
	{
		Audio::save_data($id);
		
		return Redirect::back();
	}
	
	public function action_createplaylist()
	{
		Playlist::save_data(0);
		return Redirect::back();
	}
	
	// =========================== Admin =========================== //
	
	public function action_admin_index()
	{
		return View::make('admin.index');
	}

}
