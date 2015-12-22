<?php

namespace App\Http\Controllers;

use Gate;
use App\User;
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
        $courses = Course::paginate(15);
        return view('public.courses')->with('courses', $courses);
    }

    /**
     * show the courses of a specific prof
     * @return mixed
     */
    public function coursesUser($id)
    {
        $user = User::findOrFail($id);
        $courses = $user->ownedCourses()->paginate(15);
        return view('public.courses')->with('courses', $courses);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $course = new Course;
        $institutions = Auth::user()->institutions->lists('name', 'id');

        # the view is used for creation and modification so the corresponding action has to be passed
        return view('public.createCourse')
            ->with('course', $course)
            ->with('institutions', $institutions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $course = new Course;
        $message = "Der Kurs wurde erfolgreich erstellt";
        return $this->storeORUpdate($request, $course);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::findOrFail($id);
        $institution = Institution::findOrFail($course->assignedInstitution);
        return view('public.courseDetail')
            ->with('course', $course)
            ->with('institution', $institution);
    }

    /**
     * Display the participants of the Course.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function participants($id)
    {
        $course = Course::findOrFail($id);
        if (Gate::denies('update_course', $course)) {
            abort(403);
        }
        $institution = Institution::findOrFail($course->assignedInstitution);
        return view('courses.participants')
            ->with('course', $course)
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
        $course = Course::findOrFail($id);
        $institutions = Auth::user()->institutions->lists('name', 'id');

        # the view is used for creation and modification so the corresponding action has to be passed

        return view('public.editCourse')
            ->with('course', $course)
            ->with('institutions', $institutions);
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
        $course = Course::findOrFail($id);
        return $this->storeORUpdate($request, $course);
    }

    /**
     * Remove the specified resource from storage.
     * TODO only course owner should be allowed to do this.
     * TODO This should send a mail to all participants who signed up.
     * TODO Should not be possible after the owner confirmed the course
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $course = Course::findOrFail($id);

        # removeing all foreign key constraints before deleting the actual object
        $course->participants()->detach();
        \Session::flash('flash_message', 'Der Kurs wurde erfolgreich gelöscht');
        \Session::flash('flash_message_type', 'info');
        return redirect()->action('CourseController@index');
    }

    /**
     * The owner of the course can confirm it,
     * TODO send an email to all participants
     * TODO send bill to the owner
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function confirm($id)
    {
        #TODO only the course owner should be allowed to do this.
        $course = Course::findOrFail($id);
        $course->confirmed = true;
        $course->save();

        \Session::flash('flash_message', 'Der Kurs wurde erfolgreich bestätigt');
        \Session::flash('flash_message_type', 'success');
        return redirect()->action('CourseController@show', [$course->id]);
    }

    /**
     *TODO this should only be possible if the user is logged in and not the course owner
     *TODO this should only be allowed if max participants ahs not been reached.
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function signup($id)
    {
        $course = Course::findOrFail($id);

        if ($course->participants()->count() < $course->participantNum) {
            $course->participants()->attach(Auth::user());
            \Session::flash('flash_message', "Du wurdest erfolgreich zum Kurs angemeldet");
            \Session::flash('flash_message_type', "success");
            return redirect()->action('CourseController@show', [$course->id]);
        } else {
            \Session::flash('flash_message', "Der Kurs ist leider voll, keine Anmeldung möglich");
            \Session::flash('flash_message_type', 'warning');
            return redirect()->action('CourseController@show', [$course->id]);
        }


    }

    /**
     * Cancel a Subscription
     * TODO this should only be possible if the course is not confirmed and the User is logged in
     * and signed up
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    public function cancel($id)
    {
        $course = Course::findOrFail($id);
        $course->participants()->detach(Auth::user());

        \Session::flash('flash_message', "Du wurdest erfolgreich vom Kurs abgemeldet");
        \Session::flash('flash_message_type', "success");
        return redirect()->action('CourseController@show', [$course->id]);

    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    private function storeORUpdate(Request $request, Course $course)
    {

        $this->validate($request, [
            'institution' => 'required|integer',
            'courseName' => 'required|max:64',
            'description' => 'required|min:10',
            'price' => 'numeric|required|min:0|max:9999',
            'startDate' => 'required|date',
            'duration' => 'required|min:0|max:480|integer',
            'participantNum' => 'required|min:1|max:50|Integer'
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
        $course->participantNum = $request->participantNum;
        $course->user()->associate(Auth::user());

        if ($course->save()) {
            \Session::flash('flash_message', "Der Kurs wurde erfolgreich gespeichert");
            \Session::flash('flash_message_type', "success");
            return redirect()->action('CourseController@show', [$course->id]);

        } else {
            return Redirect::back()
                ->withError("Der Kurs konnte leider nicht gespeichert werden.")
                ->withInput();
        }

    }

}
