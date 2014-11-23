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

        $usersThatWillBeSent= array();
        $naslov=Input::get('Naslov');
        $bloodtype= Input::get('bloodgroup');
        $bgr=Blood::find($bloodtype)->type;
        $dodatnaObavijest = Input::get('Dodajteobavijesti');
        $usersThatCamSend=User::where('udid','<>','')->where('blood_id','=',$bloodtype)->get();

        foreach($usersThatCamSend  as $user)
        {

            if($user->gender=='M')
            {
                $i = $user->name;
                $latestDate = Donation::where('user_id','=',$user->id)->orderBy('time')->first();
                $date = $latestDate->time;
                $dateDifference =$this->dateDiff( date("Y-m-d h:i:sa"),$date);

            }
            else
            {
                $latestDate = Donation::where('user_id','=',$user->id)->orderBy('time','DESC')->first();
                $date = $latestDate->time;
                $d =  new DateTime($date);
                Donation::where('user_id','=',$user->id)->orderBy('time')->first();



                $today=new DateTime("today");
                $d= $d->add(date_interval_create_from_date_string("3 months"));

                if($today>$d)
                {
                    array_push($usersThatWillBeSent,$user);
                }
            }
        }

        require_once('PushBots.class.php');
        $pb = new PushBots();
        // Application ID
        $appID = '54705e2f1d0ab18e108b4595';
        // Application Secret
        $appSecret = '6f543e1a2b4b3b8d4df958266b006d46';

        $pb->Alert($naslov.":".$bgr.":".$dodatnaObavijest);
        $platforms= array(0,1);
        $pb->Platform($platforms);
        $pb->App($appID, $appSecret);
        $pb->Push();

        return Redirect::to("admin");
    }



}
