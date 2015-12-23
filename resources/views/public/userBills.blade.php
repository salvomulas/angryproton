@extends ('templates.main')

@section ('title')
Rechnungen
@endsection

@section ('body')
<!-- Jumbotron Container -->
<div class="jumbotron">
    <div class="container">
        <div class="col-md-4 hidden-sm hidden-xs text-right">
            <i class="fa fa-5x fa-bitcoin"></i>
        </div>

    </div>
</div>

<div class="container">
    @include('includes.flash')

    <div class="col-md-9 col-md-pull-3">
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

@endsection