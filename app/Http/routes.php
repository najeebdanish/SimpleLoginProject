<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('auth/login', ['as' => 'login', function () {
    //
}]);

Route::get('home', ['as' => 'home', function () {
    //
}]);


Route::filter('guest', function()
{
        if (Auth::check()) 
                return Redirect::route('home');
});

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin')->before('guest');
Route::post('auth/login', 'Auth\AuthController@postLogin');

Route::get('auth/logout', 'Auth\AuthController@getLogout')->before('guest');
Route::post('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Admin route that is only accessible to an Admin user
Route::get("adminhome", ['middleware' => 'auth', 'uses' => 'AdminController@renderAdminHome']);

// Home page route
Route::get("home", ['middleware' => 'auth', function () {
		$user=Auth::user();
		$message['welcomeMessage'] = "Welcome, " . $user->email;
		return View::make('home',$message);
}]);

// Base route, if user is already logged in then it redirects to home page otherwise to login page
Route::get("/", function () {
	if (Auth::user())
        {
            return redirect()->route('home');
        }

		return redirect()->route('login');
});

