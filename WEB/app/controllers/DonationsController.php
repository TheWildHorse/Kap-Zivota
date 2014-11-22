<?php

class DonationsController extends BaseController {

	/**
	 * Donation Repository
	 *
	 * @var Donation
	 */
	protected $donation;

	public function __construct(Donation $donation)
	{
		$this->donation = $donation;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$donations = Donation::orderBy('time', 'desc')->take(15)->get();
		$names = User::lists("name", "id");
		$surnames = User::lists("surname", "id");
		$usernames = User::lists("username", "id");

		return View::make('donations.index', compact('donations', 'names', 'surnames', 'usernames'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$usernames = User::lists("username", "id");
		return View::make('donations.create', compact('usernames'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::only('user_id');
		$input['institution_id'] = Auth::user()->institution_id;
		$input['time'] = date('Y-m-d H:i:s', time());
		$input['measure'] = 0.45;

		$validation = Validator::make($input, Donation::$rules);

		if ($validation->passes())
		{
			$this->donation->create($input);

			$donor = User::find($input['user_id']);
			$current = BloodSupply::where('institution_id', "=", Auth::user()->institution_id)->where('blood_id', "=", $donor->blood_id)->first();
			if(count($current) > 0) {
				$current->quantity = $current->quantity+1;
				$current->save();
			}
			else {
				BloodSupply::create(array('institution_id' => Auth::user()->institution_id, 'blood_id' => $donor->blood_id, 'quantity' => 1));
			}

			return Redirect::route('donations.index');
		}

		return Redirect::route('donations.create')
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
		$donation = $this->donation->findOrFail($id);

		return View::make('donations.show', compact('donation'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$donation = $this->donation->find($id);

		if (is_null($donation))
		{
			return Redirect::route('donations.index');
		}

		return View::make('donations.edit', compact('donation'));
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
		$validation = Validator::make($input, Donation::$rules);

		if ($validation->passes())
		{
			$donation = $this->donation->find($id);
			$donation->update($input);

			return Redirect::route('donations.show', $id);
		}

		return Redirect::route('donations.edit', $id)
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
		$this->donation->find($id)->delete();

		return Redirect::route('donations.index');
	}

}
