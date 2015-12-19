@extends ('templates.main')

@section ('title')
    Neuer Kurs anlegen
    @endsection

    @section ('body')

            <!-- Jumbotron Container -->
    <div class="jumbotron">
        <div class="container">
            <div class="col-md-8 col-sm-12 col-xs-12">
                <h3>Kurs anlegen</h3>

            </div>
            <div class="col-md-4 hidden-sm hidden-xs text-right">
                <i class="fa fa-5x fa-book"></i>
            </div>

        </div>
    </div>



    <div class="container">

        @if (count($errors) > 0)
            <div class="alert alert-danger" role="alert">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        @endif

        {!! Form::open(array('url' => $action)) !!}

        <div class="form-group">
            {!! Form::label('institution',"Institution")!!}
            {!! Form::select('institution',$institutions,$course->institution,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('courseName',"Kursname")!!}
            {!! Form::text('courseName',$course->courseName,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('description',"Kursbeschreibung") !!}
            {!! Form::textarea('description',$course->description,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('price',"Preis") !!}
            {!! Form::text('price',$course->price,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('startDate',"Start Datum") !!}
            {!! Form::date('startDate',$course->date,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('duration',"Dauer") !!}
            {!! Form::text('duration',$course->durcation,['class'=>'form-control']) !!}
            in Minuten
        </div>
        <div class="form-group">
            {!! Form::submit('Erstellen',['class'=>'btn btn-primary form-control']) !!}
        </div>

        {!! Form::close() !!}

    </div>

    @endsection ('body')