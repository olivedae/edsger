<?php

Route::get('/',
    [
        'as' => 'home', function() {
            if ( Auth::check() ) {
                return redirect('/dashboard');
            }
            return view('welcome');
        }
    ]
);

Route::get('dashboard',
    [
        'as' => 'dashboard',
        'uses' => 'DashboardController@index'
    ]
);

// Authentication routes...
Route::get('login',
    [
        'as' => 'login',
        'uses' => 'Auth\AuthController@getLogin'
    ]
);
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout',
    [
        'as' => 'logout', function() {
            Auth::logout();
            return Redirect::route('login');
        }
    ]
);


// Registration routes...
Route::get('register',
    [
        'as' => 'register',
        'uses' => 'Auth\AuthController@getRegister'
    ]
);
Route::post('register', 'Auth\AuthController@postRegister');


// Boxes
Route::get('/boxes/new',
    [
        'as' => 'new_box',
        'uses' => 'BoxPermissionController@new'
    ]
);
Route::post('/boxes',
    [
        'as' => 'create_box',
        'uses' => 'BoxPermissionController@store'
    ]
);
Route::delete('/boxes/{boxpermission}', 'BoxPermissionController@destroy');

// Box Shares
Route::get('/share/boxes/{boxpermission}',
    [
        'as' => 'new_box_share',
        'uses' => 'BoxShareController@new'
    ]
);
Route::post('/share/boxes/{boxpermission}',
    [
        'as' => 'create_box_share',
        'uses' => 'BoxShareController@store'
    ]
);
Route::delete('/share/boxes/{share}', 'BoxShareController@destroy');
