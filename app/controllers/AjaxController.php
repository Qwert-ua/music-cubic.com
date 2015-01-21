<?php

class AjaxController extends Controller {

	public function action_selectcity()
	{
		$data = Input::all();
		$city = City::where('country_id', '=', $data['country_id'])->get()->toJson();
		echo $city;
	}
	
	public function action_uploadimages($id)
	{
		if(Photo::upload_images($id))
		{
			echo '{"status":"success"}';
		    exit;
		}
		else
		{
			echo '{"status":"error"}';
			exit;
		}
	}
	
	public function action_getgallery()
	{
		return Photo::get_photos(Input::get('id'), true);
	}
	
	public function action_imgdel()
	{
		if(Photo::delete_img(Input::get('img')))
		{
			$data = array(
				'status' => array(
					'color' => 'yellow',
					'text' => 'Рисунок удален'
				)
			);
		}
		else
		{
			$data = array(
				'status' => array(
					'color' => 'red',
					'text' => 'Не удалось удалить рисунок'
				)
			);
		}
		
		echo json_encode($data);
	}
	
	public function action_imagessort()
	{
		foreach(Input::get('sort') as $key => $val)
		{
			$photo = Photo::find($val);
			$photo->position = $key + 1;
			$photo->save();
		}
	}
	
	public function action_geo_country()
	{
		$data = array();
		
		$data['query'] = Input::get('query');
		$arr_query = array();
		
		foreach(Country::where('name', 'LIKE', '%' . Input::get('query') . '%')->limit(10)->get() as $val)
		{
			$arr_query[] = array(
				'value' => $val->name,
				'data' => $val->id
			);
		}
		
		$data['suggestions'] = $arr_query;
		
		return json_encode($data);
	}
	
	public function action_geo_city()
	{
		$data = array();
		
		$data['query'] = Input::get('query');
		$arr_query = array();
		
		foreach(City::where('country_id', '=', Input::get('country'))->where('name', 'LIKE', '%' . Input::get('query') . '%')->limit(10)->get() as $val)
		{
			$arr_query[] = array(
				'value' => $val->name,
				'data' => $val->id
			);
		}
		
		$data['suggestions'] = $arr_query;
		
		return json_encode($data);
	}
	
}
