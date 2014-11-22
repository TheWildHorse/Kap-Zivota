<?php
Route::api(['version' => 'v1', 'prefix' => 'api'], function () {
    Route::get('users', function () {
        return User::all();
    });


});

?>