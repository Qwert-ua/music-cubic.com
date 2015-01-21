<?php
	
class Artist extends Eloquent {

	protected $table = 'artists';
	
	public function audio()
	{
    	return $this->hasMany('Audio');
  	}
	
	public static function isValid($id, $data)
    {
	    $rule = array(
	    	'name' => 'required|max:128|unique:artists,name,' . $id,
			'group_created' => 'required',
			'genre' => 'required',
			'country' => 'required',
			'city' => 'required',
			'description' => 'required',
		);
	    
	    $validator = Validator::make($data, $rule);
	        
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
		$user = Auth::user();
		
		if(self::isValid($id, $data) === true)
		{		
			if($id > 0)
			{
				$artist = Artist::find($id);
			}
			else
			{
				$artist = new Artist;
				
				$login = Translit::slug(trim(array_get($data, 'name')));
				self::makeDirectory($login);
				$artist->login = $login;
			}
			
			$artist->name = array_get($data, 'name');
			$artist->description = array_get($data, 'description');
			$artist->admins = serialize(array_filter(array_get($data, 'admins', array($user->id)), 'strlen'));
			$artist->group_created = array_get($data, 'group_created');
			$artist->group_closed = array_get($data, 'group_closed');
			$artist->genre = serialize(array_filter(array_get($data, 'genre'), 'strlen'));
			$artist->country = array_get($data, 'country');
			$artist->city = array_get($data, 'city');
			$artist->group_composition = serialize(array_filter(array_get($data, 'group_composition'), 'strlen'));
			$artist->label = array_get($data, 'label');
			$artist->place_base = array_get($data, 'place_base');
			$artist->place_business = array_get($data, 'place_business');
			$artist->links = serialize(array_filter(array_get($data, 'links'), 'strlen'));
			$artist->save();
			
			Session::flash('alert', array('green', 'Save'));
			
			return $artist;
		}
		else
		{
			Session::flash('alert_valid', self::isValid($id, $data)->toArray());
			Session::flash('post', $data);
			
			return false;
		}	
	}
	
	public static function makeDirectory($login)
	{
		$dir = './uploads/artists/' . $login . '/';
		
		if(!is_dir($dir))
		{
			mkdir($dir, 0777);
		}
		
		if(!is_dir($dir . 'audio'))
		{
			mkdir($dir . 'audio', 0777);
		}
		
		if(!is_dir($dir . 'photo'))
		{
			mkdir($dir . 'photo', 0777);
		}
		
		if(!is_dir($dir . 'video'))
		{
			mkdir($dir . 'video', 0777);
		}
	}
	
	public static function destroy_data($id)
	{
		if(!empty($id))
		{
			//$user = Artist::find($id);
			//$user->delete();
			
			//Session::flash('alert', array('green', 'Артист удален'));
		}
	}
	
	public static function upload_icon($id) 
	{
		$artist = self::find($id);
		
		$data = Input::file('image');
		$input = array('image' => Input::file('image'));
		$user = Auth::user();
		
		$validation = Validator::make($input, array(
			'image' => 'required|max:5000|mimes:jpeg,gif,png,bmp'
		));
		
		if($validation->passes() && $user->id) 
		{
			$dir = 'uploads/artists/' . $artist->login;

			$img = Image::make($_FILES['image']['tmp_name']);
			$img->fit(260, 390, function ($constraint) {
				$constraint->upsize();
			});
			$img->save($dir . '/icon.' . $data->getClientOriginalExtension());
		
			$artist->icon = 'icon.' . $data->getClientOriginalExtension();
			$artist->save();
		}
		else
		{
			Session::flash('alert_valid', $validation->messages()->toArray());
			return false;
		}
	}
	
	public static function upload_cover($id) 
	{
		$artist = self::find($id);
		
		$data = Input::file('image');
		$input = array('image' => Input::file('image'));
		$user = Auth::user();
		
		$validation = Validator::make($input, array(
			'image' => 'required|max:5000|mimes:jpeg,gif,png,bmp'
		));
		
		if($validation->passes() && $user->id) 
		{
			$dir = 'uploads/artists/' . $artist->login;

			$file_name = 'cover.' . $data->getClientOriginalExtension();
			$data->move($dir, $file_name);
		
			$artist->cover = $file_name;
			$artist->save();
		}
		else
		{
			Session::flash('alert_valid', $validation->messages()->toArray());
			return false;
		}
	}
}
