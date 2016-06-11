<?php

/*
|==========================================================================
|==========================================================================
| Front end
|==========================================================================
|==========================================================================
|
| All front end routes
|
|==========================================================================
*/
Route::group([], function() {

	/*
	|--------------------------------------------------------------------------
	| Application Routes
	|--------------------------------------------------------------------------
	|
	| Here is where you can register all of the routes for an application.
	| It's a breeze. Simply tell Laravel the URIs it should respond to
	| and give it the controller to call when that URI is requested.
	|
	*/
	Route::get('/', function () {
	    return view('welcome');
	});

	Route::auth();

	Route::get('/home', 'HomeController@index');

});

/*
|==========================================================================
|==========================================================================
| Back end
|==========================================================================
|==========================================================================
|
| All backend routes (administration pages)
|
|==========================================================================
*/

/*
|==========================================================================
|
| Administrator role
|
|==========================================================================
*/
Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function()
{
	/*
	|--------------------------------------------------------------------------
	| Users management
	|--------------------------------------------------------------------------
	*/
	Route::resource(
		'users', 
		'User\UsersController', 
		['except' => 'show', 'roles' => ['root']]
	);
	
	Route::put('users/{id}/change-password', [
		'middleware' => ['auth'],
		'as' 	=> 'admin.users.changePassword', 
		'uses' 	=> 'User\UsersController@changePassword'
	]); 
});


/*
|==========================================================================
|
| Moderator role
|
|==========================================================================
*/
Route::group(['prefix' => 'admin', 'middleware' => ['moderator']], function()
{

	/*
	|--------------------------------------------------------------------------
	| Dashboard
	|--------------------------------------------------------------------------
	*/
	Route::get('/', ['as' => 'admin.index', function() {
		return view('back.index');
	}]);

	/*
	|--------------------------------------------------------------------------
	| Pages management
	| Common pages as : About us, Services, Terms Policy, etc.
	|--------------------------------------------------------------------------
	*/
	Route::resource('pages', 'Page\PagesController', ['except' => 'show']);
	
	Route::get('pages/{category}', [
		'as' => 'admin.pages.category',
		'uses' => 'Page\PagesController@category'
	]);
});

/*
|==========================================================================
|==========================================================================
| JSON routes
|==========================================================================
|==========================================================================
|
| All JSON routes for Dropzone and API
|
|==========================================================================
*/
Route::group(['prefix' => 'json', 'middleware' => ['ajax', 'moderator']], function()
{	
	/*
	|--------------------------------------------------------------------------
	| Images management
	|--------------------------------------------------------------------------
	*/
	// Upload an image from dropzonejs
	Route::post('images/dropzone/upload', [
		'as' 	=> 'admin.images.dropzone.upload', 
		'uses' 	=> 'Image\ImagesController@dropzoneUpload',
	]);

	// Get an image for dropzonejs
	Route::get('images/dropzone/get/{id}', [
		'as' 	=> 'admin.images.dropzone.get', 
		'uses' 	=> 'Image\ImagesController@dropzoneGet',
		'roles' => ['administrator'],
	]);

	// Edit image's properties
	Route::get('images/dropzone/edit/{id}', [
		'as' 	=> 'admin.images.dropzone.edit', 
		'uses' 	=> 'Image\ImagesController@dropzoneEdit',
	]);

	// Update an image
	Route::post('images/dropzone/update/{id}', [
		'as' 	=> 'admin.images.dropzone.update', 
		'uses' 	=> 'Image\ImagesController@dropzoneUpdate',
	]);

	// Delete image 
	Route::delete('images/dropzone/delete', [
		'as' 	=> 'admin.images.dropzone.delete', 
		'uses' 	=> 'Image\ImagesController@dropzoneDelete',
	]);

	// Sort images
	Route::post('images/dropzone/sort', [
		'as' 	=> 'admin.images.dropzone.sort', 
		'uses' 	=> 'Image\ImagesController@dropzoneSort',
	]);
});