<?php

class Playlist extends Eloquent {

	protected $table = 'playlist';
	
	public function audio()
    {
        return $this->belongsToMany('Audio', 'playlist_audio');
    }

	public static function save_data($id)
	{
		$user = Auth::user();
		$data = Input::all();
		
		$validator = Validator::make($data, [
		    'name' => 'required|max:64',
	    ]);
	        
        if($validator->passes()) 
		{
			if($id > 0)
			{
				$playlist = Playlist::find();
			}
			else
			{
				$playlist = new Playlist();
			}
			
			$playlist->name = array_get($data, 'name');
			$playlist->user = $user->id;
			$playlist->save();
			//$playlist->audio()->detach();
			//$user->audio()->attach(1);
			
			Session::flash('alert', array('green', 'Ok'));
			return $playlist;
		}
		else
		{
			Session::flash('alert_valid', $validator->messages()->toArray());
			return false;
		}

	}
}
