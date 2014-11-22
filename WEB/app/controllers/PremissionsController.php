<?php

class PremissionsController extends BaseController {

	/**
	 * Premission Repository
	 *
	 * @var Premission
	 */
	protected $premission;

	public function __construct(Premission $premission)
	{
		$this->premission = $premission;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$premissions = $this->premission->all();

		return View::make('premissions.index', compact('premissions'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('premissions.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Premission::$rules);

		if ($validation->passes())
		{
			$this->premission->create($input);

			return Redirect::route('premissions.index');
		}

		return Redirect::route('premissions.create')
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
		$premission = $this->premission->findOrFail($id);

		return View::make('premissions.show', compact('premission'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$premission = $this->premission->find($id);

		if (is_null($premission))
		{
			return Redirect::route('premissions.index');
		}

		return View::make('premissions.edit', compact('premission'));
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
		$validation = Validator::make($input, Premission::$rules);

		if ($validation->passes())
		{
			$premission = $this->premission->find($id);
			$premission->update($input);

			return Redirect::route('premissions.show', $id);
		}

		return Redirect::route('premissions.edit', $id)
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
		$this->premission->find($id)->delete();

		return Redirect::route('premissions.index');
	}

}
