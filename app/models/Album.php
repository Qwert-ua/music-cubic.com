<?php
	
class Album extends Eloquent {

	protected $table = 'album';
	
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
    
    public static function save_data($artist, $id)
	{
		$data = Input::all();
		
		if(self::isValid($data) === true)
		{		
			if($id > 0)
			{
				$album = Album::find($id);
			}
			else
			{
				$album = new Album;
				
				//$artist_slug = strtoupper(Translit::slug(Artist::find(array_get($data, 'artist'))->name));
					
				//$dir = self::makeDirectory($artist_slug);
				
				//$cover = self::upload_cover($track_slug, $dir);
			}
			
			$audio->artist = $artist;
			$audio->cover = $cover;
			$audio->release = array_get($data, 'release');
			$audio->name = array_get($data, 'name');
			$audio->save();
			
			Session::flash('alert', array('green', 'Ok'));
			
			return true;
		}
		else
		{
			Session::flash('alert_valid', self::isValid($id, $data)->toArray());
			Session::flash('post', $data);
			
			return false;
		}	
	}
	
}
