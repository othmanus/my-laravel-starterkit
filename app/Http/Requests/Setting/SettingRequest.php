<?php namespace App\Http\Requests\Setting;

use App\Http\Requests\Request;

class SettingRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return \Auth::check();
	}
	
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			// 'key' => 'required|alpha_num|unique:settings',
			'value' => 'required',
		];
	}

}
