<?php

class AudioController extends Controller {

	public function action_index()
	{
		$data = array(
			'audio' => Audio::all()
		);
		
		return View::make('site.audio_list', $data);
	}
	
	public function action_form()
	{
		$data = array(
			'artists' => Artist::all()
		);
		
		return View::make('site.audio_uploads', $data);
	}

	public function action_upload($id = 0)
	{
		Audio::save_data($id);
		
		return Redirect::back();
	}
	
	// =========================== Admin =========================== //
	
	public function action_admin_index()
	{
		return View::make('admin.index');
	}

}
