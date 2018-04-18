<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', array('as' => 'index','uses' => 'AlbumController@getList'));
Route::get('/createalbum', array('as' => 'create_album_form','uses' => 'AlbumController@getForm'));
Route::get('/album/{id}', array('as' => 'show_album','uses' => 'AlbumController@getAlbum'));
Route::post('/createalbum', array('as' => 'create_album','uses' => 'AlbumController@postCreate'));
Route::delete('/deletealbum/{id}', array('as' => 'delete_album','uses' => 'AlbumController@deleteAlbum'));

Route::get('/addimage/{id}', array('as' => 'add_image','uses' => 'ImageController@getForm'));
Route::post('/addimage', array('as' => 'add_image_to_album','uses' => 'ImageController@postAdd'));
Route::delete('/deleteimage/{id}', array('as' => 'delete_image','uses' => 'ImageController@deleteImage'));

Route::get('contact', 'ContactController@getForm')->name('contact.getForm');
Route::post('contact', 'ContactController@send')->name('contact.send');

Route::get('/mailable', function () {
    return new App\Mail\ContactEmail();
});
