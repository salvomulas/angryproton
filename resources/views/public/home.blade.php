@extends ('templates.main')

@section ('title')
    Willkommen
@endsection

@section ('body')

    <div class="jumbotron text-center">
        <div class="container">
            <h1>Weiterbildungen für alle</h1>

            <p class="lead">Finden und vergleichen Sie sämtliche Weiterbildungsangebote aus den besten Institutionen der
                Schweiz</p>

            {!! Form::open() !!}

            {!! Form::text('search', null, ['placeholder' => 'Finden Sie den passenden Kurs....', 'class' => 'form-control']) !!}

            {!! Form::close() !!}

        </div>
    </div>

    <div class="container text-center">
        <div class="row">
            <div class="col-md-4">
                <i class="fa fa-5x fa-map-pin"></i>
                <h2>Überall</h2>
                <p class="lead">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor
                    invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo
                    sit amet.</p>
            </div>
            <div class="col-md-4">
                <i class="fa fa-5x fa-beer"></i>
                <h2>Freibier</h2>
                <p class="lead">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor
                    invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo
                    sit amet.</p>
            </div>
            <div class="col-md-4">
                <i class="fa fa-5x fa-bell"></i>
                <h2>Informiert</h2>
                <p class="lead">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor
                    invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo
                    sit amet.</p>
            </div>
        </div>
    </div>

@endsection