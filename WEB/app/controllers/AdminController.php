<?php

class AdminController extends BaseController
{

    protected $admin;

    public function __construct(User $admin)
    {
        $this->admin = $admin;
    }


    public function index()
    {

        if (is_object(Auth::user())) {
            if (Auth::user()->type == 1) {

            } else {
                return View::make('users.login');
            }
        } else {
            return View::make('users.login');

        }
    }//function index

    public function sendPush()
    {
        
    }

}
