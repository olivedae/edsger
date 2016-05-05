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

/**
 * Registration routes
 */
Route::get('register',
    [
        'as' => 'register',
        'uses' => 'Auth\AuthController@getRegister'
    ]
);
Route::post('register', 'Auth\AuthController@postRegister');

/**
 * Boxes
 */
Route::get('/boxes/new',
    [
        'as' => 'new_box',
        'uses' => 'BoxController@new'
    ]
);
Route::post('/boxes',
    [
        'as' => 'create_box',
        'uses' => 'BoxController@store'
    ]
);
Route::delete('/boxes/{box}', 'BoxController@destroy');

/**
 * Box shares
 */
Route::get('/shares/boxes/{box}',
    [
        'as' => 'box_shares',
        'uses' => 'BoxShareController@index',
    ]
);
Route::get('/shares/boxes/new/{box}',
    [
        'as' => 'new_box_share',
        'uses' => 'BoxShareController@new'
    ]
);
Route::post('/shares/boxes/{box}',
    [
        'as' => 'create_box_share',
        'uses' => 'BoxShareController@store'
    ]
);
Route::delete('/shares/boxes/{box_share}', 'BoxShareController@destroy');

/**
 * Routes
 */
Route::get('/routes/new',
    [
        'as' => 'new_route',
        'uses' => 'RouteController@new'
    ]
);
Route::get('/routes',
    [
        'as' => 'routes',
        'uses' => 'RouteController@index'
    ]
);
Route::post('/routes',
    [
        'as' => 'create_route',
        'uses' => 'RouteController@store'
    ]
);
Route::delete('/routes/{route}',
    [
        'as' => 'delete_route',
        'uses' => 'RouteController@destroy'
    ]
);

/**
 * Route shares
 */
Route::get('/shares/routes/{route}',
    [
        'as' => 'route_shares',
        'uses' => 'RouteShareController@index'
    ]
);
Route::get('/shares/routes/new/{route}',
    [
        'as' => 'new_route_share',
        'uses' => 'RouteShareController@new'
    ]
);
Route::post('/shares/routes/{route}',
    [
        'as' => 'create_route_share',
        'uses' => 'RouteShareController@store'
    ]
);
Route::delete('/shares/routes/{route_share}', 'RouteShareController@destroy');
