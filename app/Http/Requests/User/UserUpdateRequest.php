<?php namespace App\Http\Requests\User;

use App\Http\Requests\AdminRequest;

class UserUpdateRequest extends AdminRequest {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'name' 	=> 'required',
			'role' 	=> 'required',	
			'email' => 'required|email',
		];
	}

}
