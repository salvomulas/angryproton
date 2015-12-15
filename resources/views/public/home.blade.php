@extends ('templates.main')

@section ('title')
    Willkommen
    @endsection

    @section ('body')

    <!-- Jumbotron Container -->
    <div class="jumbotron">
        <div class="container">

            <div class="col-md-6 opposed-border-right">
                <h1><i class="fa fa-spinner"></i> AngryProton</h1>
            </div>

            <div class="col-md-6 border-left">
                <h2>Weiterbildungen für alle</h2>

                <p class="lead">Finden und vergleichen Sie sämtliche Weiterbildungsangebote aus den besten Institutionen
                    der
                    Schweiz</p>

                {!! Form::open() !!}

                {!! Form::text('search', null, ['placeholder' => 'Finden Sie den passenden Kurs....', 'class' => 'form-control']) !!}

                {!! Form::close() !!}

            </div>

        </div>
    </div>

    <!-- Description container -->
    <div class="container text-center">
        <div class="row">
            <div class="col-md-4">
                <i class="fa fa-5x fa-rocket"></i>

                <h3>Schnell</h3>

                <p>Finden Sie innerhalb weniger Sekunden das passende Weiterbildungsangebot und sichern Sie
                    sich genauso schnell Ihren Ausbildungsplatz.</p>
            </div>
            <div class="col-md-4">
                <i class="fa fa-5x fa-bell"></i>

                <h3>Intelligent</h3>

                <p>AngryProton benachrichtigt Sie per eMail um Sie über sämtliche Kurse auf dem Laufenden
                    zu halten. Informationen verpassen war gestern.</p>
            </div>
            <div class="col-md-4">
                <i class="fa fa-5x fa-group"></i>

                <h3>Sozial</h3>

                <p>Mehr als nur eine Weiterbildungsplattform. Teilen von Kursinformationen und Unterlagen war noch nie
                    so einfach..</p>
            </div>
        </div>
    </div>

    <!-- Sign Up Now Section -->
    <div class="highlight">
        <div class="container">
            <div class="row">
                <div class="col-md-4 hidden-sm hidden-xs">
                    <img class="img-responsive" src="{{ asset('img/pacman.png') }}" alt="Pacman">
                </div>
                <div class="col-md-8">
                    <h3>Immer einen Schritt voraus mit AngryProton!</h3>

                    <p>Investieren Sie in sich selbst und heben Sie von der Masse ab. AngryProton erlaubt Ihnen
                        unkomplizierte
                        Anmeldungen zu verschiedensten Kursen. Schluss mit den lästigen Anmeldeverfahren, investieren
                        Sie die
                        Zeit für sinnvolles dank AngryProton!</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Courses Section -->
    <div class="courses">
        <div class="container">
            <div class="row">

                <div class="col-md-6">
                    <h3 class="text-center">Aktuelle Kurse</h3>
                    <hr>
                    <div class="list-group">
                        <a href="#" class="list-group-item">
                            <h4 class="list-group-item-heading">Bier saufen</h4>

                            <p class="list-group-item-text">Prof. Dr. Mulas | noch <strong>10 Plätze</strong> frei</p>
                        </a>
                        <a href="#" class="list-group-item">
                            <h4 class="list-group-item-heading">Die Kunst des Sarkasmus</h4>

                            <p class="list-group-item-text">Prof. Dr. Indermühle | noch <strong>2 Plätze</strong> frei
                            </p>
                        </a>
                    </div>
                </div>

                <div class="col-md-6">
                    <h3 class="text-center">Beliebte Kurse</h3>
                    <hr>
                    <div class="list-group">
                        <a href="#" class="list-group-item">
                            <h4 class="list-group-item-heading">Whiskey geniessen</h4>

                            <p class="list-group-item-text">Prof. Dr. Denger | noch <strong>12 Plätze</strong> frei</p>
                        </a>
                        <a href="#" class="list-group-item">
                            <h4 class="list-group-item-heading">Jaja schrib mer es Mail!</h4>

                            <p class="list-group-item-text">Prof. Dr. Produktion | noch <strong>4 Plätze</strong> frei
                            </p>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection