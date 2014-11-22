<?php

class Donation extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'user_id' => 'required',
		'institution_id' => 'required',
		'time' => 'required',
		'measure' => 'required'
	);
}
