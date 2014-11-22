<?php

class UsersController extends BaseController {

	protected $user;
	public function __construct(User $user)
	{
		$this->user = $user;
	}


	// Osnovna funkcionalnost
	public function core_authenticate($email, $password) {
		if (Auth::attempt(array('email' => $email, 'password' => $password))) {
			return true;
		}
		return false;
	}

	public function core_logout() {
		Auth::logout();
	}




	public static  function core_edit($data) {

			$user = User::find($data['id']);

			if($user->api_key == $data['api_key']) {
				$user->update($data["data"]);
				return true;
			}
			else return false;


	}

	public static  function core_register($email,$password) {

		$validation = Validator::make(array('email'=>$email,'password'=>$password), User::$rules);

		if ($validation->passes())
		{
            $api =  str_random(64);
			$user = User::create(array('email' => $email, 'password' => Hash::make($password), 'api_key' => str_random(64)));
			return array("api"=>$user->api_key,"id"=>$user->id);
		}
        else
		return 0; // Vraća 0 ako podatci nisu ispravni
	}

	// -------------------- API ----------------------

	// -------------------- Web ----------------------
	public function login() {
		return View::make('users.login');
	}

	public function web_Auth() {
		$input = Input::all();
		if($this->core_authenticate($input['email'], $input['password']))  return Redirect::to('superAdmin');
		else return View::make('users.login')->withErrors('Neuspjeli pokušaj logiranja!');
	}

	public function web_Logout() {
		$this->core_logout();
		return Redirect::to('login');
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = $this->user->all();
		$blood_types = Blood::lists("type", "id");
		$institutions = Institution::lists("name", "id");


		return View::make('users.index', compact('users', 'blood_types', 'institutions'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('users.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, User::$rules);

		if ($validation->passes())
		{
			$this->user->create($input);

			return Redirect::route('users.index');
		}

		return Redirect::route('users.create')
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = $this->user->findOrFail($id);

		return View::make('users.show', compact('user'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = $this->user->find($id);
		$blood_types = Blood::lists("type", "id");
		$institutions = Institution::lists("name", "id");
		$premissions = Premission::lists("name", "id");

		if (is_null($user))
		{
			return Redirect::route('users.index');
		}

		return View::make('users.edit', compact('user', 'blood_types', 'institutions', 'premissions'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = array_except(Input::all(), '_method');
		$validation = Validator::make($input, User::$update_rules);

		if ($validation->passes())
		{
			$user = $this->user->find($id);
			$user->update($input);

			return Redirect::route('users.index', $id);
		}

		return Redirect::route('users.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->user->find($id)->delete();

		return Redirect::route('users.index');
	}

}
