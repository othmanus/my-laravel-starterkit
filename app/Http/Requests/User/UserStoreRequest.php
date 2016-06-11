<?php 
namespace App\Http\Requests\User;

use App\Http\Requests\AdminRequest;

class UserStoreRequest extends AdminRequest {


	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'name' 	=> 'required',
			'role' => 'in:user,administrator,moderator',
			'email' 	=> 'required|email|unique:users,email',
			'password' 	=> 'required|confirmed|min:6',
		];
	}

}
