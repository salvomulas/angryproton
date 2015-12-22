<div class="form-group">
    {!! Form::label('name', 'Name der Institution') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('slug', 'Slug') !!}
    {!! Form::text('slug', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('address', 'Adresse') !!}
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('city', 'Stadt') !!}
    {!! Form::text('city', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('zip', 'Postleitzahl') !!}
    {!! Form::text('zip', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('country', 'Land') !!}
    {!! Form::text('country', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::submit('Institution '.$operation, ['class' => 'btn btn-primary form-control']) !!}
</div>
