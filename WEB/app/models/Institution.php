<?php

class Institution extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'id' => 'required',
		'name' => 'required',
		'description' => 'required',
		'geo_lat' => 'required',
		'get_long' => 'required'
	);

    public  function users()
    {
        return $this->hasMany('User');
    }

    public function donation()
    {
        return $this->belongsToMany('User','donations','institution_id','user_id');
    }
}
