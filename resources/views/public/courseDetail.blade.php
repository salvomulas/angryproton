@extends ('templates.main')

@section ('title')
    Kursdetails
    @endsection

    @section ('body')
            <!-- Jumbotron Container -->
    <div class="jumbotron">
        <div class="container">
            <div class="col-md-8 col-sm-12 col-xs-12">
                <h3>Kursdetails: {{ $course->courseName }}</h3>

                <p> </p>
            </div>
            <div class="col-md-4 hidden-sm hidden-xs text-right">
                <i class="fa fa-5x fa-book"></i>
            </div>

        </div>
    </div>

    <div class="container">
        @include('includes.flash')
        <div class="col-md-6">
            <!-- TODO only show button if your allowed to edit -->
                Kurs editieren <a href="{{ action( 'CourseController@edit',[$course->id] ) }}"<i
                    class="fa fa-pencil-square"></i></a>
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <tbody>
                        <tr>
                            <td>Kursname</td>
                            <td>{{ $course->courseName }}</td>
                        </tr>
                            <td>Beschreibung</td>
                            <td>{{ $course->description }}</td>
                        </tr>
                            <td>Startdatum</td>
                            <td>{{ $course->startDate }}</td>
                        </tr>                            
                            <td>Dauer</td>
                            <td>{{ $course->duration }}</td>
                        </tr>
                            <td>Preis</td>
                            <td>{{ $course->price }}</td>
                        </tr>
                        </tr>
                            <td>
                                <!-- TODO need to implement ACL's so only the correct people may see the corresponding buttons-->

                                {!! Form::open(array('url' => action('CourseController@confirm',[$course->id]))) !!}
                                {!! Form::submit('Bestätigen',["class"=>"btn btn-default"]) !!}
                                {!! Form::close() !!}

                                {!! Form::open(array('url' => action('CourseController@signup',[$course->id]))) !!}
                                {!! Form::submit('Einschreiben',["class"=>"btn btn-default"]) !!}
                                {!! Form::close() !!}
                            </td>
                            <td>

                                {!! Form::open(array('url' => action('CourseController@destroy',[$course->id]),'method'=>'delete')) !!}
                                {!! Form::submit('Absagen',["class"=>"btn btn-warning"]) !!}
                                {!! Form::close() !!}

                                {!! Form::open(array('url' => action('CourseController@cancel',[$course->id]))) !!}
                                {!! Form::submit('Abmelden',["class"=>"btn btn-warning"]) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection