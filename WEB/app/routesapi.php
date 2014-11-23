<?php
Route::api(['version' => 'v1', 'prefix' => 'api'], function () {


    Route::post('users/register',function()
    {

       $email = Input::get('email');
       $password =Input::get('password');
       return UsersController::core_register($email,$password);

    });

    Route::post('users/edit',function()
    {

        $value = UsersController::core_edit(json_decode(file_get_contents("php://input"),true));

        if($value==true)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    });



    //Vrace sve korisnike /cisto testna verzija
    Route::get('users', function () {
        return User::all();
    });

    Route::get('users/{id}', function ($id) {
        return User::find($id);
    });

    Route::get('institutions', function () {
        return Institution::all();
    });

    Route::get('institutions/{id}', function ($id) {
        return Institution::find($id);
    });


    Route::get('donations/users/{id}', function ($id) {

        $institutionsDonated = Donation::where('user_id', '=', $id)->lists('institution_id');

        $instituionNames = array();

        for($i=0;$i<count($institutionsDonated);$i++)
        {
            $instituionNames[$i]=Institution::find($institutionsDonated[$i])->name;
        }
         return array_count_values($instituionNames);
    });

    Route::get('donations/users/{id}/count', function ($id) {

        return count(Donation::where('user_id', '=', $id)->get());
    });

    Route::get('donations/institutions/{id}/count', function ($id) {

        return count(Donation::where('institution_id', '=', $id)->get());
    });


    Route::get('donations/institutions/{id}', function ($id) {
        $users = array();
        $users = Institution::find($id)->donations->lists('user_id');
        $userNames=array();
        for($i=0;$i<count($users);$i++)
        {
            $userNames[$i]=array(Institution::find($id)->name,User::find($users[$i])->name,User::find($users[$i])->surname);
        }
        return $userNames;
    });



    Route::get('statistics/users/{id}/donationsno',function($id)
    {
        return  count(User::find($id)->donations);
    });

    Route::get('statistics/institutions/{id}/dotanionsno',function($id){
        return count(Institution::find($id)->donations);
    });

    Route::get('statistics/institutions/{id}/mostdonations',function($id)
    {
        $i= array_count_values(Institution::find($id)->donations->lists('user_id'));
        arsort($i);
        $user= User::find(array_keys($i)[0]);
        $returnValue = array();
        $returnValue[0]=array($user->id,$user->name,$user->surname);
        return $returnValue;
    });


    Route::get('statistics/institutions/{id}/bloodlevels',function($id)
    {
       $criticalBloodLevel =  Institution::find($id)->critical_level;
        $bloodLevel = count(Donation::where('institution_id','=',$id)->get());
       return array('criticalLevel'=>$criticalBloodLevel,'measure'=>$bloodLevel*450);
    });

    Route::get('statistics/institutions/{id}/bloodgrouplevels',function($id)
    {
        $supplies = BloodSupply::whereInstitutionId($id)->get();
        $return = array();
        foreach($supplies as $supply){
            $name = Blood::find($supply->blood_id)->type;
            array_push($return, array("blood_id" => $name, "quantity"=> $supply->quantity));
        }
        return $return;
    });


    Route::get('statistics/user/{id}/lastdonated',function($id)
    {
        $allUserDonations =  Donation::where('user_id','=',$id)->orderBy('time','DESC')->first();
        if(is_object($allUserDonations))
        {
            return $allUserDonations->time;
        }
        else
        {
            return 0;
        }
    });

    Route::get('statistics/user/{id}/lastfive',function($id)
    {
       return   Donation::where('user_id','=',$id)->orderBy('time')->take(5)->get();
    });

    Route::get('statistics/donations/lastfive',function()
    {

        return Donation::orderBy('time','DESC')->take(5)->get();
    });

    Route::get('statistics/supplies/topfive',function()
    {

    });

    
  

});

?>