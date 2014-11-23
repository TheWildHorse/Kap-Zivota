<?php

class Blood extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'type' => 'required'
	);

    public function users()
    {
        return $this->hasMany('User');
    }

	public function supplies()
	{
		return $this->hasMany('BloodSupply');
	}

}
