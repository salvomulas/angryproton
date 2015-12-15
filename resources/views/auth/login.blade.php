@extends ('templates.main')

@section ('title')
    Login
    @endsection

    @section ('body')

            <!-- Jumbotron Container -->
    <div class="jumbotron">
        <div class="container">

            <h3>Bitte logge dich ein</h3>

        </div>
    </div>

    <!-- Login Form container -->
    <div class="container">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Login</h3>
                </div>
                <div class="panel-body">

                    @if (count($errors) > 0)
                        <div class="alert alert-danger" role="alert">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    @endif

                    {!! Form::open(['url' => '/auth/login']) !!}

                    <div class="form-group">
                        {!! Form::label('email','eMail Adresse') !!}
                        {!! Form::text('email', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('password','Passwort') !!}
                        {!! Form::password('password', ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Einloggen', ['class' => 'btn btn-primary form-control']) !!}
                    </div>

                    {!! Form::close() !!}

                    <a href="{{ url ('/auth/password') }}">Ich habe mein Passwort vergessen</a>

                </div>
            </div>
        </div>
    </div>

@endsection