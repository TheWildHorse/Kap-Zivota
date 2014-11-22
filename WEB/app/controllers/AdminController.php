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



        }
    }//function index

    public function sendPush()
    {
        return View::make('users.sendpush');
    }

}
