@extends ('templates.main')

@section ('title')
    {{ $institution->name }}
    @endsection

    @section ('body')
            <!-- Jumbotron Container -->
    <div class="jumbotron">
        <div class="container">
            <div class="col-md-8 col-sm-12 col-xs-12">
                <h3>{{ $institution->name }}</h3>
                <h4>{{ $institution->slug }}</h4>
            </div>
            <div class="col-md-4 hidden-sm hidden-xs text-right">
                <i class="fa fa-5x fa-book"></i>
            </div>

        </div>
    </div>

    <div class="container">
        @include('includes.flash')

        <div class="col-md-3 col-md-push-9">

            @if (Auth::check())
                <h4>Aktionen</h4>
                <div class="list-group">
                    @can('manage_institutions')
                        <a href="{{ action('InstitutionController@edit',[$institution->id]) }}"
                           class="list-group-item"><i class="fa fa-edit fa-fw"></i>&nbsp; Bearbeiten</a>
                        <a href="{{ action('InstitutionController@destroy',[$institution->id]) }}"
                           class="list-group-item"><i class="fa fa-close fa-fw"></i>&nbsp; Löschen</a>
                    @endcan
                </div>
            @endif
        </div>

        <div class="col-md-9 col-md-pull-3">
            <div class="table-responsive">
                <table class="table table-striped">
                    <tr>
                        <th>Adresse</th>
                        <td>{{ $institution->address }}</td>
                    </tr>
                    <tr>
                        <th>Ort</th>
                        <td>{{ $institution->city }}</td>
                    </tr>
                    <tr>
                        <th>PLZ</th>
                        <td>{{ $institution->zip }}</td>
                    </tr>
                    <tr>
                        <th>Land</th>
                        <td>{{ $institution->country }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

@endsection