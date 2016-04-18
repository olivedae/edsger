<?php

Route::get('/', ['as' => 'home', 'uses' => function() { 
    return view('home'); 
}]);

// Authentication routes...
Route::get('login', ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', ['as' => 'logout', function() {
    Auth::logout();
    return Redirect::route('home');
}]);


// Registration routes...
Route::get('register', ['as' => 'register', 'uses' => 'Auth\AuthController@getRegister']); 
Route::post('register', 'Auth\AuthController@postRegister');
