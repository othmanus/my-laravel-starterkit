<?php

namespace App\Http\Controllers\Image;

use Illuminate\Http\Request;

use App\Models\Image\Image;
use App\Http\Requests\Image\ImageStoreRequest;
use App\Http\Requests\Image\ImageUpdateRequest;
use App\Http\Controllers\Controller;

class ImagesController extends Controller
{
    /** 
	 * Upload image from dropzone callback
	 * 
	 * @return json
	 */
	public function dropzoneUpload(ImageStoreRequest $request)
	{

		$file = $request->file('file');

		if($file) {
			$filename = $file->getClientOriginalName();
			$upload_success = $file->move(public_path('temp'), $filename);
			// $upload_success = $file->copy(public_path('temp'), $filename);

			if ($upload_success) {
				$image = Image::create(['file_name' => $filename, 'path' => public_path('temp')."/{$filename}"]);

				return response()->json(['success' => true, 'image' => $image], 200);
			} else {
				return response()->json('error', 400);
			}
		}
	}

	/** 
	 * Get image from dropzone callback
	 * 
	 * @return json
	 */
	public function dropzoneGet($id)
	{
		return Image::find($id);
	}


	/** 
	 * Edit image from dropzone callback
	 * 
	 * @return json
	 */
	public function dropzoneEdit($id)
	{
		$image = Image::find($id);
		return view('back.images._edit', compact('image'));
	}

	/** 
	 * Update image from dropzone callback
	 * 
	 * @return json
	 */
	public function dropzoneUpdate(ImageRequest $request, $id)
	{
		$input = $request->except('_token', '_method');
		// $input['subtitle'] = $input['subtitle'] && $input['subtitle'] != 'undefined' ? $input['subtitle'] : '';
		$image = Image::find($id);
		$image->update($input);

		if ($image) {
			return response()->json('success', 200);
		} else {
			return response()->json('error', 400);
		}
	}

	/** 
	 * Delete image from dropzone callback
	 * 
	 * @return json
	 */
	public function dropzoneDelete(ImageRequest $request)
	{
		$file = $request->get('name');
		$id = $request->get('id');
		$style = $request->get('style');
		$image = $this->image->find($id);
		
		if(!$style) {
			$upload_success = \File::delete(public_path("temp\\".$file));
		} else {
			$upload_success = $image->deleteStyles($file, config('images.'.$style));
		}
		$image->delete();

		if ($upload_success) {
			return response()->json('success', 200);
		} else {
			return response()->json('error', 400);
		}
		
	}

	/** 
	 * Sort images from jquery-ui sortable callback
	 * 
	 * @return json
	 */
	public function dropzoneSort(Request $request)
	{
		// Init position
		$pos = 0;
		// get images ids
		$ids = $request->get('sortable');
		if(!$ids)
			return response()->json('error', 400);

		// update positions
		foreach($ids as $id) {
			$image = Image::find($id);
			if($image) {
				$image->position = $pos;
				$image->save();
				$pos++;
			}
		}

		return response()->json('success', 200);

	}
	
}
