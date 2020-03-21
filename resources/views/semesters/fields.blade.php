<!-- Year Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('year_id', 'Учебный год:') !!}
    {!! Form::select('year_id', \App\Models\Year::pluck('title', 'id')->all(),null, ['class' => 'form-control']) !!}
</div>

<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Наименование:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Start Field -->
<div class="form-group col-sm-6">
    {!! Form::label('start', 'Начало семестра:') !!}
    {!! Form::text('start', null, ['class' => 'form-control datepicker']) !!}
</div>

<!-- End Field -->
<div class="form-group col-sm-6">
    {!! Form::label('end', 'Конец семестра') !!}
    {!! Form::text('end', null, ['class' => 'form-control datepicker']) !!}
</div>

<!-- Current Field -->
{{--<div class="form-group col-sm-6">--}}
{{--    {!! Form::label('current', 'Current:') !!}--}}
    {!! Form::hidden('current', 0, ['class' => 'form-control']) !!}
{{--</div>--}}

<!-- Step Field -->
{{--<div class="form-group col-sm-6">--}}
{{--    {!! Form::label('step', 'Step:') !!}--}}
    {!! Form::hidden('step', 0, ['class' => 'form-control']) !!}
{{--</div>--}}

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Сохранить', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('semesters.index') }}" class="btn btn-default">Отмена</a>
</div>
