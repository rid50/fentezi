<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\MessageBag;
use Validator;
use App\Album;

class AlbumController extends Controller
{
	public function __construct() 
    {
		config(['upload_folder' => 'upload_folder']);
	}
	
	public function getList()
	{
		$albums = Album::with('Photos')->get();
		//error_log (print_r(compact('albums')), 3, '../err.log');
		//return view('index',compact('albums'));
		return view('index')->with('albums', $albums);
	}

	public function getAlbum($id)
	{
		$album = Album::with('Photos')->find($id);
		$albums = Album::with('Photos')->get();
		return view('album', ['album'=>$album, 'albums'=>$albums]);
	}

	public function getForm()
	{
		return view('createalbum');
	}

	public function postCreate(Request $request)
	{
		$validationRules = array(
			'name' => 'required',
			'description' => 'required',
			'cover_image'=>'required|image'
		);

		$messages = [
			'cover_image.required' => 'Выберите обложку для альбома',
		];
		
		$validator = Validator::make($request->all(), $validationRules, $messages);
		if($validator->fails()){
			return redirect()->route('create_album_form')->withErrors($validator)->withInput();
		}

		$file = $request->file('cover_image');
		$random_name = str_random(8);
		$destinationPath = config('upload_folder');
		$extension = $file->getClientOriginalExtension();
		$filename=$random_name.'_cover.'.$extension;
		$uploadSuccess = $request->file('cover_image')->move($destinationPath, $filename);
		$album = Album::create(array(
			'name' => $request->get('name'),
			'description' => $request->get('description'),
			'cover_image' => $filename,
		));

		return redirect()->route('show_album',['id'=>$album->id]);
	}

	public function deleteAlbum($id)
	{
		$album = Album::find($id);
		//error_log (print_r(config('upload_folder') . "/" . $album->cover_image), 3, '../err.log');
		foreach($album->Photos as $photo)
			unlink(config('upload_folder') . "/" . $photo->image);

		unlink(config('upload_folder') . "/" . $album->cover_image);
			
		$album->delete();
		//return back()
		//->with('success','Image removed successfully.');

		return Redirect::route('index');
	}
}
