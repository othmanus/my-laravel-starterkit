<?php namespace App\Http\Requests\User;

use App\Http\Requests\AdminRequest;

class UserChangePasswordRequest extends AdminRequest {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			// 'password_old' 	=> 'required|min:4',
			'password' 	=> 'required|confirmed|min:6',
		];
	}

}
