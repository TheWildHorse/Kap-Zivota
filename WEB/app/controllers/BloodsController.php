<?php

class BloodsController extends BaseController {

	/**
	 * Blood Repository
	 *
	 * @var Blood
	 */
	protected $blood;

	public function __construct(Blood $blood)
	{
		$this->blood = $blood;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$bloods = $this->blood->all();

		return View::make('bloods.index', compact('bloods'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('bloods.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Blood::$rules);

		if ($validation->passes())
		{
			$this->blood->create($input);

			return Redirect::route('bloods.index');
		}

		return Redirect::route('bloods.create')
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
		$blood = $this->blood->findOrFail($id);

		return View::make('bloods.show', compact('blood'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$blood = $this->blood->find($id);

		if (is_null($blood))
		{
			return Redirect::route('bloods.index');
		}

		return View::make('bloods.edit', compact('blood'));
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
		$validation = Validator::make($input, Blood::$rules);

		if ($validation->passes())
		{
			$blood = $this->blood->find($id);
			$blood->update($input);

			return Redirect::route('bloods.show', $id);
		}

		return Redirect::route('bloods.edit', $id)
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
		$this->blood->find($id)->delete();

		return Redirect::route('bloods.index');
	}

}
