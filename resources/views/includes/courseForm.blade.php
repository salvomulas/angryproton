<div class="form-group">
    {!! Form::label('institution',"Institution")!!}
    {!! Form::select('institution',$institutions,$course->institution,['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('courseName',"Kursname")!!}
    {!! Form::text('courseName',$course->courseName,['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('description',"Kursbeschreibung") !!}
    {!! Form::textarea('description',$course->description,['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('price',"Preis") !!}
    {!! Form::text('price',$course->price,['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('startDate',"Start Datum") !!}
    {!! Form::date('startDate',$course->startDate,['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('duration',"Dauer") !!}
    {!! Form::text('duration',$course->duration,['class'=>'form-control']) !!}
    in Minuten
</div>