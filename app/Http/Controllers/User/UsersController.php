<?php 
namespace App\Http\Controllers\User;

use Auth;
use App\Models\User\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;

use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\SignupRequest;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Requests\User\UserChangePasswordRequest;

// use App\Services\Notification\NotificationService;
// use App\Notifications\User\ConfirmSignup;

class UsersController extends Controller {

	// use NotificationService;

    /*
	|--------------------------------------------------------------------------
	| Back end
	|--------------------------------------------------------------------------
	|
	*/
	/**
	 * Display a listing of simple users.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::latest()->paginate();

		return view('back.users.index', compact('users'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('back.users.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(UserStoreRequest $request)
	{
		$input = $request->except('_token', 'password_confirmation');

		$user = User::create($input);
		
		return redirect()->route('admin.users.index')->with('message', "L'utilisateur {$user->email} est ajouté avec succès");
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = User::find($id);
		return view('back.users.edit', compact('user'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(UserUpdateRequest $request, $id)
	{
		$input = $request->except('_token', '_method');
		$user = User::find($id);
		
		$user->update($input);

		return redirect()->route('admin.users.index')->with('message', "L'utilisateur {$user->email} est modifié avec succès");
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		User::destroy($id);
		return redirect()->route('admin.users.index')->with('message', "L'utilisateur est supprimé");
	}


	/**
	 * Changer le mot de passe d'un utilisateur.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function changePassword(UserChangePasswordRequest $request, $id)
	{
		$user = User::find($id);
		$input = $request->except('_token', '_method');

		// if(!\Hash::check($input['password_old'], $user->password))
		// 	return redirect()->back()->withErrors(['password_old' => "Veuillez entrer le mot de passe actuel de l'utilisateur"]);

		$user->password = $input['password'];
		$user->save();

		// $route = $user->hasRole('Client') ? 'admin.users.edit' : 'admin.administrators.edit';
		$route = ('admin.users.edit');

		return redirect()->route($route, $id)
		->with('message', "L'utilisateur {$user->email} est modifié avec succès");
	}

	/*
	|--------------------------------------------------------------------------
	| Front end
	|--------------------------------------------------------------------------
	|
	*/

	/**
	 * Changer le mot de passe d'un utilisateur.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function changeOwnPassword(UserChangePasswordRequest $request)
	{
		$user = Auth::user();
		$input = $request->except('_token', '_method');

		if(!\Hash::check($input['password_old'], $user->password))
			return redirect()->back()->withErrors(['password_old' => "Veuillez entrer le mot de passe actuel de l'utilisateur"]);

		$user->password = $input['password'];
		$user->save();

		return redirect()->back()->with('message', 'Votre mot de passe est modifié avec succès');
	}

    /**
     * Affiche le profile du user connecté
     *
     * @return Response
     */
	public function profile()
	{
		$user = Auth::user();
		return view('front.users.profile', compact('user'));
	}

	/**
     * Mettre le profile du user connecté
     *
     * @return Response
     */
	public function updateProfile(UserUpdateRequest $request)
	{
		$user = Auth::user();

		$input = $request->except('_token', '_method', 'email');

		if($user->email != $request->get('email')) {
			$v = \Validator::make($request->only('email'), [
				'email' => 'email|unique:users',
			]);

			if ($v->fails())
			{
				return redirect()->back()->withErrors($v->errors())->withInput($request->all());
			}

			$input['email'] = $request->get('email');
		}

		$user = $this->user->update($user->id, $input);

		return redirect()->route('users.profile')
		->with('message', 'Votre profile est modifié avec succès');
	}

}
