@extends ('templates.main')

@section ('title')
    Berechtigungen für {{ $institution->name }}
    @endsection

    @section ('body')

            <!-- Jumbotron Container -->
    <div class="jumbotron">
        <div class="container">
            <div class="col-md-8 col-sm-12 col-xs-12">
                <h3>Berechtigungen festlegen</h3>

                <p>{{ $institution->name }}.</p>
            </div>
            <div class="col-md-4 hidden-sm hidden-xs text-right">
                <i class="fa fa-5x fa-institution"></i>
            </div>

        </div>
    </div>

    <div class="container">

        <div class="col-md-8">

            <h3>Dozenten</h3>
            @if ($teachers)
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Vorname</th>
                            <th>Name</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($teachers as $teacher)
                        <tr>
                            <td>{{$teacher->firstName}}</td>
                            <td>{{$teacher->lastName}}</td>
                            <td><a href="#"><i class="fa fa-close"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="alert alert-info" role="alert">Keine Dozenten festgelegt</div>
            @endif

            <h3>Institutionsleiter</h3>
            @if ($managers)
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Vorname</th>
                        <th>Name</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($managers as $manager)
                        <tr>
                            <td>{{$manager->firstName}}</td>
                            <td>{{$manager->lastName}}</td>
                            @if ($manager->id == Auth::user()->id)
                                <td></td>
                            @else
                                <td><a href="#"><i class="fa fa-close"></i></a></td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-info" role="alert">Keine Dozenten festgelegt</div>
            @endif


        </div>

        <div class="col-md-4">
            <div class="well">
                <h4>Berechtigungen hinzufügen</h4>
                {!! Form::open(['url' => action('InstitutionController@addPermission',[$institution->id])]) !!}
                <div class="form-group">
                    {!! Form::label('user_id',"Benutzer")!!}
                    {!! Form::select('user_id',$users,null,['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('role_id',"Rolle")!!}
                    {!! Form::select('role_id',$roles,null,['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Hinzufügen', ['class' => 'btn btn-primary form-control']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>

    </div>

@endsection