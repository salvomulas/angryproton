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
 * Additional routes for courses
 * TODO I don't know why I can't use post or patch here. but if I do it says its the wrong method.
 */
Route::post ('courses/search', 'CourseController@search');
Route::get ('teacher/{id}/courses','CourseController@coursesTeacher');
Route::get ('user/{id}/courses','CourseController@coursesUser');
Route::any ('courses/{id}/signup', 'CourseController@signup');
Route::any ('courses/{id}/cancel', 'CourseController@cancel');
Route::any ('courses/{id}/confirm', 'CourseController@confirm');
Route::get ('courses/{id}/participants', 'CourseController@participants');

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
Route::get ('/test', function () {
    $user = Auth::user();
    dd(\App\Institution::getPermittedInstitutions($user));
});

Route::get ('/403', function () {
    return view ('errors.403');
});

/*
 * testing pdf generation
 */

Route::get('pdf', function(){


    //$fpdf = new FPDF();
    //$fpdi = new FPDI();

    define('FPDF_FONTPATH',base_path().'/resources/assets/pdf/font');
    $name = 'Fritz';
    $lastname ='Hauser';
    $courseName ='Parties für Introvertierte';
    $id=1;
    $date="22.3.2015";
    $maxPart=34;
    $pdf = new FPDI();
    $pdf->AddPage();
    $disk = Storage::disk('local');
    $templatePath= base_path().'/resources/assets/pdf/bill_template.pdf';
    #dd($template = $disk->path('bill_template.pdf'));
    $pdf->setSourceFile($templatePath);
    $tplIdx = $pdf->importPage(1);
    $pdf->useTemplate($tplIdx);
    $pdf->AddFont('Calibri','','calibri.php');
    $pdf->AddFont('Calibri','B','calibrib.php');
    $pdf->SetFont('Calibri','',11);

    $pdf->SetXY(55,101);
    $pdf->Write(0, $name);
    $pdf->SetXY(55,106);
    $pdf->Write(0, $lastname);
    $pdf->SetXY(26,124);
    $pdf->Write(0, utf8_decode($courseName));
    $pdf->SetXY(32,128.2);
    $pdf->Write(0, $id);
    $pdf->SetXY(70,124);
    $pdf->Write(0, utf8_decode($date));
    $pdf->SetXY(110,124);
    $pdf->Write(0, utf8_decode($maxPart));
    $pdf->SetXY(165,124);
    $pdf->Write(0, utf8_decode($maxPart));
    $pdf->SetXY(165,138);
    $pdf->SetFont('Calibri','B',11);
    $pdf->Write(0, utf8_decode($maxPart));
    $output =  $pdf->Output('','s');
    $disk->put("test.pdf",$output);
    $pdf->Output();




});