@extends ('templates.main')

@section ('title')
    Passwort zurücksetzen
    @endsection

    @section ('body')

            <!-- Jumbotron Container -->
    <div class="jumbotron">
        <div class="container">
            <div class="col-md-8 col-sm-12 col-xs-12">
                <h3>Setze dein Passwort zurück!</h3>
            </div>
            <div class="col-md-4 hidden-sm hidden-xs text-right">
                <i class="fa fa-4x fa-user"></i>
            </div>

        </div>
    </div>

    <!-- Login Form container -->
    <div class="container">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Neues Passwort festlegen</h3>
                </div>
                <div class="panel-body">

                    @if (count($errors) > 0)
                        <div class="alert alert-danger" role="alert">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    @endif

                    {!! Form::open(['url' => '/password/reset']) !!}

                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group">
                        {!! Form::label('email','eMail Adresse') !!}
                        {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Deine eMail Adresse']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('password','Passwort') !!}
                        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Dein neues Passwort']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('password_confirmation','Passwort') !!}
                        {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Passwort wiederholen']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Password ändern', ['class' => 'btn btn-primary form-control']) !!}
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>

@endsection