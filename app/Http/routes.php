<?php

Route::get('/', ['as' => 'home', 'uses' => function() { 
    if ( Auth::check() ) {
        return redirect('/dashboard');
    }
    return view('welcome'); 
}]);

Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);

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


// Boxes
Route::get('/boxes/new', ['as' => 'new_box', 'uses' => 'BoxPermissionController@new']);
Route::post('/boxes', ['as' => 'create_box', 'uses' => 'BoxPermissionController@store']);
Route::delete('/boxes/{permission}', 'BoxPermissionController@destroy');
