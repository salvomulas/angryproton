@extends ('templates.main')

@section ('title')
    Institution {{ $operation }}
    @endsection

    @section ('body')

            <!-- Jumbotron Container -->
    <div class="jumbotron">
        <div class="container">
            <div class="col-md-8 col-sm-12 col-xs-12">
                <h3>Institution {{ $operation }}</h3>

                <p>Eine Institution {{ $operation }}.</p>
            </div>
            <div class="col-md-4 hidden-sm hidden-xs text-right">
                <i class="fa fa-5x fa-institution"></i>
            </div>

        </div>
    </div>

    <div class="container">

        <div class="col-md-12">

            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            {!! Form::model($institution, ['method' => 'PATCH', 'action' => ['InstitutionController@update', $institution->id]]) !!}
            @include ('forms.partials.institution')
            {!! Form::close() !!}

        </div>

    </div>

@endsection