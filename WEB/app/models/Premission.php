<?php

class Premission extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'name' => 'required'
	);

    public function users()
    {
        return $this->hasMany('User');
    }
}
