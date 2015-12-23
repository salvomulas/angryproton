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

                {!! Form::open(['url'=>action('CourseController@search')])   !!}
                {!! Form::text('searchCourse', null, ['placeholder' => 'Kurse durchsuchen...', 'class' => 'form-control']) !!}
                {!! Form::submit('submit',['class'=>'invisible']) !!}
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
        @foreach($newCourses as $course)
            <a href="{{ action ('CourseController@show', $course->id)}}" class="list-group-item">
                <h4 class="list-group-item-heading">{{$course->courseName}}</h4>
               </a>
            <a href="{{ action ('CourseController@show', $course->id) }}" class="list-group-item">
                <p class="list-group-item-text">{{$course->description}}</p>
            </a>
            @endforeach
        </a>
    </div>
</div>

<div class="col-md-6">
    <h3 class="text-center">Beliebte Kurse</h3>
    <hr>
    <div class="list-group">
        @foreach($popularCourses as $course)
        <a href="{{ action ('CourseController@show', $course->id) }}" class="list-group-item">
            <h4 class="list-group-item-heading">{{$course->courseName}}</h4>
        </a>
        <a href="{{ action ('CourseController@show', $course->id)}}" class="list-group-item">
            <p class="list-group-item-text">{{$course->description}}</p>
        </a>
        @endforeach
    </div>
</div>

</div>
</div>
</div>

@endsection