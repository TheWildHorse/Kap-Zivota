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

        require_once('PushBots.class.php');
        $pb = new PushBots();
        // Application ID
        $appID = '54705e2f1d0ab18e108b4595';
        // Application Secret
        $appSecret = '6f543e1a2b4b3b8d4df958266b006d46';
        $msg="Ovo će mozda radit";
        $pb->Alert($msg);
        $platforms= array(0,1);
        $pb->Platform($platforms);
        $pb->App($appID, $appSecret);
        $pb->Push();
        /*$users =  User::where('permission_id','=','0');
        return View::make('admin.sendpush',compact('users'));*/
    }

}
