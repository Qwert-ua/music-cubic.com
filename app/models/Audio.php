<?php
	
class Audio extends Eloquent {

	protected $table = 'audio';
	
	public function artists()
	{
    	return $this->belongsTo('Artist', 'artist');
  	}
  	
  	public function album()
	{
    	return $this->belongsTo('Album');
  	}
	
	public static function isValid($id, $data)
    {
	    $validator = Validator::make($data, [
		    'name' => 'required|max:32|unique:audio,name,' . $id,
		    'album' => 'max:32|unique:audio,album,' . $id
	    ]);
	        
        if($validator->passes()) 
		{
			return true;
		}
		else
		{
			return $validator->messages();
		}
    }
    
    public static function save_data($id)
	{
		$data = Input::all();
		
		if(self::isValid($id, $data) === true)
		{		
			if($id > 0)
			{
				$audio = Audio::find($id);
			}
			else
			{
				/* author -> release_album -> cover && file(author_release_album_file.mp3) */
				
				$audio = new Audio;
				
				$artist_name = Translit::slug(Artist::find(array_get($data, 'artist'))->name);
				$album_name = Translit::slug(array_get($data, 'album'));
				$track_name = Translit::slug(array_get($data, 'name'));
					
				$dir = self::makeDirectory($artist_name);
				
				if(array_get($data, 'album'))
				{
					$dir = self::makeDirectory($artist_name, array_get($data, 'release'), $album_name);
					$cover = self::upload_cover($album_name, $dir);
				}
				else
				{
					$cover = self::upload_cover($track_name, $dir);
				}
			}
			
			$audio->artist = array_get($data, 'artist');
			$audio->name = array_get($data, 'name');
			$audio->album = array_get($data, 'album');
			$audio->release = array_get($data, 'release');
			$audio->dir = $dir;
			$audio->cover = $cover;
			$audio->file = self::upload_file($track_name, $dir);
			$audio->save();
			
			Session::flash('alert', array('green', 'Ok'));
			
			return $audio;
		}
		else
		{
			Session::flash('alert_valid', self::isValid($id, $data)->toArray());
			//Session::flash('post', $data); Input::flashOnly('username', 'email'); Input::old('username');
			
			return false;
		}	
	}
	
	public static function destroy_data($id)
	{
		if(!empty($id))
		{
			$user = Audio::find($id);
			$user->delete();
			
			Session::flash('alert', array('green', 'Удалено'));
		}
	}
	
	public static function makeDirectory($artist, $release = false, $album = false)
	{
		if(!empty($album))
		{
			$dir = $artist . '/' . $release . '-' . $album;
		}
		else
		{
			$dir = $artist;
		}
		
		if(!is_dir('./uploads/music/' . $dir))
		{
			mkdir('./uploads/music/' . $dir, 0777);
		}
		
		return $dir;
	}
	
	public static function upload_cover($name, $dir) 
	{
		$data = Input::file('cover');
		$input = array('cover' => Input::file('cover'));
		
		$validation = Validator::make($input, array(
			'cover' => 'max:1024|mimes:jpeg,gif,png'
		));
		
		if($validation->passes() && !empty($name)) 
		{
			$dir = './uploads/music/' . $dir . '/';
			$file_name = $name . '.' . $data->getClientOriginalExtension();
			
			$img = Image::make($_FILES['cover']['tmp_name']);
			$img->fit(250, 250, function ($constraint) {
				$constraint->upsize();
			});
			$img->save($dir . $file_name);
		
			return $file_name;
		}
		else
		{
			Session::flash('alert_valid', $validation->messages()->toArray());
			return false;
		}
	}
	
	public static function upload_file($name, $dir) 
	{
		$data = Input::file('audio');
		$input = array('audio' => Input::file('audio'));
		
		$validation = Validator::make($input, array(
			'audio' => 'max:15360|mimes:bin,mp4a,mpga'
		));
		
		if($validation->passes() && $data->getClientOriginalExtension() == 'mp3') 
		{
			$dir = './uploads/music/' . $dir . '/';
			$file_name = $name . '.mp3';
			
			$data->move($dir, $file_name);
		
			return $file_name;
		}
		else
		{
			Session::flash('alert_valid', $validation->messages()->toArray());
			return false;
		}
	}
	
	public static function upload_audio($album_id, $id) 
	{
		$data = Input::all();
		$album = Album::find($album_id);
		
		$validator = Validator::make($data, [
		    'name' => 'required|max:32|unique:audio,name,' . $id
	    ]);
	        
        if($validator->passes()) 
		{
			$data = Input::file('file');
			$input = array('file' => Input::file('file'));
			
			$validation = Validator::make($input, array(
				'file' => 'max:25600|mimes:bin,mp4a,mpga'
			));
			
			if($validation->passes()) 
			{
				$dir = './uploads/artists/' . $album->artist->nickname  . '/audio/' . $album->nickname . '/';
				$file_name = Translit::slug(Input::get('name')) . '.mp3';
				
				$data->move($dir, $file_name);
				
				$audio = new Audio;
				$audio->artist_id = $album->artist->id;
				$audio->album_id = $album_id;
				$audio->name = Input::get('name');
				$audio->file = $file_name;
				$audio->save();
			
				return $file_name;
			}
			else
			{
				Session::flash('alert_valid', $validation->messages()->toArray());
				return false;
			}
		}
		else
		{
			Session::flash('alert_valid', $validator->messages()->toArray());
			return false;
		}
	}
	
}
