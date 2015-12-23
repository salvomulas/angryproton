<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;
use App\Course;
use DB;

/**
 * Class PublicController
 * @package App\Http\Controllers
 * This controller is not bound to any resource. Methods are only used to load public views
 */

class PublicController extends Controller
{
    /**
     * Display the landing page of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $newCourses = Course::orderBy('created_at', 'desc')
            ->take(2)
            ->get();

        $poularCourses = DB::table('courses')
            ->leftjoin('user_course', 'courses.id', '=', 'user_course.course_id')
            ->join('users', 'user_course.user_id', '=', 'users.id')
            ->groupBy('courses.id')
            ->take(2)
            ->get();

        return view ('public.home')
            ->with('newCourses',$newCourses)
            ->with('popularCourses',$poularCourses);
    }

    public function mail() {

        $user = \App\User::findOrFail(55);

        Mail::send('emails.invoice', ['user' => $user], function ($m) use ($user) {
            $m->from('angryproton@pixeffect.ch', 'AngryProton');
            $m->to($user->email, $user->name)->subject('Deine Rechnung!');
        });
    }

}
