<?php

class LegalController extends Controller {

	public function action_index()
	{
		return View::make('site.index');
	}
	
	// =========================== Admin =========================== //
	
	public function action_admin_index()
	{
		return View::make('admin.index');
	}

}
