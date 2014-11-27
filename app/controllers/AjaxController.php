<?php

class AjaxController extends Controller {

	public function action_notify()
	{		
		/*
			green - success
			blue - info 
			yellow - warning
			red - danger
		*/
			
		$data = array();
		
		if($alert = Session::get('alert')) 
		{
			$data['alert'] = $alert;
		}
		
		if($validation_error = Session::get('alert_valid')) 
		{
			$data['alert_valid'] = $validation_error;
		}
		
		if(count($data) > 0) echo json_encode($data);
	
		
		Session::forget('alert');
		Session::forget('alert_valid');
	}
	
	public function action_selectcity()
	{
		$data = Input::all();
		$city = City::where('country_id', '=', $data['country_id'])->get()->toJson();
		echo $city;
	}

}
