@extends ('templates.main')

@section ('title')
    Teilnehmerliste {{ $course->courseName }}
    @endsection

    @section ('body')
            <!-- Jumbotron Container -->
    <div class="jumbotron">
        <div class="container">
            <div class="col-md-8 col-sm-12 col-xs-12">
                <h3>Teilnehmerliste: {{ $course->courseName }}</h3>
                <h4>angeboten durch: {{ $institution->name }}</h4>
            </div>
            <div class="col-md-4 hidden-sm hidden-xs text-right">
                <i class="fa fa-5x fa-list"></i>
            </div>

        </div>
    </div>

    <div class="container">
        @include('includes.flash')

        <div class="col-md-3 col-md-push-9">
            <div class="list-group">
                    <a href="{{ action('CourseController@show',[$course->id]) }}"
                       class="list-group-item"><i class="fa fa-arrow-left fa-fw"></i>&nbsp; Zurück</a>
            </div>
        </div>

        <div class="col-md-9 col-md-pull-3">
            <div class="table-responsive">
                <table class="table table-striped">
                <tr>
                    <th>Vorname</th>
                    <th>Nachname</th>
                    <th>eMail Adresse</th>
                </tr>
                    @foreach ($course->participants()->getResults() as $user)
                        <tr>
                            <td>{{ $user->firstName }}</td>
                            <td>{{ $user->lastName }}</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

    </div>

@endsection