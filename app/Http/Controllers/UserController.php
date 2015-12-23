<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Role;
use App\Bill;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

/**
 * Class PrivateController
 * @package App\Http\Controllers
 * This controller is not bound to any resource. Methods are only used to load private views.
 */
class UserController extends Controller
{

    /**¨
     * UserController constructor.
     * Auth middleware is loaded to avoid public access.
     */
    public function __construct ()
    {
        $this->middleware ('auth');
    }

    /**
     * Displays the users dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index ()
    {
        $roles = Role::all();
        $institutionsTeach = Auth::user()->institutions(1)->get();
        $institutionsMod = Auth::user()->institutions(2)->get();
        return view ('user.dashboard')
            ->with('roles', $roles)
            ->with('institutionsTeach', $institutionsTeach)
            ->with('institutionsMod', $institutionsMod);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create ()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store (Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show ($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit ($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update (Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy ($id)
    {
        //
    }
    /*
     *
     */
    public function billsUser()
    {
        $user = Auth::user();
        $result = DB::table('users')
            ->where('users.id',$user->id)
            ->leftjoin('courses', 'users.id', '=', 'courses.assignedOwner')
            ->join('bills', 'courses.id', '=', 'bills.course_id')
            ->select('bills.id')
            ->get(['bills.id']);
        $billIds=array();
        foreach ($result as $bill){
            array_push($billIds,$bill->id);
        }
        $bills = Bill::findMany($billIds);
        return view('public.userBills')
            ->with('bills', $bills);
    }
}
