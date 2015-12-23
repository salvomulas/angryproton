@extends ('templates.main')

@section ('title')
    Rechnungen
    @endsection

    @section ('body')
            <!-- Jumbotron Container -->
    @include ('templates.adminJumbo')

    <div class="container">
        <div class="row">
            @include('includes.flash')

            <div class="col-md-3">
                <!-- Dashboard Menu -->
                @include ('nav.nav_dashboard')
            </div>

            <div class="col-md-9">
                <div class="table-responsive">
                    <table class="table table-striped">

                        <thead>
                        <tr>
                            <th>Kursname</th>
                            <th>Datum</th>
                            <th>Preis</th>
                            <th>PDF</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($bills as $bill)
                            <tr>
                                <td>{{ $bill->course()->getResults()->courseName }}</td>
                                <td>{{ $bill->created_at->format('d.m.Y')}}</td>
                                <td>{{ $bill->amount }}</td>
                                <td><a href="{!!action('BillController@showInline',["filename"=>$bill->filename])!!}"><i
                                                class="fa fa-file-pdf-o"></i></a></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection