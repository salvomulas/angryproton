<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

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
        $this->middleware('guest');
        return view ('public.home');
    }

}
