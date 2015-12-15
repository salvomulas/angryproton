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

/*
 * Public routes
 **************************************************************************
 */
Route::get ('/', [
    'as'   => 'home',
    'uses' => 'PublicController@index'
]);


/*
 * User specific routes
 * **************************************************************************
 */
Route::get('/dashboard', [
    'as'    => 'dashboard',
    'uses'  => 'UserController@index'
]);

/*
 * Routes for authentication purposes
 * **************************************************************************
 */
Route::controllers ([
    'auth'     => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::get ('password/email', 'Auth\PasswordController@getEmail');
Route::post ('password/email', 'Auth\PasswordController@postEmail');
Route::get ('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post ('password/reset', 'Auth\PasswordController@postReset');


/*
 * Routes for debugging purposes
 * **************************************************************************
 */
Route::get ('/test', function () {
    return view ('auth.password');
});