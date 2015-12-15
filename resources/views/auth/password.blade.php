@extends ('templates.main')

@section ('title')
    Passwort vergessen
    @endsection

    @section ('body')

            <!-- Jumbotron Container -->
    <div class="jumbotron">
        <div class="container">

            <h3>Passwort wiederherstellen</h3>

        </div>
    </div>

    <!-- Login Form container -->
    <div class="container">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Accountdaten eingeben</h3>
                </div>
                <div class="panel-body">

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (count($errors) > 0)
                        <div class="alert alert-danger" role="alert">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    @endif

                    {!! Form::open(['url' => '/password/email']) !!}

                    <div class="form-group">
                        {!! Form::label('email','eMail Adresse') !!}
                        {!! Form::text('email', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Link zusenden', ['class' => 'btn btn-primary form-control']) !!}
                    </div>

                    {!! Form::close() !!}

                    <p>Dir wird ein Link zur Generierung eines neuen Passworts auf deine eMail Adresse zugesandt.</p>

                </div>
            </div>
        </div>
    </div>

@endsection