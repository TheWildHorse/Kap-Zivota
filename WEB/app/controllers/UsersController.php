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

	public function core_edit($data) {
		$validation = Validator::make($data, User::$rules);

		if ($validation->passes())
		{
			$user = $this->user->find($data['id']);

			if($user->api_key == $data['api_key']) {
				$user->update($data);
				return true;
			}
			else return false;
		}
		return false;
	}

	public function core_register() {
		$input = Input::only('email', 'password');
		$validation = Validator::make($input, User::$rules);

		if ($validation->passes())
		{
			$this->user->create(array('email' => $input['email'], 'password' => Hash::make($input['password']), 'api_key' => str_random(64)));
			return $this->user->id;
		}
		return 0; // Vraća 0 ako podatci nisu ispravni
	}

	// -------------------- API ----------------------

	// -------------------- Web ----------------------
	public function login() {
		return View::make('users.login');
	}

	public function web_Auth() {
		$input = Input::all();
		if($this->core_authenticate($input['email'], $input['password']))  return View::make('users.login');
		else return View::make('users.login')->withErrors('Neuspjeli pokušaj logiranja!');
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = $this->user->all();

		return View::make('users.index', compact('users'));
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

		if (is_null($user))
		{
			return Redirect::route('users.index');
		}

		return View::make('users.edit', compact('user'));
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
		$validation = Validator::make($input, User::$rules);

		if ($validation->passes())
		{
			$user = $this->user->find($id);
			$user->update($input);

			return Redirect::route('users.show', $id);
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
