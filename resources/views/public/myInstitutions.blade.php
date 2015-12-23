@extends ('templates.main')

@section ('title')
    Institutionen von {{ $username }}
    @endsection

    @section ('body')

            <!-- Jumbotron Container -->
    <div class="jumbotron">
        <div class="container">
            <div class="col-md-8 col-sm-12 col-xs-12">
                <h3>Institutione von {{ $username }}n</h3>

                <p>Auch {{ $username }} vertraut AngryProton</p>
            </div>
            <div class="col-md-4 hidden-sm hidden-xs text-right">
                <i class="fa fa-5x fa-institution"></i>
            </div>

        </div>
    </div>

    <div class="container">

        @include ('includes.flash')

        <div class="col-md-3 col-md-push-9">

            <div class="well">
                <h4>Join Us!</h4>
                <p>Wir freuen uns stets drauf, neue Institutionen bei uns begrüssen zu dürfen!</p>
            </div>

            @if (Auth::check())
                <div class="list-group">
                    @if (Auth::user()->hasSuperpowers())
                        <a href="{{ action('InstitutionController@create') }}" class="list-group-item"><i
                                    class="fa fa-plus fa-fw"></i>&nbsp; Neue Institution anlegen</a>
                    @endif
                    @can('manage_institutions')
                    <a href="{{ action('InstitutionController@myInstitutions', Auth::user()->id) }}" class="list-group-item active"><i class="fa fa-institution fa-fw"></i>&nbsp; Meine
                        Institutionen</a>
                    @endcan
                </div>
            @endif

        </div>
        <div class="col-md-9 col-md-pull-3">

            @if (count($teacher) > 0)

                <h3>Als Dozent</h3>

                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Ort</th>
                            <th>Land</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($teacher as $t)
                            <tr>
                                <td>{{ $t->name }}</td>
                                <td>{{ $t->slug }}</td>
                                <td>{{ $t->city }}</td>
                                <td>{{ $t->country }}</td>
                                <td><a href="{{ action ('InstitutionController@show', $t->id) }}"><i
                                                class="fa fa-arrow-circle-right"></i></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

                @if (count($manager) > 0)

                    <h3>Als Dozent</h3>

                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Ort</th>
                                <th>Land</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($manager as $m)
                                <tr>
                                    <td>{{ $m->name }}</td>
                                    <td>{{ $m->slug }}</td>
                                    <td>{{ $m->city }}</td>
                                    <td>{{ $m->country }}</td>
                                    <td><a href="{{ action ('InstitutionController@show', $m->id) }}"><i
                                                    class="fa fa-arrow-circle-right"></i></a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

        </div>
    </div>

@endsection