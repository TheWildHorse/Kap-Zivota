<?php

class BloodSuppliesController extends BaseController {

	/**
	 * BloodSupply Repository
	 *
	 * @var BloodSupply
	 */
	protected $BloodSupply;

	public function __construct(BloodSupply $BloodSupply)
	{
		$this->BloodSupply = $BloodSupply;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$BloodSupplies = BloodSupply::where('institution_id', "=", Auth::user()->institution_id)->get();
		$quantities = array(1=>0, 2=>0, 3=>0, 4=>0, 5=>0, 6=>0, 7=>0, 8=>0);
		foreach($BloodSupplies as $supply) {
			$quantities[$supply->blood_id] = $supply->quantity;
		}
		$blood_types = Blood::lists("type", "id");

		return View::make('BloodSupplies.index', compact('quantities', 'blood_types'));
	}

	public function modify_blood_supply($blood_id, $increment = false) {
		$current = BloodSupply::where('institution_id', "=", Auth::user()->institution_id)->where('blood_id', "=", $blood_id)->first();
		if(count($current) > 0) {
			if($increment) $current->quantity = $current->quantity+1;
			else $current->quantity = $current->quantity-1;
			$current->save();
		}
		else {
			if($increment) BloodSupply::create(array('institution_id' => Auth::user()->institution_id, 'blood_id' => $blood_id, 'quantity' => 1));
			else BloodSupply::create(array('institution_id' => Auth::user()->institution_id, 'blood_id' => $blood_id, 'quantity' => 0));
		}
		return Redirect::to("/bloodsupplies");
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('BloodSupplies.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, BloodSupply::$rules);

		if ($validation->passes())
		{
			$this->BloodSupply->create($input);

			return Redirect::route('BloodSupplies.index');
		}

		return Redirect::route('BloodSupplies.create')
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
		$BloodSupply = $this->BloodSupply->findOrFail($id);

		return View::make('BloodSupplies.show', compact('BloodSupply'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$BloodSupply = $this->BloodSupply->find($id);

		if (is_null($BloodSupply))
		{
			return Redirect::route('BloodSupplies.index');
		}

		return View::make('BloodSupplies.edit', compact('BloodSupply'));
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
		$validation = Validator::make($input, BloodSupply::$rules);

		if ($validation->passes())
		{
			$BloodSupply = $this->BloodSupply->find($id);
			$BloodSupply->update($input);

			return Redirect::route('BloodSupplies.show', $id);
		}

		return Redirect::route('BloodSupplies.edit', $id)
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
		$this->BloodSupply->find($id)->delete();

		return Redirect::route('BloodSupplies.index');
	}

}
