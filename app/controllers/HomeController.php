<?php

class HomeController extends Controller {

	public function action_index()
	{
		$data = array(
			'user' => Auth::user()
		);
		
		return View::make('site.home', $data);
	}
	
	// =========================== Admin =========================== //
	
	public function action_admin_index()
	{
		 return View::make('admin.index');
	}

}
