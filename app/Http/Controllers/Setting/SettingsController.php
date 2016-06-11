<?php namespace App\Http\Controllers\Setting;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\Setting\SettingRequest;
use App\Models\Setting\Setting;

class SettingsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$settings = Setting::getSettings();

		return view('back.settings.index', $settings);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$setting = Setting::find($id);

		$values = $setting->is_array ? $setting->to_array : array();

		return view('back.settings._edit', compact('setting', 'values'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(SettingRequest $request, $id)
	{

		$value = $request->get('value');

		// Supprimer les valeurs vides
		if(is_array($value)) {
			$filtered = array_filter($value);
			$empty = array_filter($value, function($element) {
				return $element == '';
			});
			$clean = array_diff($filtered, $empty);
		} else {
			$clean = $value;
		}

		// Enregistrer		
		$setting = Setting::find($id);
		$setting->value = $clean;		
		$setting->save();

		return redirect()->route('admin.settings.index')->with('message', 'Configuration sauvegardée avec succès');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
