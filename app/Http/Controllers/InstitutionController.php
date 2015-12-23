<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Institution;
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
        /* TODO Define Owner method from AuthFacade
        if (Gate::denies('update_institution', $post)) {
            abort(403);
        }
        */
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
        /* TODO Define Owner method from AuthFacade
        if (Gate::denies('update_institution', $post)) {
            abort(403);
        }
        */
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
