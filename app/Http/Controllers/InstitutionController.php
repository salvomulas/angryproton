<?php

namespace App\Http\Controllers;

use Gate;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Institution;
use App\User;
use App\Authorization;
use App\Role;
use Illuminate\Support\Facades\Auth;
use \Session as Session;

class InstitutionController extends Controller
{
    /**
     * Display a listing of the institutions resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $institutions = Institution::all();
        return view('public.institutions')->with('institutions', $institutions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->middleware('auth');
        if (!Auth::user()->hasSuperpowers()) {
            abort(403);
        }

        $operation = 'erstellen';
        return view('forms.add_institution')
            ->with('operation', $operation);
    }

    /**
     * Shows the form for managing permissions to the institution
     * @param $id
     * @return mixed
     */
    public function manage($id)
    {
        $this->middleware('auth');
        if (Gate::denies('manage_institutions')) {
            abort(403);
        }
        if (Gate::denies('update_institution', Institution::findOrFail($id))) {
            abort(403);
        }
        $institution = Institution::findOrFail($id);
        $teachers = $institution->users(1);
        $managers = $institution->users(2);
        $users = User::all()->sortBy('fullName')->lists('fullName', 'id');
        $roles = Role::all()->lists('label', 'id');

        return view('institutions.permissions')
            ->with('institution', $institution)
            ->with('teachers', $teachers)
            ->with('managers', $managers)
            ->with('users', $users)
            ->with('roles', $roles);
    }

    public function addPermission(Requests\PermissionRequest $request)
    {
        $this->middleware('auth');
        if (Gate::denies('manage_institutions')) {
            abort(403);
        }
        if (Gate::denies('update_institution', Institution::findOrFail($request->institution_id))) {
            abort(403);
        }

        Authorization::create($request->all());
        Session::flash('flash_message', "Die Institutionsrechte wurden erfolgreich angepasst");
        Session::flash('flash_message_type', "success");
        return redirect()->action('InstitutionController@manage');
    }

    public function removePermission(Requests\PermissionRequest $request)
    {
        $this->middleware('auth');
        if (Gate::denies('manage_institutions')) {
            abort(403);
        }
        if (Gate::denies('update_institution', Institution::findOrFail($request->institution_id))) {
            abort(403);
        }

        Authorization::where('user_id', $request->user_id)
            ->where('institution_id', $request->institution_id)
            ->where('role_id', $request->role_id)
            ->detach();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\InstitutionRequest $request)
    {
        $this->middleware('auth');
        if (!Auth::user()->hasSuperpowers()) {
            abort(403);
        }

        Institution::create($request->all());
        Session::flash('flash_message', "Die Institution wurde erfolgreich angelegt");
        Session::flash('flash_message_type', "success");
        return redirect()->action('InstitutionController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $institution = Institution::findOrFail($id);
        return view ('public.institutionDetail')
            ->with('institution', $institution);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->middleware('auth');
        if (Gate::denies('manage_institutions')) {
            abort(403);
        }
        if (Gate::denies('update_institution', Institution::findOrFail($id))) {
            abort(403);
        }
        $operation = 'bearbeiten';
        $institution = Institution::findOrFail($id);
        return view('forms.edit_institution')
            ->with('institution', $institution)
            ->with('operation', $operation);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->middleware('auth');
        if (Gate::denies('manage_institutions')) {
            abort(403);
        }
        if (Gate::denies('update_institution', Institution::findOrFail($id))) {
            abort(403);
        }
        $institution = Institution::findOrFail($id);
        $institution->update ($request->all());

        if ($institution->save()) {
            \Session::flash('flash_message', "Die Institution wurde erfolgreich angepasst");
            \Session::flash('flash_message_type', "success");
            return redirect()->action('InstitutionController@show', [$institution->id]);

        } else {
            return Redirect::back()
                ->withError("Die Institution konnte nicht bearbeitet werden.")
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
