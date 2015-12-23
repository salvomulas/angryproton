<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;

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
        return view ('public.home');
    }

    public function mail() {

        $user = \App\User::findOrFail(55);

        Mail::send('emails.invoice', ['user' => $user], function ($m) use ($user) {
            $m->from('angryproton@pixeffect.ch', 'AngryProton');
            $m->to($user->email, $user->name)->subject('Deine Rechnung!');
        });
    }

}
