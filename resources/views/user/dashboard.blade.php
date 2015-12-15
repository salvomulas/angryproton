@extends ('templates.main')

@section ('title')
    Mein Dashboard
    @endsection

    @section ('body')

            <!-- Jumbotron Container -->
    <div class="jumbotron">
        <div class="container">

            <div class="col-md-2">
                <img class="img-circle img-responsive" src="{{ Auth::user()->gravatar }}" alt="User Image">
            </div>
            <div class="col-md-10">
                <h3>{{ Auth::user()->fullName }}</h3>
                <h4>Mitglied</h4>
            </div>


        </div>
    </div>

    <!-- Description container -->


@endsection