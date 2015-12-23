@extends ('templates.main')

@section ('title')
    Mein Dashboard
    @endsection

    @section ('body')

            <!-- Jumbotron Container -->
    @include ('templates.adminJumbo')

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <!-- Dashboard Menu -->
                @include ('nav.nav_dashboard')
            </div>
            <div class="col-md-9">
                <h3>Benutzerrollen</h3>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>Rolle</th>
                            <th>Berechtigung</th>
                        </tr>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->label }}</td>
                                @if (Auth::user()->hasRole($role->name))
                                    <td><i class="fa fa-check"></i></td>
                                @else
                                    <td></td>
                                @endif
                            </tr>
                        @endforeach
                        <tr>
                            <td>Administrator</td>
                            @if (Auth::user()->isAdmin)
                                <td><i class="fa fa-check"></i></td>
                            @else
                                <td></td>
                            @endif
                        </tr>
                    </table>
                </div>

                @if (Auth::user()->hasRole('teacher'))
                    <h3>Berechtigte Institutionen als Dozent</h3>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th>Institution</th>
                                <th>Land</th>
                            </tr>
                            @foreach ($institutionsTeach as $institution)
                                <tr>
                                    <td>{{ $institution->name }}</td>
                                    <td>{{ $institution->country }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                @endif

                @if (Auth::user()->hasRole('moderator'))
                    <h3>Berechtigte Institutionen als Institutionsleiter</h3>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th>Institution</th>
                                <th>Land</th>
                            </tr>
                            @foreach ($institutionsMod as $institution)
                                <tr>
                                    <td>{{ $institution->name }}</td>
                                    <td>{{ $institution->country }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection