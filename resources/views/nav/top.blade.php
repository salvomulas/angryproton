<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}"><i class="fa fa-spinner"> </i> AngryProton</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="{{ route ('courses.index') }}">Kurse</a></li>
                <li><a href="{{ route ('institutions.index') }}">Hochschulen</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">

                <!-- User Logged in -->
                @if (Auth::check())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false"><i class="fa fa-user"></i> {{ Auth::user()->firstName ." ". Auth::user()->lastName }} <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ action('UserController@index') }}"><i class="fa fa-gear"></i> Dashboard</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ url ('/auth/logout') }}"><i class="fa fa-lock"></i> Ausloggen</a></li>
                        </ul>
                    </li>

                <!-- User not logged in -->
                @else
                    <li>
                        <p class="navbar-btn">
                            <a href="{{ url('/auth/login') }}" class="btn btn-default">Einloggen</a>
                        </p>
                    </li>
                    <li>
                        <p class="navbar-btn">
                            <a href="{{ url ('/auth/register/') }}" class="btn btn-primary">Registrieren</a>
                        </p>
                    </li>
                @endif

            </ul>
        </div>
    </div>
</nav>