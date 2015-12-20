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
        $course = new Course;
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


        return view ('public.createCourse')
            ->with ('course',$course)
            ->with('institutions',$institutions);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $course = new Course;
        $message="Der Kurs wurde erfolgreich erstellt";
        return $this->storeORUpdate($request,$course);
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
        return view ('public.CourseDetail')->with ('course', $course);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $institutions= array();
        foreach( Institution::all() as $institution){
            $institutions[$institution->id] = $institution->name;
        }
        asort($institutions);

        # the view is used for creation and modification so the corresponding action has to be passed

        return view ('public.editCourse')
            ->with ('course',$course)
            ->with('institutions',$institutions);
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
        $course = Course::findOrFail($id);
        return $this->storeORUpdate($request,$course);
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

    private function storeORUpdate(Request $request, Course $course){

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

        $course->institution()->associate($institution);
        $course->courseName = $request->courseName;
        $course->description = $request->description;
        $course->price = $request->price;
        $course->startDate = $request->startDate;
        $course->duration = $request->duration;
        $course->user()->associate(Auth::user());

        if ($course->save()){
            \Session::flash('flash_message', "Der Kurs wurde erfolgreich gespeichert");
            return redirect()->action('CourseController@show',[$course->id]);

        }
        else {
            return Redirect::back()
                ->withError("Der Kurs konnte leider nicht gespeichert werden.")
                ->withInput();
        }

    }
}
