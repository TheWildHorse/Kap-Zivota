<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	public $fillable = array('udid', 'gender', 'username', 'password', 'name', 'surname', 'email', 'birthdate','api_key', 'blood_id');

	public static $rules = array(
		'email' => 'required|email|unique:users',
		'password' => 'required'
	);

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

    public function donations()
    {
        return $this->hasMany('Donation');
    }
    public function blood()
    {
        return $this->belongsTo('Blood');
    }
    public function institution()
    {
        return $this->belongsTo('Institution');
    }
    public function permission()
    {
        return $this->belongsTo('Permission');
    }
}

