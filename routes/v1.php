<?php


//Please indentify your trademark the way i have done around your api

//*********************************Authentication Routes ******************

//JuniCodefire *******************************
//registration
Route::post('register/admin', 'Auth\RegisterController@admin');//has a role of 0

Route::post('register/resident', 'Auth\RegisterController@resident');//has a role of 1

Route::post('register/gateman', 'Auth\RegisterController@gateman');//has a role 2

//Login
Route::post('login', 'Auth\LoginController@authenticate');

//Verify account
Route::post('verify', 'Auth\VerificationController@verify');

//forgot Password
Route::post('password/verify', 'Auth\ForgotPasswordController@verifyPassword');

//Reset password for a new password
Route::put('password/reset', 'Auth\ResetPasswordController@reset');

//End JuniCodefire *******************************************************
//-----------------------------------End Authentication Routes ----------------------------------------------------

//Example how your route should be , please code along enjoy coding

//Admin Routes (Specific Route)*******************************************************
Route::group(['middleware' => ['jwt.verify']], function() {
	//This is the route group every authenticated route with jwt token should go in here

	//Show all user(this route is for only admin)(admin)
    Route::get('user/all', 'UserProfileController@all')->middleware('admin');

	//Show all user for a particular role(this route is for only admin)(admin)
    Route::get('user/all/{role_id}', 'UserProfileController@role')->middleware('admin');

    //show one admin
    Route::get('admin/{id}', 'UserProfileController@showOneAdmin');

});

//Users Routes *******************************************************
Route::group(['middleware' => ['jwt.verify']], function() {
	//This is the route group every authenticated route with jwt token should go in here

    //Show active user i.e. current logged in user
    Route::get('/user', 'UserProfileController@index');

    //show one user
    Route::get('/user/{id}', 'UserProfileController@show');

    //Edit user ac count
    Route::put('/user/edit', 'UserProfileController@update');

    //Change Password
    Route::put('/user/password', 'UserProfileController@password');

    //Delete user account
    Route::delete('/user/delete', 'UserProfileController@destroy');

});

//This our testing api routes
Route::get('test', 'TestController@test');
// Kazeem Asifat QRCode generator *******************************************
//The qr code has been mordify to be sent as jason
Route::get('generate-code', 'TestController@qrCode');