<?php
	
class Album extends Eloquent {

	protected $table = 'album';
	
	public function artist()
	{
    	return $this->belongsTo('Artist');
  	}
	
	public static function isValid($data)
    {
	    $validator = Validator::make($data, [
		    'name' => 'required|max:32',
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
    
    public static function save_data($artist_id, $id)
	{
		$data = Input::all();
		$artist = Artist::find($artist_id);
		$album_slug = Translit::slug(array_get($data, 'name'));
		
		if(self::isValid($data) === true)
		{		
			if($id > 0)
			{
				$album = Album::find($id);
			}
			else
			{
				$album = new Album;
			}
			
			$album->artist_id = $artist_id;
			$album->nickname = $album_slug;
			$album->release = array_get($data, 'release');
			$album->name = array_get($data, 'name');
			$album->save();
			
			if($album->id)
			{
				$dir = self::makeDirectory($artist->nickname, $album_slug);
				$cover = self::upload_cover($artist->nickname, $album_slug);
			
				$album->cover = $cover;
				$album->save();
			}
			
			Session::flash('alert', array('green', 'Ok'));
			
			return $album;
		}
		else
		{
			Session::flash('alert_valid', self::isValid($data)->toArray());
			Session::flash('post', $data);
			
			return false;
		}	
	}
	
	public static function upload_cover($artist, $album) 
	{
		$data = Input::file('cover');
		$input = array('cover' => Input::file('cover'));
	
		$validation = Validator::make($input, array(
			'cover' => 'max:1024|mimes:jpeg,gif,png'
		));
		
		if(!empty($data) && $validation->passes() && !empty($artist)) 
		{
			$dir = './uploads/artists/' . $artist . '/audio/' . $album . '/';
			$file_name = 'cover.' . $data->getClientOriginalExtension();
			
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
	
	public static function makeDirectory($artist, $album)
	{
		$dir = './uploads/artists/' . $artist . '/audio/' . $album;
		
		if(!is_dir($dir))
		{
			mkdir($dir, 0777);
		}
	}
	
}
