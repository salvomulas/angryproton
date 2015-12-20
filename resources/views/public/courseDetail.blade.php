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
        @if (Session::has('flash_message'))
            <div class="alert alert-success">{{Session::get('flash_message')}}
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            </div>
            <script>
                $('div.alert').delay(4000).slideUp(300);
            </script>
        @endif
        <div class="col-md-6">
            Kurs editieren <a href="{{ action( 'CourseController@edit',[$course->id] ) }}"<i
                    class="fa fa-pencil-square"></i></a>

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