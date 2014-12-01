<?php

class AudioController extends Controller {

	public function action_index()
	{
		$data = array(
			'artists' => Artist::all()
		);
		
		return View::make('site.audio_uploads', $data);
	}

	public function action_upload()
	{
		$data = Input::all();

		$author = Translit::slug(array_get($data, 'author'));
		$album = Translit::slug(array_get($data, 'album'));
		$release = array_get($data, 'release');
		
		echo $author;
		echo '<br />';
		echo $release . '_' . $album;
		echo '<br />';
		echo $author . '_' . $release . '_' . $album . '_namefile.mp3';

		/*

			author -> release_album -> cover && file(author_release_album_file.mp3)

		*/
	}
	
	// =========================== Admin =========================== //
	
	public function action_admin_index()
	{
		return View::make('admin.index');
	}

}
