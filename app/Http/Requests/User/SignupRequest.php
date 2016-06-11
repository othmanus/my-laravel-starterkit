<?php namespace App\Http\Requests\User;

use App\Http\Requests\Request;

class SignupRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return !\Auth::check();
	}
	
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'first_name' => 'required',
			'last_name' => 'required',
			'phone' => 'required',
			'address' => 'required',
			'city_id'	=> 'required|numeric|exists:cities,id',
			'email' 	=> 'required|email|unique:users',
			'password' 	=> 'required|confirmed|min:4',
		];
	}

}
