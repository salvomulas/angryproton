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
    'as'         => 'home',
    'middleware' => 'guest',
    'uses'       => 'PublicController@index'
]);


/*
 * User specific routes
 * **************************************************************************
 */
Route::get ('/dashboard', [
    'as'   => 'dashboard',
    'uses' => 'UserController@index'
]);

Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');
Route::get('auth/password', function() {
    return view ('auth.password');
});

/*
 * Routes for authentication purposes
 * **************************************************************************
 */
Route::controllers ([
    'auth'     => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

/*
 * Additional routes for courses
 * TODO I don't know why I can't use post or patch here. but if I do it says its the wrong method.
 */
Route::get('bills/showInline/','BillController@showInline');
Route::post ('courses/search', 'CourseController@search');
Route::get ('teacher/{id}/courses','CourseController@coursesTeacher');

Route::any ('courses/{id}/signup', 'CourseController@signup');
Route::any ('courses/{id}/cancel', 'CourseController@cancel');
Route::any ('courses/{id}/confirm', 'CourseController@confirm');
Route::get ('courses/{id}/participants', 'CourseController@participants');

Route::get ('user/{id}/courses','CourseController@coursesUser');
Route::get ('user/{id}/bills', 'UserController@billsUser');

/*
 * Routes for resources
 * **************************************************************************
 */
Route::resource ('institutions', 'InstitutionController');
Route::resource ('courses', 'CourseController');


/*
 * Routes for debugging purposes
 * **************************************************************************
 */
Route::get ('/test', [
    'uses' => 'PublicController@mail',
    'as' => 'mail'
]);

Route::get ('/403', function () {
    return view ('errors.403');
});