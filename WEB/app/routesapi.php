<?php
Route::api(['version' => 'v1', 'prefix' => 'api'], function () {


    Route::post('users/login',function()
    {

       $email = Input::get('email');
       $password =Input::get('password');
       return UsersController::core_register($email,$password);

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

    Route::get('statistics/{id}/institutions/dotanionsno',function($id){
        return count(Institution::find($id)->donations);
    });

    Route::get('statistics/{id}/institutions/mostdonations',function($id)
    {
        $i= array_count_values(Institution::find($id)->donations->lists('user_id'));
        arsort($i);
        $user= User::find(array_keys($i)[0]);
        $returnValue = array();
        $returnValue[0]=array($user->id,$user->name,$user->surname);
        return $returnValue;
    });


});

?>