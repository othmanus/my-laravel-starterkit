<?php

namespace App\Http\Controllers\Page;

use Illuminate\Http\Request;

use App\Http\Requests\Page\PageStoreRequest;
use App\Http\Requests\Page\PageUpdateRequest;
use App\Http\Controllers\Controller;

use App\Models\Page\Page;

// use Auth;

class PagesController extends Controller
{
    /*
	|--------------------------------------------------------------------------
	| Backend
	|--------------------------------------------------------------------------
	|
	*/
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$pages = Page::paginate();
		return view('back.pages.index', compact('pages'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param  string $category
	 * @return Response
	 */
	public function category($category)
	{
		$pages = Page::where('category', $category)->paginate();
		return view('back.pages.index', compact('pages'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('back.pages.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(PageStoreRequest $request)
	{
		$input = $request->except('_token', 'images');

		$page = Page::create($input);

		// sauvegarder les images
		if($request->get('images')){
			$page = $page->associateImages($request->get('images'));
			$page = $page->createImageStyles();
		}
		
		return redirect()->route('admin.pages.index')
		->with('message', 'Le page '.$page->title.' est créé');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$page = Page::find($id);
		return view('back.pages.edit', compact('page'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(PageUpdateRequest $request, $id)
	{
		$input = $request->except('_token', 'images');

		// sauvegarder la page
		$page = Page::find($id);
		$page->update($input);

		// sauvegarder les images
		if($request->get('images')){
			$page = $page->associateImages($request->get('images'));
			$page = $page->createImageStyles();			
		}

		// reponse
		return redirect()->route('admin.pages.index')->with('message', 'Le page '.$page->title.' est modifié');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$page = Page::find($id);

		$page->deleteImageStyles();
		
		$page->delete();
		return redirect()->route('admin.pages.index')
		->with('message', "Le page est supprimé");
	}
	
	/*
	|--------------------------------------------------------------------------
	| Frontend
	|--------------------------------------------------------------------------
	|
	*/

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function frontIndex()
	{
		$pages = Page::paginate();
		return view('front.pages.index', compact('pages'));
	}

	/**
	 * Show the the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$page = Page::find($id);
		return view('front.pages.show', compact('page'));
	}

}
