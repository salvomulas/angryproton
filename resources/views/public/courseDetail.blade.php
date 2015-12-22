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
                <h4>angeboten durch: {{ $institution->name }}</h4>
            </div>
            <div class="col-md-4 hidden-sm hidden-xs text-right">
                <i class="fa fa-5x fa-book"></i>
            </div>

        </div>
    </div>

    <div class="container">
        @include('includes.flash')

        <div class="col-md-3 col-md-push-9">

            <h4>Institution</h4>
            <div clasS="list-group">
                <a href="{{ action('InstitutionController@show',[$institution->id]) }}"
                   class="list-group-item"><i class="fa fa-institution fa-fw"></i>&nbsp; Übersicht</a>
                <a href="#"
                   class="list-group-item"><i class="fa fa-external-link fa-fw"></i>&nbsp; Externe Webseite</a>
            </div>

            @if (Auth::check())
                <h4>Aktionen</h4>
                <div class="list-group">
                    @if ($course->isUserSignedUp(Auth::user()))
                        <a href="{{ action('CourseController@cancel',[$course->id]) }}"
                           class="list-group-item"><i class="fa fa-sign-out fa-fw"></i>&nbsp; Ausschreiben</a>
                    @else
                        <a href="{{ action('CourseController@signup',[$course->id]) }}"
                           class="list-group-item"><i class="fa fa-sign-in fa-fw"></i>&nbsp; Einschreiben</a>
                    @endif
                    @can ('update_course', $course)
                    <a href="{{ action('CourseController@participants',[$course->id]) }}" class="list-group-item"><i
                                class="fa fa-list fa-fw"></i>&nbsp; Teilnehmerliste ansehen</a>
                    <a href="{{ action('CourseController@edit',[$course->id]) }}" class="list-group-item"><i
                                class="fa fa-edit fa-fw"></i>&nbsp; Kurs
                        bearbeiten</a>
                    @if (! $course->isConfirmed())
                        <a href="{{ action('CourseController@confirm',[$course->id]) }}" class="list-group-item"><i
                                    class="fa fa-check fa-fw"></i>&nbsp; Durchführung
                            bestätigen</a>
                    @endif
                    <a href="{{ action('CourseController@destroy',[$course->id]) }}" class="list-group-item"><i
                                class="fa fa-close fa-fw"></i>&nbsp; Kurs absagen
                        und löschen</a>
                    @endcan
                </div>
            @endif
        </div>

        <div class="col-md-9 col-md-pull-3">
            <div class="table-responsive">
                <table class="table table-striped">
                    <tr>
                        <th>Beschreibung</th>
                        <td>{{ $course->description }}</td>
                    </tr>
                    <tr>
                        <th>Startdatum</th>
                        <td>{{ $course->startDate }}</td>
                    </tr>
                    <tr>
                        <th>Dauer</th>
                        <td>{{ $course->duration }}</td>
                    </tr>
                    <tr>
                        <th>Preis</th>
                        <td>{{ $course->price }}</td>
                    </tr>
                    <tr>
                        <th>Maximal Anzahl Teilnehmer</th>
                        <td>{{ $course->participantNum }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

@endsection