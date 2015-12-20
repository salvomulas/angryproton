@extends ('templates.main')

@section ('title')
    Kurse
    @endsection

    @section ('body')

            <!-- Jumbotron Container -->
    <div class="jumbotron">
        <div class="container">
            <div class="col-md-8 col-sm-12 col-xs-12">
                <h3>Kurse</h3>

                <p>Eine riesige Auswahl an Weiterbildungen!</p>
            </div>
            <div class="col-md-4 hidden-sm hidden-xs text-right">
                <i class="fa fa-5x fa-book"></i>
            </div>

        </div>
    </div>

    <div class="container">
        @include('includes.flash')
        <div class="row">
            <div class="col-md-12">
                <div class="well">
                    {!! Form::open() !!}
                    {!! Form::text('searchCourse', null, ['placeholder' => 'Kurse durchsuchen...', 'class' => 'form-control']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        <div class="col-md-6">

                neuer Kurs anlegen <a href="{{action('CourseController@create' )}}"<i
                                            class="fa fa-plus-circle"></i></a>

            @if (count($courses) > 0)

                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Kurs</th>
                            <th>Bezeichnung</th>
                            <th>Preis</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($courses as $course)
                            <tr>
                                <td>{{ $course->courseName }}</td>
                                <td>{{ $course->description }}</td>
                                <td>{{ $course->price }}</td>
                                <td><a href="{{ action ('CourseController@show', $course->id) }}"><i
                                                class="fa fa-arrow-circle-right"></i></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-danger" role="alert">
                    Keine Kurse vorhanden!
                </div>
            @endif
        </div>
    </div>

@endsection