<?php

class BloodSupply extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'institution_id' => 'required',
		'blood_id' => 'required',
		'quantity' => 'required'
	);

	public function blood()
	{
		return $this->belongsTo('Blood');
	}

	public function institution()
	{
		return $this->belongsTo('Institution');
	}
}
