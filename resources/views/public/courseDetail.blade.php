@extends ('templates.main')

@section ('title')
    Kursdetails
    @endsection

    @section ('body')

            <!-- Jumbotron Container -->
    <div class="jumbotron">
        <div class="container">
            <div class="col-md-8 col-sm-12 col-xs-12">
                <h3>Kursdetails: {{ $course->courseName }}</h3>

                <p> </p>
            </div>
            <div class="col-md-4 hidden-sm hidden-xs text-right">
                <i class="fa fa-5x fa-book"></i>
            </div>

        </div>
    </div>

    <div class="container">
        <div class="col-md-6">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <tbody>
                        <tr>
                            <th>Kursname</th>
                            <th>{{ $course->courseName }}</th>
                        </tr>
                            <th>Beschreibung</th>
                            <th>{{ $course->description }}</th>
                        </tr>
                            <th>Startdatum</th>
                            <th>{{ $course->startDate }}</th>   
                        </tr>                            
                            <th>Dauer</th>
                            <th>{{ $course->duration }}</th>   
                        </tr>
                            <th>Preis</th>
                            <th>{{ $course->price }}</th>                      
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection