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

        {!! Form::open(array('url' => action('CourseController@update',[$course->id]),'method'=>'put')) !!}

        @include('includes.courseForm')

        <div class="form-group">
            {!! Form::submit('Ändern',['class'=>'btn btn-primary form-control']) !!}
        </div>

        {!! Form::close() !!}

    </div>

    @endsection ('body')