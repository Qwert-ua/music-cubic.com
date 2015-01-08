<?php
	
class Artist extends Eloquent {

	protected $table = 'artists';
	
	public function audio()
	{
    	return $this->hasMany('Audio');
  	}
	
	public static function isValid($id, $data)
    {
	    $rule = array();
	     
	    $rule['name'] = 'required|min:6|max:32|unique:artists,name,' . $id;
	    //$rule['admins'] = 'required';
	    $rule['group_created'] = 'required';
	    //$rule['group_closed'] = 'required';
	    $rule['genre'] = 'required';
	    $rule['country'] = 'required';
	    $rule['city'] = 'required';
	    //$rule['group_composition'] = 'required';
	    //$rule['label'] = 'required|min:3|max:64';
	    //$rule['place_base'] = 'required';
	    //$rule['place_business'] = 'required';
	    //$rule['links'] = 'required';
	    
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
			}
			
			$artist->name = array_get($data, 'name');
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
			
			Session::flash('alert', array('green', 'Ok'));
			
			return $artist;
		}
		else
		{
			Session::flash('alert_valid', self::isValid($id, $data)->toArray());
			Session::flash('post', $data);
			
			return false;
		}	
	}
	
	public static function destroy_data($id)
	{
		if(!empty($id))
		{
			$user = Artist::find($id);
			$user->delete();
			
			Session::flash('alert', array('green', 'Артист удален'));
		}
	}
	
	public static function get_name($id)
	{
		return Artist::find($id)->name;
	}
}
