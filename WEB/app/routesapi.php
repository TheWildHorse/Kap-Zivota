<?php
Route::api(['version' => 'v1', 'prefix' => 'api'], function () {

    //Vrace sve korisnike /cisto testna verzija
    Route::get('users', function () {
        return User::all();
    });

    Route::get('users/{id}',function($id)
    {
        return User::find($id);
    });

    Route::get('institutions',function()
    {
       return Institution::all();
    });

    Route::get('institutions/{id}',function($id)
    {
        return Institution::find($id);
    });

    



});

?>