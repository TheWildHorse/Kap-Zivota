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




    }//function index

    public function sendPush()
    {
        $users =  User::where('permission_id','=','0');
        return View::make('admin.sendpush',compact('users'));
    }

}
