<?php namespace App\Http\Controllers\User;

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
	| Register, Login & Logout
	|--------------------------------------------------------------------------
	|
	*/

	/**
     * Affiche register page
     *
     * @return Response
     */
	// public function register()
	// {
	// 	return view('front.users.register');
	// }

    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    /*public function signup(SignupRequest $request)
    {
    	$input = $request->except('_token', 'cgv', 'wilaya_id', 'password_confirmation');
    	if(!Auth::check()) {
			// Valider l'email si nouveau utilisateur
			$user = $this->user->make()->where('email', $input['email'])->first();
			if($user) {
				return redirect()->back()->withInput()->withErrors(['email' => 'Cet email existe déjà.']);
			}

	    	// Créer l'utilisateur
			$input['role_id'] = 3; // Client
	    	$user = $this->user->create($input);
	    	$user->confirmed = true;
	    	$user->save();

	    	// Notification
    		$this->mail(new ConfirmSignup(['user' => $user]));

	    	// Connecter l'utilisateur
	    	$email = $request->get('email');
	    	$password = $request->get('password');
	    	Auth::attempt(['email' => $email, 'password' => $password], true);
		}
    	return redirect()->route('orders.myOrders')
    	->withInput($request->except('password', 'password_confirmation'))
    	->with('message', trans('layouts.confirm_signup'));
    }*/

	/**
     * Affiche login page
     *
     * @return Response
     */
	// public function login()
	// {
	// 	return view('front.users.login');
	// }

	/**
     * Handle an authentication attempt.
     *
     * @return Response
     */
	/*public function authenticate(LoginRequest $request)
	{
		$input = $request->except('_token');
		$email = array_get($input, 'email');
		$password = array_get($input, 'password');
		$remember = array_get($input, 'remember', false);
		// Vérifier les crédentiels
		if (Auth::attempt(['email' => $email, 'password' => $password], $remember))
		{
			// Vérifier si utilisateur confirmé
			if(Auth::user()->confirmed) {
				// sauvegarder la ville dans la session
				// session(['city' => Auth::user()->city->id, 'wilaya' => Auth::user()->city->wilaya_id]);
				// Redirect vers la page voulu, la page d'acceuil sinon
				return redirect()->intended(route('index'));
			}
			// Déconnecter sinon
			Auth::logout();
			return redirect()->back()
			->withErrors(['credentiels' => "Votre compte n'est pas encore activé par l'administration."])
			->withInput($request->only('email', 'remember'));
		}

		return redirect()->back()
		->withErrors(['credentiels' => "Nom d'utilisateur ou mot de passe incorrect."])
		->withMessage("Email ou mot de passe incorrect.")
		->withInput($request->only('email', 'remember'));
	}*/

    /**
     * Se déconnecter
     *
     * @return Response
     */
    /*public function logout()
    {
    	Auth::logout();
    	return redirect()->to('/');
    }*/

    /*
	|--------------------------------------------------------------------------
	| Back office
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
		$users = User::latest()->get();

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
		// créer la marque
		$user = User::create($input);
		
		return redirect()->route('admin.users.index')
		->with('message', "L'utilisateur {$user->email} est ajouté avec succès");
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

		return redirect()->route('admin.users.index')
		->with('message', "Le client {$user->email} est modifié avec succès");
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
		return redirect()->route('admin.users.index')
		->with('message', "L'utilisateur est supprimé");
	}

	/*
	|--------------------------------------------------------------------------
	| Gestion des admins
	|--------------------------------------------------------------------------
	|
	*/
	/**
	 * Display a listing of simple users.
	 *
	 * @return Response
	 */
	public function administrators()
	{
		$users = $this->user->make()->administrators()->latest()->get();

		return view('back.administrators.index', compact('users'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function createAdmin()
	{
		return view('back.administrators.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function storeAdmin(UserStoreRequest $request)
	{
		$input = $request->except('_token', 'password_confirmation', 'wilaya_id');
		// créer la marque
		// $input['role_id'] = 3; // User
		$user = $this->user->create($input);
		
		return redirect()->route('admin.administrators.index')
		->with('message', 'L\'utilisateur '.$user->full_name.' est ajouté avec succès');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function editAdmin($id)
	{
		$user = $this->user->find($id);
		return view('back.administrators.edit', compact('user'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateAdmin(UserUpdateRequest $request, $id)
	{
		$input = $request->except('_token', '_method', 'wilaya_id');
		$user = $this->user->update($id, $input);

		return redirect()->route('admin.administrators.index')
		->with('message', 'L\'utilisateur '.$user->username.' est modifié avec succès');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroyAdmin($id)
	{
		$this->user->destroy($id);
		return redirect()->route('admin.administrators.index')
		->with('message', "L'utilisateur est supprimé");
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
	| Front office
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
