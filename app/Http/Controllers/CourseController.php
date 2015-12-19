<?php

namespace App\Http\Controllers;

use App\Course;
use App\Institution;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;


class CourseController extends Controller
{
    /**
     * Display a listing of the courses resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::all ();
        return view ('public.courses')->with ('courses', $courses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /**
         * getting a valid list of institiutions for a dropdown
         *#TODO need to get the list of institutions from the user object
         */
        $institutions= array();
        foreach( Institution::all() as $institution){
            $institutions[$institution->id] = $institution->name;
        }
        /*
         * this shit cost me about an hour of my life.
         * http://php.net/manual/en/array.sorting.php
         * that's just bad implementation. seriously. a "named" key is a fucking dictionary and it does not have an
         * order.
         */
        asort($institutions);

        # the view is used for creation and modification so the corresponding action has to be passed
        $action = action('CourseController@store');

        $course = new Course;
        return view ('public.createOrEditCourse')
                ->with ('course',$course)
                ->with ('institutions',$institutions)
                ->with ('action',$action);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
           'institution' => 'required|integer',
           'courseName' => 'required|max:64',
           'description' => 'required|min:10',
           'price'=>'numeric|required|min:0|max:9999',
           'startDate' =>'required|date',
           'duration' => 'required|min:0|max:480|integer'
        ]);


        $institution = Institution::find($request->institution);
        #TODO validate the institute here.
        #$this->validator->after(function($validator) {
        #    if ($this->somethingElseIsInvalid()) {
        #        $validator->errors()->add('field', 'Something is wrong with this field!');
        #    }
        #});


        $course = new Course;
        $course->institution()->associate($institution);
        $course->courseName = $request->courseName;
        $course->description = $request->description;
        $course->price = $request->price;
        $course->startDate = $request->startDate;
        $course->duration = $request->duration;
        $course->user()->associate(Auth::user());

        if ($course->save()){
            return redirect("/");
        }
        else {
            return Redirect::back()
                ->withMessage("Der Kurs konnte leider nicht erstellt werden")
                ->withInput();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::findOrFail ($id);
        dd ($course);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
