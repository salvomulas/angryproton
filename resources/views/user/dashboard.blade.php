@extends ('templates.main')

@section ('title')
    Mein Dashboard
    @endsection

    @section ('body')

            <!-- Jumbotron Container -->
    <div class="jumbotron">
        <div class="container">

            <div class="col-md-5 hidden-xs hidden-sm">
                <h3>{{ Auth::user()->fullName }}</h3>
                <h4>Mitglied</h4>
            </div>
            <div class="col-md-2 col-sm-12 col-xs-12 text-center">
                <img class="img-circle img-inline img-responsive" src="{{ Auth::user()->gravatar }}" alt="User Image">
            </div>
            <div class="col-md-5 hidden-xs hidden-sm">

            </div>

        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <!-- Dashboard Menu -->
                @include ('nav.nav_dashboard')
            </div>
            <div class="col-md-9">
                <!-- Dashboard content -->
                @can('manage_courses')
                <h3>ACL: You can manage courses</h3>
                @endcan
                @can('manage_institutions')
                <h3>ACL: You can manage institutions</h3>
                @endcan
            </div>
        </div>
    </div>

@endsection