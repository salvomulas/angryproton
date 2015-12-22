@extends ('templates.main')

@section ('title')
    Institutionen
    @endsection

    @section ('body')

            <!-- Jumbotron Container -->
    <div class="jumbotron">
        <div class="container">
            <div class="col-md-8 col-sm-12 col-xs-12">
                <h3>Institutionen</h3>

                <p>Hunderte von Institutionen vertrauen AngryProton Ihre Kurse an.</p>
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
                    <a href="#" class="list-group-item"><i class="fa fa-institution fa-fw"></i>&nbsp; Meine
                        Institutionen</a>
                    @endcan
                </div>
            @endif

        </div>
        <div class="col-md-9 col-md-pull-3">

            @if (count($institutions) > 0)

                <div class="well">
                    {!! Form::open() !!}
                    {!! Form::text('searchInstitution', null, ['placeholder' => 'Institution suchen...', 'class' => 'form-control']) !!}
                    {!! Form::close() !!}
                </div>

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
                        @foreach ($institutions as $institution)
                            <tr>
                                <td>{{ $institution->name }}</td>
                                <td>{{ $institution->slug }}</td>
                                <td>{{ $institution->city }}</td>
                                <td>{{ $institution->country }}</td>
                                <td><a href="{{ action ('InstitutionController@show', $institution->id) }}"><i
                                                class="fa fa-arrow-circle-right"></i></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-danger" role="alert">
                    Keine Institutionen vorhanden!
                </div>
            @endif
        </div>
    </div>

@endsection